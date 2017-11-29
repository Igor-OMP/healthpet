<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 07/11/2017
 * Time: 13:16
 */
class MobileController extends Controller
{

    public function index(){
        $data =[];
       if($this->hasMobileSession()){
           $url='home';

       }else{
           $url = 'login';
       }
        $this->loadMobTemplate($url);
    }
    public function home_pagination(){

        if($this->hasMobileSession()){
            $data=[];
            /**@var $model PetModel */
            $model = new PetModel();
            $user = (new Sessions())->get_session_data('user_mob');
            #xd($user);
            $array = $model->getById(['id_usuario'=>$user['id_usuario']]);

            if(!empty($array)){
                if(array_key_exists(0,$array)){
                    $data= $array;
                }else{
                    $data[]=$array;
                }

            }

            $this->loadView('home-pagination',[
                'data'=>$data,
                'raca'=>new RacaModel()
            ]);
        }
    }

    public function auth(){

        if($this->isPost()){
            $post = $this->getPost();
            $post['pw_pass']= md5($post['pw_pass']);
            $login = fabric('LoginModel');

           $user = $login->autenticarMob($post);
           $session = new Sessions();
           $session->create_session('user_mob', $user, true);
           $session->set_session_id();

            $this->route('/mobile');
        }else{
            $this->route('/mobile');
        }
    }

    private function authCadUser($post){
        if(!empty($post)){
            $login = new LoginModel();
            $user = $login->autenticarMob($post);
            $session = new Sessions();
            $session->create_session('user_mob', $user, true);
            $session->set_session_id();

            $this->toRoute('/mobile');
        }else{
            $this->toRoute('/mobile');
        }
    }

    public function cad_pet(){
        $this->hasMobileIdentify();
        $this->data['user'] = (new Sessions())->get_session_data('user_mob');

        $this->loadMobTemplate('cad-pet');
    }

    public function cad_user(){
       $this->loadMobTemplate('cad-user');
    }

    public function verify_email(){
        if($this->isPost()){
            $post = $this->getPost();

            $post['em_email'] = strtolower($post['em_email']);
            $usuario = new UsuarioModel();
            $return =  $usuario->filtrar($post);
            if($return > 0){
                echo $this->enc('true');
            }else{
                echo '';
            }
        }
    }
    public function logout($url = '/mobile'){
        try {

            if (!isset($_SESSION)) {
                session_start();
            }
            #unset($_SESSION['user']);
            session_destroy();
            $url = $this->redirect($url);
            #xd($url);
            $this->route($url);
        } catch (Exception $e) {
            echo 'erro ao deslogar';
        }
    }

    public function id_raca_pagination(){
        $this->hasMobileIdentify();

        $post= $this->getPost('data');
        /**@var $racas RacaModel*/
        $racas = fabric('RacaModel');
        $this->data['racas'] =$racas->where(['id_especie'=>$post],null);

         $this->loadView('id_raca_pagination');
    }
    public function id_servico_petshop(){
        $this->hasMobileIdentify();

        $post= $this->getPost('data');
        $post = $this->dec($post);
        #xd($post);
        /**
         * @var $pet_ser PetShopServicoModel
         * @var $servico ServicoModel
         */
        $pet_ser = fabric('PetShopServicoModel');
        $servico = fabric('ServicoModel');
        $this->data['serv_model'] =$servico;
        $this->data['servicos'] = $pet_ser->getServicosByPetShopId(['id_petshop'=>$post]);

        $this->loadView('id_servico_petshop');
    }

    public function agenda($params=null){
        $this->hasMobileIdentify();
        /**
         * @var $petshop  PetShopModel
         *
         */
        $user = (new Sessions())->get_session_data('user_mob');
        $petshop = fabric('PetShopModel');
        $this->data['id_pet']= $params;
        $this->data['id_usuario']=$user['id_usuario'];
        $this->data['petshop']=$petshop->All();

        $this->loadMobTemplate('agenda');
    }


