<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 22/10/2017
 * Time: 21:35
 */
class CidadeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['message']='Cidade';
    }

    public function index(){
        $this->hasIdentify();
        $this->loadTemplate('index');
    }

    public function pagination(){
        $this->hasIdentify();
        $cidade = new CidadeModel();
        $this->data['cidades'] = $cidade->All();
        $this->data['model'] = $cidade;
        $this->loadView('index_pagination');
    }

    public function cadastrar($params =null){
        $this->hasIdentify();

        if($params != null){
            $id = $this->dec($params);
            $model = new CidadeModel();
            $data = $model->getById(['id_cidade'=>$id]);
            $data['id_cidade'] = $this->enc($data['id_cidade']);

            $this->form->setData($data);
         }
        $this->data['form']= $this->form;
        $this->loadTemplate('cad');
    }

    public function salvar(){
        $this->hasIdentify();

        $post = $this->getPost();
        if(isset($post['id_cidade']) && $post['id_cidade'] == null)
            unset($post['id_cidade']);


        if(!empty($post)){

            if(isset($post['id_cidade']) && !empty($post['id_cidade'])){
                $post['id_cidade']= $this->dec($post['id_cidade']);
            }
            $post['nm_cidade'] = strtolower($post['nm_cidade']);
            $servico = new CidadeModel();
            #xd($servico);

            if($servico->filtrar(['nm_cidade'=>$post['nm_cidade']])){
                $this->addMessage(['status'=>'DANGER','msg'=>'informações já cadastradas no banco de dados']);
                $this->route('/cidade');
            }

            $bool = $servico->salvar($post);

            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                #xd((new Sessions())->get_session_data('user'));
                $this->route('/cidade');
            }
        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->route('/cidade');
        }
    }

    public function excluir(){
        $this->hasIdentify();
        $id = $this->getPost();

        #xd($id);
        if(!empty($id)){
            $id['id']= $this->dec($id['id']);
            $servico = new CidadeModel();
            $bool = $servico->exclui(['id_cidade'=>$id['id']]);
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