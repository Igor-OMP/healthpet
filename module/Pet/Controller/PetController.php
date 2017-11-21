<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 30/10/2017
 * Time: 19:15
 */
class PetController extends  Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['message']='Pets';
    }

    public function index(){
        $this->hasIdentify();
        $this->loadTemplate('index');
    }

    public function pagination(){
        $this->hasIdentify();
        $pet = new PetModel();
        $this->data['pets'] = $pet->All();
        $this->data['raca']= fabric('RacaModel');
        $this->data['usuario']= fabric('UsuarioModel');
        $this->loadView('index_pagination');

    }

    public function cadastrar($params =null){
        $this->hasIdentify();

        if($params != null){
            $id = $this->dec($params);
            $model = new PetModel();
            $raca = new RacaModel();

            $data = $model->getById(['id_pet'=>$id]);
            $data['id_pet'] = $this->enc($data['id_pet']);
            $data['dt_nasc'] = substr($data['dt_nasc'],0,stripos($data['dt_nasc']," "));
            $espec =$raca->where(['id_raca'=>$data['id_raca']],'id_especie');
            $data['id_especie']=$espec['id_especie'];


            switch($data['flag_porte']){
                case '1':
                    $data['flag_porte']='Pequeno';
                    break;
                case '2':
                    $data['flag_porte']='Médio';
                    break;
                case '3':
                    $data['flag_porte']='Grande';
                    break;
            }
            #xd($data);
            $this->form->setData($data);

            $this->data['data']=$data;
        }
        $this->data['form']= $this->form;
        $this->loadTemplate('cad');
    }

    public function get_racas(){
        $this->hasIdentify();
        $data = null;
        $post = $this->getPost();

        if($post !=null){
            $model = new RacaModel();
            $data = $model->get_racas(['id_especie'=>$post['id']]);
            $data = json_encode($data);
        }

        echo $data ;
    }

    public function salvar(){
        $this->hasIdentify();

        $post = $this->getPost();

        if(isset($post['id_pet']) && $post['id_pet'] == null)
            unset($post['id_pet']);


        if(!empty($post)){

            foreach($post as $key => $value){
                if($post[$key] == null){
                    unset($post[$key]);
                }
            }

            if(isset($post['id_pet']) && $post['id_pet'] != null)
                $post['id_pet'] = $this->dec($post['id_pet']);
            $post['nm_pet'] = strtolower($post['nm_pet']);

            unset($post['id_especie']);
            unset($post['id_usuario']);

            switch($post['flag_porte']){
                case 'Pequeno':
                    $post['flag_porte']='1';
                    break;
                case 'Médio':
                    $post['flag_porte']='2';
                    break;
                case 'Grande':
                    $post['flag_porte']='3';
                    break;
            }
            
            $servico = new PetModel();
            #xd($servico);

            $bool = $servico->salvar($post);

            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                #xd((new Sessions())->get_session_data('user'));
                $this->route('/pet');
            }
        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->route('/pet');
        }
    }

    public function excluir(){
        $this->hasIdentify();
        $id = $this->getPost();


        if(!empty($id)){
            $id['id']= $this->dec($id['id']);
            $servico = new PetModel();
            $bool = $servico->exclui(['id_pet'=>$id['id']]);
            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações excluidas com sucesso']);
                echo true;
                die;
            }
        }else{
            $this->addMessage(['status'=>'DANGER','msg'=>'Informações não puderam ser excluídas.']);
            echo false;
        }
    }

    public function id_raca_pagination(){
        $this->hasIdentify();
        if($this->isPost()){

            $this->data['racas'] = $this->getPost('data');
            $this->data['selected']= $this->getPost('selected');
            $this->loadView('id_raca_pagination');
        }
    }

}