    public function cad_agenda(){
        $this->hasMobileIdentify();
        /**
         * @var $agenda AgendaModel
         *
         */
        if($this->isPost()){
            $post = $this->getPost('dados');
           $post =  $this->unserialize($post);
            $arr['dt_servico']  = $post['dt_servico'];
            unset($post['dt_servico']);

            foreach($post as $key =>$value){
                $arr[$key]=$this->dec($value);
            }
            #xd($arr);
            $validation = new Data_Validator();
            $validation->setValidates($arr,$this->module_conf('Mobile','agenda-form'));

            if($validation->validate()){
               $agenda = new AgendaModel();
                $arr['flag_status']='A';
                $data['id_usuario']= $arr['id_usuario'];
                #xd($arr);
                unset($arr['id_usuario']);

                $bool = $agenda->salvar($arr);
                #$bool= true;
                if($bool){
                    $data['id_agenda']=$bool;
                    $user_agenda = new UsuarioAgendaModel();
                    #xd($user_agenda);
                    $bool = $user_agenda->salvar($data);

                    if($bool){
                        echo true;
                    }
                }else{
                    $this->toRoute('/mobile');
                }
            }else{

                $this->toRoute('/mobile',['error'=>$validation->get_errors()]);
            }

        }else{
            $this->toRoute('/mobile');
        }
    }


    public function eventos(){
        $this->hasMobileIdentify();
        if($this->isPost()){
            $post = $this->getPost();

            $post['id'] = $this->dec($post['id']);

            $agenda = new AgendaModel();
            $result = $agenda->where(['id_pet'=>$post['id']],null,' AND flag_status="A" ');
            if(!empty($result)){
                if(!array_key_exists(0,$result)){
                    $dados[]=$result;
                }else{
                    $dados = $result;
                }
                $this->data['eventos']=$dados;
            }

        }
        $this->loadView('evento');
    }



    public function evento_modal(){
        $this->hasMobileIdentify();
        if($this->isPost()){
            $post = $this->getPost();
            $post['id_agenda'] = $this->dec($post['id_agenda']);
            $agenda = new AgendaModel();

            $data = $agenda->where($post);
           $this->data['dados']=$data;
            $this->loadView('modal');
        }else{
            echo false;
        }
    }

    public function evento_delete(){
        $this->hasMobileIdentify();
        if($this->isPost()){
            $post = $this->getPost();
            $post['id'] = $this->dec($post['id']);

            $usuario_agenda = new UsuarioAgendaModel();
            $bool = $usuario_agenda->exclui(['id_agenda'=>$post['id']]);
            if($bool){
                $agenda = new AgendaModel();
                $bool = $agenda->excluir(['id_agenda'=>$post['id']]);

                if($bool){
                    echo $this->enc('success');
                    die;
                }
            }else{
                echo false;
            }
        }
        echo false;
    }


    public function cadastrar()
    {
        /**
         * @var $pet PetModel;
         */

        $this->hasMobileIdentify();

        if($this->isPost()){
            $post = $this->getPost();


            #x($_FILES);

            $post['id_usuario'] = $this->dec($post['id_usuario']);
            #$post['flag_porte'] = $this->dec($post['flag_porte']);
            $post['flag_porte']=3;

            $validate = new Data_Validator();
           $validation  =$this->module_conf('Mobile','cad-ped-form');

            $validate->setValidates($post,$validation);
            if($validate->validate()){
                $pet = new PetModel();

                if($this->isFiles('ft_pet')){
                    $url = $this->uploadFile($this->getFiles('ft_pet'),'public/img/avatar_pets/');
                    $url = str_replace('public/','/',$url);
                    $post['ft_pet']=$url;
                }

                unset($post['id_especie']);
                $bool = $pet->salvar($post);
                if($bool && !is_array($bool)){

                    $this->toRoute('/mobile');
                }else{
                    $this->toRoute('/mobile/cad-pet');
                }

            }else{
                $this->toRoute('/mobile/cad-pet');
            }

           # xd($post);
        }else{
            $this->toRoute('/mobile/cad-pet');
        }
    }

    public function save_user(){
        if($this->isPost()){
            $post = $this->getPost();
            if($post['conf_senha'] == $post['pw_senha']){
                $post['pw_pass']= md5($post['pw_senha']);
                unset($post['conf_senha']);
                unset($post['pw_senha']);

                $post['nm_usuario'] = ucwords($post['nm_usuario']);

                #xd($post);
                $validation = new Data_Validator();
                $validation->setValidates($post,$this->module_conf('Mobile','cad-user-form'));

                if($validation->validate()){
                    $user = new UsuarioModel();

                    if($user->filtrar(['em_email'=>$post['em_email']]) > 0)
                        $this->toRoute('/mobile/cad-user');

                    $bool = $user->salvar($post);
                    if($bool){
                        $this->authCadUser(['em_email'=>$post['em_email'],'pw_pass'=>$post['pw_pass']]);
                    }
                }else{
                    $this->addFlashMessage(Controller::MSG_WARNING,'O formulário não pode ser validado.');
                    $this->toRoute('/mobile/cad-user');
                }
            }else{
                $this->addFlashMessage(Controller::MSG_WARNING,'Senhas não conferem');
                $this->toRoute('/mobile/cad-user');
            }

        }else{
            $this->toRoute('/mobile/cad-user');
        }
        $this->addFlashMessage(Controller::MSG_WARNING,'Nenhumam informação foi enviada');
        $this->toRoute('/mobile/cad-user');
    }

