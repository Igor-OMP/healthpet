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

            $this->route('/mobile');
        }else{
            $this->route('/mobile');
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
                $bool = $agenda->exclui(['id_agenda'=>$post['id']]);

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
                $pet = fabric('PetModel');

                if($this->isFiles('ft_pet')){
                    $url = $this->uploadFile($this->getFiles('ft_pet'),'public/img/avatar_pets/');
                    $url = str_replace('public/','/',$url);
                    $post['ft_pet']=$url;
                }

                unset($post['id_especie']);
                $bool = $pet->salvar($post);
                if($bool){
                    $this->toRoute('/mobile');
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
                    $this->toRoute('/mobile/cad-user');
                }
            }else{
                return false;
            }

        }else{
            $this->toRoute('/mobile/cad-user');
        }

        return null;
    }

    public function pet_delete(){
        if($this->hasMobileSession() && $this->isPost()){
            $post = $this->getPost();
            $post['id']= $this->dec($post['id']);

            $pet = new PetModel();
            $bool = $pet->exclui(['id_pet'=>$post['id']]);

            if($bool){
                echo $this->enc('success');
                die;
            }
        }
        echo false;
    }

}