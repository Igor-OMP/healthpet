<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 22/10/2017
 * Time: 21:31
 */
class ServicoController extends Controller
{
    /**@var FormBuilder*/
    protected $form;
    public function __construct()
    {
        parent::__construct();
        $this->data['message']='Serviços';
    }

    public function index(){
        $this->hasIdentify();
        $this->loadTemplate('index');
    }

    public function pagination(){
        $this->hasIdentify();

        $servico = new ServicoModel();
        $this->data['servico'] = $servico->All();
        $this->data['model'] = $servico;
        $this->loadView('index_pagination');
    }

    public function cadastrar($params =null){
        $this->hasIdentify();

        if($params != null){
          $id = $this->dec($params);
          $model = new ServicoModel();
          $data = $model->getById(['id_servico'=>$id]);
          $data['id_servico'] = $this->enc($data['id_servico']);
            #x($this->form);
          $this->form->setData($data);
          #xd($data);

        }
        $this->data['form']= $this->form;
        $this->loadTemplate('cad');
    }

    public function salvar(){
        $this->hasIdentify();

        $post = $this->getPost();
        #x($post);
        foreach($post as $key =>$value){

            if($value == null)
                unset($post[$key]);
        }

        #xd($post);

        if(!empty($post)){
            if(isset($post['id_servico'])&& !empty($post['id_servico'])){
                $post['id_servico']= $this->dec($post['id_servico']);
            }
            $post['nm_servico'] = strtolower($post['nm_servico']);
            $servico =new ServicoModel();


           if($servico->filtrar(['nm_servico'=>$post['nm_servico']])){
               $this->addMessage(['status'=>'DANGER','msg'=>'informações já cadastradas no banco de dados']);
               $this->route('/servico');
           }

            $bool = $servico->salvar($post);
            if($bool){
                $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                #xd((new Sessions())->get_session_data('user'));
                $this->route('/servico');
            }
        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->route('/servico');
        }
    }

    public function excluir(){
        $this->hasIdentify();
        $id = $this->getPost();

        if(!empty($id)){
            $id['id_servico']= $this->dec($id['id_servico']);
            $servico = new ServicoModel();
            $bool = $servico->exclui($id);
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