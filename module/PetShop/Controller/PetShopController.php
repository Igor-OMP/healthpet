<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 22/10/2017
 * Time: 21:12
 */
class PetShopController extends Controller
{

    protected $form;
    public function __construct()
    {
        parent::__construct();
        $this->data['message']='PetShop';
    }

    public function index(){
        $this->hasIdentify();
        $this->loadTemplate('index');
    }

    public function pagination(){
        $this->hasIdentify();

        $servico = new PetShopModel();
        $this->data['petshops'] = $servico->All();
        #$this->data['model'] = $servico;
        $this->loadView('index_pagination');
    }
    public function modal(){
        $this->hasIdentify();
        $servico = new PetShopModel();

        $id['id_petshop']= $this->dec($this->getPost('id_petshop'));
        $this->data['dados']= $servico->getById($id);
        $this->data['endereco']= fabric('EnderecoModel');
        $this->data['cidade']= fabric('CidadeModel');
        $this->data['petserv']= fabric('PetShopServicoModel');
        $this->data['servico']= fabric('ServicoModel');
        $this->loadView('modal');
    }


    public function cadastrar($params =null){
        $this->hasIdentify();

        if($params != null){
            $id = $this->dec($params);
            $model = new PetShopModel();
            $data = $model->getById(['id_petshop'=>$id]);
            $data['id_petshop'] = $this->enc($data['id_petshop']);
            #xd($this->form);
            $this->form->setData($data);
            #xd($data);
        }
        $this->data['form']= $this->form;
        $this->loadTemplate('cad');
    }

    public function salvar(){
        $this->hasIdentify();

        $post = $this->getPost();
        $bool= null;

        foreach($post as $key =>$value){

            if($value == null)
                unset($post[$key]);
        }

        #x($post);
        $petshop = fabric('PetShopModel');

        #xd($petshop->filtrar(['nm_petshop'=>$post['nm_petshop']]));
        if($petshop->filtrar(['nm_petshop'=>$post['nm_petshop']]) > 0){
            $this->addMessage(['status'=>'DANGER','msg'=>'informações já cadastradas no banco de dados']);
            $this->route('/petshop');
        }


        if(!empty($post)){
            if(isset($post['id_petshop']) && !empty($post['id_petshop'])){
                $post['id_petshop'] = $this->dec($post['id_petshop']);
            }

            $obj_endereco = [
                'nm_logradouro'=>$post['nm_logradouro'],
                'nm_bairro'=>$post['nm_bairro'],
                'nr_cep'=>$post['nr_cep'],
                'nm_complemento'=>$post['nm_complemento'],
                'id_cidade'=>$post['id_cidade'],
                'nr_num'=>(isset($post['nr_num'])?$post['nr_num']:'')
            ];
            $servico= fabric('EnderecoModel');

            $id_endereco = $servico->salvar($obj_endereco);

            if($id_endereco != null){
                $obj_petShop =[
                    'nm_petshop'=> strtolower($post['nm_petshop']),
                    'nr_telefone'=>$post['nr_telefone'],
                    'em_email'=>$post['em_email'],
                    'id_endereco'=>$id_endereco
                ];

                $servico = new PetShopModel();
                $id_petshop = $servico->salvar($obj_petShop);

                if($id_petshop != null){
                    $servicos = $post['id_servico'];
                    $servico = fabric('PetShopServicoModel');

                    foreach($servicos as $serv){
                       $bool= $servico->salvar([
                            'id_petshop'=>$id_petshop,
                            'id_servico'=>$serv
                        ]);
                    }

                    if($bool != null){
                        $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                        #xd((new Sessions())->get_session_data('user'));
                        $this->route('/petshop');
                    }else{
                        $this->addMessage(['status'=>'WARNING','msg'=>'Problemas ao gravar serviços do petshop']);
                        $this->data['form']= $this->form->setData($post);
                        $this->route('/petshop/cadastrar');
                    }

                }else{/*Caso de erro ao gravar  petshop*/
                    $this->addMessage(['status'=>'WARNING','msg'=>'Problemas ao gravar PetShop']);
                    $this->data['form']= $this->form->setData($post);
                    $this->route('/petshop/cadastrar');
                }
            }else{/*Caso de erro ao gravar endereco*/
                $this->addMessage(['status'=>'WARNING','msg'=>'Problemas ao gravar Endereco']);
                $this->data['form']= $this->form->setData($post);
                $this->route('/petshop/cadastrar');
            }

        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->data['form']= $this->form->setData($post);
            $this->route('/petshop/cadastrar');
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


    public function cadastrar_petshop(){

        $this->data['form'] = new PetShopCadForm();
        $this->loadViewTemplate('cad-petshop');
    }

}