    public function pet_delete(){
        if($this->hasMobileSession() && $this->isPost()){
            $pilha=[];

            $post = $this->getPost();
            $post['id']= $this->dec($post['id']);
            $agenda  = new AgendaModel();
            $user_agenda = new UsuarioAgendaModel();
            $cv = new CartaoVacinaModel();
            $pet_cv= new PetCartaoModel();
            if($agenda->filtrar(['id_pet'=>$post['id']]) > 0){
                /*Buscando todas as agendas relacionas ao pet*/
                $data = $agenda->where(['id_pet'=>$post['id']],'id_agenda');
                if(isset($data[0])){
                    $agendas = $data;
                }else{
                    $agendas[]= $data;
                }
                #xd($agendas);
                /*Apagando agendas da tabela usuario_agenda*/
                foreach($agendas as $item){
                    $bool=$user_agenda->exclui($item);

                    if($bool && is_array($bool)){
                        xd($bool);

                    }
                }
                /*Apagando agendas da tabela agenda*/
                foreach($agendas as $item){
                   $bool = $agenda->excluir($item);

                    if($bool && is_array($bool)){
                        xd($bool);

                    }
                }
            }
            if($pet_cv->filtrar(['id_pet'=>$post['id']])){
                $data = $pet_cv->getById(['id_pet'=>$post['id']]);

                if(isset($data[0])){
                    $pet_cvs = $data;
                }else{
                    $pet_cvs[]= $data;
                }

                foreach($pet_cv as $item){
                    $bool = $cv->exclui($item['id_cartao_vacina']);

                    if($bool && is_array($bool)){
                        xd($bool);
                    }
                }

                $pet_cv->exclui(['id_pet'=>$post['id']]);
            }

            $pet = new PetModel();
            $bool = $pet->exclui(['id_pet'=>$post['id']]);

            if($bool && !is_array($bool)){
                echo $this->enc('success');
                die;
            }else{
                xd($bool);
            }
        }
        echo false;
    }

    public function save_cv(){
        if($this->hasMobileSession() && $this->isPost()){/*INIT IF 1*/
            $post= $this->getPost();
            $post['id']= $this->dec($post['id']);

            $agenda  = new AgendaModel();
            $cv = new CartaoVacinaModel();
            $pet_cv = new PetCartaoModel();
            if($agenda->filtrar(['id_agenda'=>$post['id']]) > 0){/*INIT IF 2*/
                $bool = $agenda->salvar(['id_agenda'=>$post['id'],'flag_status'=>'I']);
                #$bool = true;
                if($bool){
                    $agenda = $agenda->getById(['id_agenda'=>$post['id']]);
                    $id_pet = $agenda['id_pet'];
                    $id_cartao = $cv->salvar([
                        'id_petshop'=>$agenda['id_petshop'],
                        'id_servico'=>$agenda['id_servico'],
                        'dt_evento'=>$agenda['dt_servico'],
                        'txt_desc'=>json_encode(['observacoes'=>null])
                    ]);
                    if($id_cartao){
                       $bool =  $pet_cv->salvar([
                            'id_cartao_vacina'=>$id_cartao,
                            'id_pet'=>$id_pet
                        ]);

                        if($bool){
                            echo $this->enc('success');
                            die;
                        }
                    }

                }
            }   /*END IF 2*/
        }/*End IF 1*/

        echo false;

    }

    public function card_vacina($params){

        if($this->hasMobileSession() && !empty($params)){
            $this->loadMobTemplate('card-vacina',['id_pet'=>$params]);
        }else{
            $this->toRoute('/mobile');
        }
    }
    public function card_vacina_pagination(){
        if($this->hasMobileSession() && $this->isPost()){
            $post = $this->getPost();
            $post['id']= $this->dec($post['id']);

            $pet_cv = new PetCartaoModel();
            $pet_cv = $pet_cv->getById(['id_pet'=>$post['id']]);

            if(isset($pet_cv[0])){
                $dados = $pet_cv;
            }else{
                $dados[]=$pet_cv;
            }
            $this->loadView('card-vacina-pagination',['cartoes'=>$dados,'id_pet'=>$post['id']]);
        }
    }

