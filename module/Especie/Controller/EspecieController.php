<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 24/10/2017
 * Time: 01:40
 */
class EspecieController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['message']='Espécie';
    }

    public function index(){
        $this->hasIdentify();
        $this->loadTemplate('index');
    }

    public function pagination(){
        $this->hasIdentify();
        $especie = new EspecieModel();
        $this->data['especies'] = $especie->All();
        $this->loadView('index_pagination');
    }

    public function cadastrar($params =null){
        $this->hasIdentify();

        if($params != null){
            $id = $this->dec($params);
            $model = new EspecieModel();
            $data = $model->getById(['id_especie'=>$id]);
            $data['id_especie'] = $this->enc($data['id_especie']);

            $this->form->setData($data);
        }
        $this->data['form']= $this->form;
        $this->loadTemplate('cad');
    }

    public function salvar(){
        $this->hasIdentify();

        $post = $this->getPost();


        if(isset($post['id_especie']) && $post['id_especie'] == null)
            unset($post['id_especie']);

        if(isset($post['id_especie']) && $post['id_especie'] != null){
            $post['id_especie']= $this->dec($post['id_especie']);

        }


        if(!empty($post)){

            $post['nm_especie'] = strtolower($post['nm_especie']);
            $especie = new EspecieModel();
            #xd($servico);

            if($especie->filtrar(['nm_especie'=>$post['nm_especie']])){
                $this->addMessage(['status'=>'DANGER','msg'=>'informações já cadastradas no banco de dados']);
                $this->route('/especie');
            }
            $bool = $especie->salvar($post);
            #xd($bool);
            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                #xd((new Sessions())->get_session_data('user'));
                $this->route('/especie');
            }
        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->route('/especie');
        }
    }

    public function excluir(){
        $this->hasIdentify();
        $id = $this->getPost();

        #xd($id);
        if(!empty($id)){
            $id['id']= $this->dec($id['id']);
            $servico = new EspecieModel();
            $bool = $servico->exclui(['id_especie'=>$id['id']]);
            if($bool){
                #$this->addMessage(['status'=>'SUCCESS','msg'=>'Informações excluidas com sucesso']);
                echo true;
            }
        }else{
            #$this->addMessage(['status'=>'DANGER','msg'=>'Informações não puderam ser excluídas.']);
            echo false;
        }
    }

}