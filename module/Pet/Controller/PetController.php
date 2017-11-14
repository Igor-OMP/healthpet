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
            $model = new RacaModel();
            $data = $model->getById(['id_raca'=>$id]);
            $data['id_raca'] = $this->enc($data['id_raca']);

            $this->form->setData($data);
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
        if(isset($post['id_raca']) && $post['id_raca'] == null)
            unset($post['id_raca']);


        if(!empty($post)){
            if(isset($post['id_raca']) && $post['id_raca'] != null)
                $post['id_raca'] = $this->dec($post['id_raca']);
            $post['nm_raca'] = strtolower($post['nm_raca']);
            $servico = new RacaModel();
            #xd($servico);

            if($servico->filtrar(['nm_raca'=>$post['nm_raca']])){
                $this->addMessage(['status'=>'DANGER','msg'=>'informações já cadastradas no banco de dados']);
                $this->route('/raca');
            }

            $bool = $servico->salvar($post);

            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                #xd((new Sessions())->get_session_data('user'));
                $this->route('/raca');
            }
        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->route('/raca');
        }
    }

    public function excluir(){
        $this->hasIdentify();
        $id = $this->getPost();

        #xd($id);
        if(!empty($id)){
            $id['id']= $this->dec($id['id']);
            $servico = new PetModel();
            $bool = $servico->exclui(['id_pet'=>$id['id']]);
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