    public function card_vacina_delete(){
        if($this->hasMobileSession() && $this->isPost()){
            $post = $this->getPost();
            $post['id']= $this->dec($post['id']);

            $cv = new CartaoVacinaModel();
            $pet_cv = new PetCartaoModel();

            $bool = $pet_cv->exclui(['id_cartao_vacina'=>$post['id']]);

            if($bool && !is_array($bool)){
                $bool = $cv->exclui(['id_cartao_vacina'=>$post['id']]);
                if($bool && !is_array($bool)){
                    echo $this->enc('success');
                }else{
                    echo json_encode($bool);
                }
            }else{
                echo json_encode($bool);
            }
        }
    }

    public function modal_card_vacina(){
        $this->hasMobileIdentify();
        if($this->isPost()){
            $post = $this->getPost();
            $post['id_cartao_vacina'] = $this->dec($post['id_cartao_vacina']);
            $cv = new CartaoVacinaModel();

            $data = $cv->where($post);
            $this->data['dados']= $data;
            $this->loadView('modal-card-vacina');
        }else{
            echo false;
        }
    }

    public function recuperar_senha(){
      $this->loadMobTemplate('recuperar-senha');

    }

    public function request_token(){
        if($this->isPost()){
            $post = $this->getPost();
            $usuario = new UsuarioModel();

            if($usuario->filtrar(['em_email'=>$post['em_email']]) > 0){
                $data = $usuario->getUsuarioByEmail($post);

                #x($this->send_email($data['em_email'],$data['nm_usuario'],$data['id_usuario']));

               if($this->send_email($data['em_email'],$data['nm_usuario'],$data['id_usuario'])){

                   $this->addFlashMobMessage(Controller::MSG_SUCCESS,"email para redefinir a senha foi encaminhado.");
                   $this->toRoute('mobile');
               }else{
                   $this->addFlashMobMessage(Controller::MSG_WARNING,"não foi possível enviar o email");
                   $this->toRoute('mobile/recuperar-senha');
               }
            }else{
                $this->addFlashMobMessage(Controller::MSG_WARNING,"não existe email cadastrado");
                $this->toRoute('mobile/recuperar-senha');
            }

        }
        $this->toRoute('mobile/recuperar-senha');
    }


    public function redefinir(){

        if($this->getRequest()){

            $data =$this->getRequest();
            $token = $data['t'];
            $email =base64_decode($data['e']);
            $nome = base64_decode($data['u']);
            $id =$this->getRequest('i');


            $checksum = base64_encode(sha1('InitCriptografia')).
                base64_encode(md5($email."healthpet_recuperacao_senha_".date("d/m/y",strtotime("now")))).
                base64_encode(sha1('EndCriptografia')).
                base64_encode(sha1('Nome:').$email);

            if($token == $checksum){
                $this->toRoute('mobile/redefinir-senha?token='.$token."&u=".base64_encode($nome)."&e=".base64_encode($email).'&i='.$id);
            }else{
                Controller::error404();
            }
        }
    }

   public function redefinir_senha(){
       $token = $this->getRequest('token');
       $user = base64_decode($this->getRequest('u'));
       $email = base64_decode($this->getRequest('e'));
       $id = base64_decode($this->getRequest('i'));

       if($token && $user && $email){
           $data = [
             'token'=>$token,
              'user'=>$user,
              'email'=>$email,
               'id'=>$id
           ];
           $this->loadMobTemplate('redefinir-senha',$data);
       }else{
           Controller::error404();
       }
   }

    public function update_senha(){
        if($this->isPost()){
            $post = $this->getPost();

            if(isset($post['id_usuario'])){
                $user = new UsuarioModel();

                if($post['conf_senha'] == $post["pw_senha"]){
                    $user->salvar([
                        'id_usuario'=>$this->dec($post['id_usuario']),
                        'pw_pass'=>md5($post['pw_senha'])
                    ]);
                    $this->addFlashMobMessage(Controller::MSG_SUCCESS,'Senha atualizada com sucesso');
                    $this->toRoute('/mobile');
                }else{
                    $this->route($_SERVER['REQUEST_URI']);
                }
            }
        }
    }

}