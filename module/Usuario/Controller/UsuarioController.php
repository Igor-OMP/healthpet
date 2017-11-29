<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 19/10/2017
 * Time: 12:36
 */
class UsuarioController extends \Controller
{

    /**
     * UsuarioController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['message']='Usuário';
    }

    public  function index(){
        $this->hasIdentify();
        $this->loadTemplate('index');
    }

    public function pagination(){
        $this->hasIdentify();
        $usuario = new UsuarioModel();

        $this->mergeData(['usuarios'=>$usuario->All()]);

        $this->loadView('index_pagination');
    }

    public function id_raca_pagination(){
        $this->hasIdentify();

        $this->data['racas'] = $this->getPost('data');

        $this->loadView('id_raca_pagination');
    }

    public function cadastrar($params =null){
        $this->hasIdentify();

        if($params != null)
            $post = $params;

        if(isset($post) && !empty($post)){
            $id['id_usuario'] =$this->dec($post);
            $model = new UsuarioModel();
            $this->form = new UsuarioUpdateForm();

            /*Modificando os dados*/
            $data = $model->getById($id);
            unset($data['pw_pass']);
            $data['nm_usuario'] = ucwords($data['nm_usuario']);
            $data['id_usuario'] = $this->enc($data['id_usuario']);

            $this->form->setData($data);
            $this->data['form']= $this->form;
        }else{
            $this->data['form']= $this->form;
        }

        $this->loadTemplate('form-test');
    }

    public function add_pets($params){
        $this->hasIdentify();

        $this->data['form']= new UsuarioPetsForm();
        $this->data['id'] = $params;
        $this->loadTemplate('add-pets');
    }

    public function write_pets(){
        $this->hasIdentify();
        $bool= '';
       try{
           $posts = $this->getPost('array');

           if(empty($posts)){
               $this->addMessage(['status'=>'DANGER','msg'=>'informações não foram gravadas no banco de dados']);
               $this->route('/usuario');
           }

           $modelpet=new PetModel();
           foreach($posts as  $post){
               $post= json_decode($post);

               switch($post->flag_porte){
                   case 'Grande':
                       $post->flag_porte = 3;
                       break;
                   case 'Médio':
                       $post->flag_porte = 2;
                       break;
                   case 'Pequieno':
                       $post->flag_porte = 1;
                       break;
               }

               $obj =[
                   'id_usuario'=>$this->dec($post->id),
                   'nm_pet'=>$post->nm_pet,
                   'id_raca'=>$post->id_raca,
                   'dt_nasc'=> $this->converterDataHoraBrazil2BancoMySQL($post->dt_nasc),
                   'flag_porte'=>$post->flag_porte,

               ];

               if(isset($post->ft_pet)){
                   $obj['ft_pet']= $this->salvarBase64ToImg($post->nm_pet,$post->ft_pet,'public/img/avatar_pets/');
               }
               
               $bool = $modelpet->salvar($obj);
           }

           if($bool && !is_array($bool)){
               echo $this->enc('success');
           }else{
               echo json_encode($bool);
           }


       }catch (Exception $e){
            echo json_encode($e->getMessage());
       }


    }
    public function salvar(){
        $this->hasIdentify();

        $post = $this->getPost();

        foreach($post as $key =>$value){
            if($value == null)
                unset($post[$key]);
        }
        $servico =new UsuarioModel();
        if(!empty($post)){

            if(isset($post['id_usuario'])&& !empty($post['id_usuario'])){
                $post['id_usuario']= $this->dec($post['id_usuario']);
            }
            $post['nm_usuario'] = strtolower($post['nm_usuario']);
            $post['pw_pass']=md5($post['pw_pass']);



            if($servico->filtrar(['em_email'=>$post['em_email']])){
                $this->addMessage(['status'=>'DANGER','msg'=>'informações já cadastradas no banco de dados']);
                $this->route('/usuario');
            }

            $bool = $servico->salvar($post);
            #xd($bool);
            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                #xd((new Sessions())->get_session_data('user'));
                $this->route('/usuario');
            }
        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->route('/usuario');
        }
    }


    public function atualizar(){
        $this->hasIdentify();

        $post = $this->getPost();

        foreach($post as $key =>$value){
            if($value == null)
                unset($post[$key]);
        }
        $servico =new UsuarioModel();
        if(!empty($post)){

            if(isset($post['id_usuario'])&& !empty($post['id_usuario'])){
                $post['id_usuario']= $this->dec($post['id_usuario']);

                $data = $servico->getById(['id_usuario'=>$post['id_usuario']]);
                #x($this->dec($post['id_usuario']) .' ' .$data['id_usuario']);

                if(($post['id_usuario'] == $data['id_usuario']) && isset($post['pw_pass']) && (md5($post['pw_pass']) == $data['pw_pass']) ){
                    $post['pw_pass'] = md5($post['pw_senha']);
                    unset($post['pw_senha']);

                }else if($post['id_usuario'] == $data['id_usuario'] && !isset($post['pw_pass']) ){
                   $post['pw_pass'] = $data['pw_pass'];
                }else{
                    $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações  não puderam se validadas (Senha Atual incorreta).']);
                    $this->route('/usuario/cadastrar/'.$this->enc($data['id_usuario']));
                }

            }
            $post['nm_usuario'] = strtolower($post['nm_usuario']);

            $bool = $servico->salvar($post);
            #xd($bool);
            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                #xd((new Sessions())->get_session_data('user'));
                $this->route('/usuario');
            }
        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->route('/usuario');
        }
    }


    public function excluir(){
        $this->hasIdentify();
        $id = $this->getPost();

        if(!empty($id)){
            $id['id']= $this->dec($id['id']);


            $servico = new UsuarioModel();
            $pet = new PetModel();
            $agenda = new AgendaModel();
            $cv = new CartaoVacinaModel();
            $pcv = new PetCartaoModel();
            $user_agenda = new UsuarioAgendaModel();

            $pets = $pet->getById(['id_usuario'=>$id['id']]);

            /*EXCLUINDO TODOS OS CARTÕES DE VACINA*/
            if($pets != null){
                if(isset($pets[0])){
                    foreach($pets as $p){
                        $data = $pcv->getById(['id_pet'=>$p['id_pet']]);

                        if($data != null ){
                            if(isset($data[0])){
                                foreach($data as $item){
                                    $bool = $cv->exclui(['id_cartao_vacina'=>$item['id_cartao_vacina']]);

                                    if(is_array($bool) && isset($bool['error_message'])){
                                        $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                                        echo false;
                                    }
                                }
                            }else{
                               $bool =  $cv->exclui(['id_cartao_vacina'=>$data['id_cartao_vacina']]);

                                if(is_array($bool) && isset($bool['error_message'])){
                                    $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                                    echo false;
                                }
                            }

                            $bool = $pcv->exclui(['id_pet'=>$p['id_pet']]);

                            if(is_array($bool) && isset($bool['error_message'])){
                                $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                                echo false;
                            }
                        }
                    }
                }else{
                    $data = $pcv->getById(['id_pet'=>$pets['id_pet']]);

                    if($data != null ){
                        if(isset($data[0])){
                            foreach($data as $item){
                                $bool = $cv->exclui(['id_cartao_vacina'=>$item['id_cartao_vacina']]);

                                if(is_array($bool) && isset($bool['error_message'])){
                                    $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                                    echo false;
                                }
                            }
                        }else{
                           $bool =  $cv->exclui(['id_cartao_vacina'=>$data['id_cartao_vacina']]);

                            if(is_array($bool) && isset($bool['error_message'])){
                                $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                                echo false;
                            }
                        }

                        $bool = $pcv->exclui(['id_pet'=>$pets['id_pet']]);

                        if(is_array($bool) && isset($bool['error_message'])){
                            $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                            echo false;
                        }
                    }
                }
            }/*END EXCLUSÃO CARTAO DE VACINAS */

            /*INIT - EXCLUINDO AGENDA*/
            $agenda_user = $user_agenda->getById(['id_usuario'=>$id['id']]);

            if($agenda_user != null ){
                if(isset($agenda_user[0])){
                    foreach($agenda_user as $item){
                        $bool = $agenda->excluir(['id_agenda'=>$$item['id_agenda']]);

                        if(is_array($bool) && isset($bool['error_message'])){
                            $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                            echo false;
                        }
                    }
                }else{
                   $bool= $agenda->excluir(['id_agenda'=>$agenda_user['id_agenda']]);

                    if(is_array($bool) && isset($bool['error_message'])){
                        $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                        echo false;
                    }
                }
                $bool =  $user_agenda->exclui(['id_usuario'=>$id['id']]);

                if(is_array($bool) && isset($bool['error_message'])){
                    $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                    echo false;
                }
            }/*END - EXCLUSÃO AGENDA*/


            /*INIT  - REVERIFICAÇÃO DE AGENDA*/
            if($pets != null){
                if(isset($pets[0])){
                    foreach($pets as $p){
                       $bool = $agenda->excluir(['id_pet'=>$p['id_pet']]);

                       if(is_array($bool) && isset($bool['error_message'])){
                            $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                            echo false;
                        }
                    }
                }else{
                    $bool = $agenda->excluir(['id_pet'=>$pets['id_pet']]);

                    if(is_array($bool) && isset($bool['error_message'])){
                        $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                        echo false;
                    }
                }
            }/*END - VERIFICAÇÃO DE AGENDA*/


            /*INIT - EXCLUSÃO PET*/
            if($pet->getById(['id_usuario'=>$id['id']])){
                $bool = $pet->exclui(['id_usuario'=>$id['id']]);

                if(is_array($bool) && isset($bool['error_message'])){
                    $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                    echo false;
                }
            }
            /*END - EXCLUSÃO PET*/

            $bool = $servico->exclui(['id_usuario'=>$id['id']]);
            if($bool && !is_array($bool)){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações excluidas com sucesso']);
                echo true;
            }else{
                $this->addFlashMessage(Controller::MSG_DANGER,$bool['error_message']);
                echo false;

            }
        }
    }
}