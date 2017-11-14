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
       try{
           $posts = $this->getPost('array');

           if(empty($posts)){
               $this->addMessage(['status'=>'DANGER','msg'=>'informações não foram gravadas no banco de dados']);
               $this->route('/usuario');
           }

           $modelpet=fabric('PetModel');
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
                   'ft_pet'=>$this->salvarBase64ToImg($post->nm_pet,$post->ft_pet,'public/img/avatar_pets/')

               ];

               $bool = $modelpet->salvar($obj);
           }

           if($bool != null)
               echo true;

       }catch (Exception $e){
            echo false;
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
            $bool = $servico->exclui(['id_usuario'=>$id['id']]);
            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações excluidas com sucesso']);
                echo true;
            }
        }else{
            $this->addMessage(['status'=>'DANGER','msg'=>'Informações não puderam ser excluídas.']);
            echo false;
        }
    }
}