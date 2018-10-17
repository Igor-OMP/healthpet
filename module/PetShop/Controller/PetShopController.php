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
       $url = 'cad-2';
        if($params != null){
            $id = $this->dec($params);
            $model = new PetShopModel();
            $data = $model->getById(['id_petshop'=>$id]);
            $data['id_petshop'] = $this->enc($data['id_petshop']);
            $end = new EnderecoModel();
            $end = $end->getById(['id_endereco'=>$data['id_endereco']]);
            $serv  = new PetShopServicoModel();

            $serv = $serv->where(['id_petshop'=>$id],'id_servico');

            #xd($serv);
            if(!empty($serv)){
                foreach($serv as $item){
                    $check['id_servico'][]=$item['id_servico'];
                }
            }

            #xd($check);

            $data= array_merge($data,$end);
            if(!empty($check)){
                $data = array_merge($data,$check);
            }

            #xd($this->form);
            $this->data['dados']=$data;

            $url = 'cad';
            #xd($data);
        }
        $this->data['form']= $this->form;
        $this->loadTemplate($url);
    }

    public function salvar(){
        $this->hasIdentify();

        $post = $this->getPost();
        $bool= null;

        foreach($post as $key =>$value){
            if($value == null)
                unset($post[$key]);
        }

        $petshop = new PetShopModel();

        #xd($petshop->filtrar(['nm_petshop'=>$post['nm_petshop']]));
        if($petshop->filtrar(['nm_petshop'=>$post['nm_petshop']]) > 0){
            $this->addMessage(['status'=>'DANGER','msg'=>'informações já cadastradas no banco de dados']);
            $this->route('/petshop');
        }
        if(!empty($post)){

            $obj_endereco = [
                'nm_logradouro'=>$post['nm_logradouro'],
                'nm_bairro'=>$post['nm_bairro'],
                'nr_cep'=>$post['nr_cep'],
                'nm_complemento'=>$post['nm_complemento'],
                'id_cidade'=>$post['id_cidade'],
                'nr_num'=>(isset($post['nr_num'])?$post['nr_num']:'')
            ];

            $servico= new EnderecoModel();
            $id_endereco = $servico->salvar($obj_endereco);

            if($id_endereco != null){
                $obj_petShop =[
                    'nm_petshop'=> strtolower($post['nm_petshop']),
                    'nr_telefone'=>$post['nr_telefone'],
                    'em_email'=>strtolower($post['em_email']),
                    'id_endereco'=>$id_endereco
                ];

                $servico = new PetShopModel();
                $id_petshop = $servico->salvar($obj_petShop);

                if($id_petshop && !empty($post['id_servico'])){
                    $servicos = $post['id_servico'];
                    $servico =new PetShopServicoModel();

                    foreach($servicos as $serv){
                       $bool= $servico->salvar([
                            'id_petshop'=>$id_petshop,
                            'id_servico'=>$serv
                        ]);

                        if(is_array($bool)){
                            $this->addFlashMessage(Controller::MSG_DANGER,'Não foi possivel atualizar sistema:'. $bool['error']);
                            $this->toRoute('/petshop/cadastro/'.$this->enc($post['id_petshop']));
                        }else{
                            $bool = true;
                        }
                    }


                    if($bool == true){
                        $this->addMessage(['status'=>'SUCCESS','msg'=>'Informações gravadas com sucesso.']);
                        #xd((new Sessions())->get_session_data('user'));
                        $this->route('/petshop');
                    }else{
                        $this->addMessage(['status'=>'WARNING','msg'=>'Problemas ao gravar serviços de petshop:'.$bool['error_message']]);
                        $this->data['data']= $post;
                       $this->loadTemplate('cad-2');
                    }

                }else{/*Caso de erro ao gravar  petshop*/
                    $this->addMessage(['status'=>'WARNING','msg'=>'Problemas ao gravar PetShop:'.$id_petshop['error_message']]);
                    $this->data['data']= $post;
                    $this->route('/petshop/cadastrar');
                }
            }else{/*Caso de erro ao gravar endereco*/
                $this->addMessage(['status'=>'WARNING','msg'=>'Problemas ao gravar Endereco']);
                $this->data['data']= $post;
                $this->route('/petshop/cadastrar');
            }

        }else{
            $this->addMessage(['status'=>'WARNING','msg'=>'Informações não puderam ser gravadas.']);
            $this->data['data']= $post;
            $this->loadTemplate('cad');
        }
    }

    public function atualizar(){
        $this->hasIdentify();

        if($this->isPost()){
            $post = $this->getPost();
            $post['id_petshop'] = $this->dec($post['id_petshop']);

            $obj_serv = $post['id_servico'];

            /*Instanciando PetShopModel*/
            $model = new PetShopModel();
            $data = $model->getById(['id_petshop'=>$post['id_petshop']]);

            $obj_petshop =[
                'id_petshop'=>$post['id_petshop'],
                'nm_petshop'=> strtolower($post['nm_petshop']),
                'nr_telefone'=>$post['nr_telefone'],
                'em_email'=>strtolower($post['em_email']),
                'id_endereco'=>$data['id_endereco']
            ];
            $bool = $model->salvar($obj_petshop);
            if(is_array($bool)){
                $this->addFlashMessage(Controller::MSG_DANGER,'Não foi possivel atualizar sistema:'. $bool['error']);
                $this->toRoute('/petshop/cadastro/'.$this->enc($post['id_petshop']));
            }

            /*Instanciando EnderecoModel*/
            $model= new EnderecoModel();
            $obj_end =[
                'id_endereco'=>$data['id_endereco'],
                'nm_logradouro'=>$post['nm_logradouro'],
                'nm_bairro'=>$post['nm_bairro'],
                'nr_cep'=>$post['nr_cep'],
                'nm_complemento'=>$post['nm_complemento'],
                'id_cidade'=>$post['id_cidade'],
                'nr_num'=>(isset($post['nr_num'])?$post['nr_num']:'')
            ];
             $bool = $model->salvar($obj_end);

            if(is_array($bool)){
                $this->addFlashMessage(Controller::MSG_DANGER,'Não foi possivel atualizar sistema:'. $bool['error']);
                $this->toRoute('/petshop/cadastro/'.$this->enc($post['id_petshop']));
            }

            /*Instanciando PetShopServicoModel*/
            $model=  new PetShopServicoModel();
            /*Exclindo os servicos vinculados ao petshop */
            $model->exclui(['id_petshop'=>$post['id_petshop']]);

            foreach($obj_serv  as $serv){
               $bool =  $model->salvar([
                    'id_petshop'=>$post['id_petshop'],
                    'id_servico'=>$serv
                ]);

                if(is_array($bool)){
                    $this->addFlashMessage(Controller::MSG_DANGER,'Não foi possivel atualizar sistema:'. $bool['error']);
                    $this->toRoute('/petshop/cadastro/'.$this->enc($post['id_petshop']));
                }

            }
            $this->addFlashMessage(Controller::MSG_SUCCESS,'Dados petshop atualizados com sucesso');
            $this->toRoute('/petshop');
        }
        $this->toRoute('/petshop/cadastro/'.$this->enc($post['id_petshop']));
    }

    public function excluir(){
        $this->hasIdentify();
        $id = $this->getPost();

        if(!empty($id)){
            $id['id_petshop']= $this->dec($id['id_petshop']);

            $model=  new PetShopServicoModel();
            /*Exclindo os servicos vinculados ao petshop */
            $bool = $model->exclui($id);

            if(is_array($bool)){
                $this->addFlashMessage(Controller::MSG_DANGER,'Não foi possivel excluir  em petshop_servicos:'. $bool['error']);
                echo false;
                die;
            }

            $servico = new PetShopModel();
            $data = $servico->getById($id);
            $bool = $servico->exclui($id);

            if(is_array($bool)){
                $this->addFlashMessage(Controller::MSG_DANGER,'Não foi possivel excluir em petshop:'. $bool['error']);
                echo false;
                die;
            }

            $model= new EnderecoModel();
            $bool = $model->exclui(['id_endereco'=>$data['id_endereco']]);
            if(is_array($bool)){
                $this->addFlashMessage(Controller::MSG_DANGER,'Não foi possivel excluir em endereco:'. $bool['error_message']);
                echo false;
                die;
            }

            if($bool){
                $this->addFlashMessage(Controller::MSG_SUCCESS,'Informações excluidas com sucesso');
                echo true;
            }
        }else{
            $this->addFlashMessage(Controller::MSG_DANGER,'Informações não puderam ser excluídas.');
            echo false;
        }
    }


    public function cadastrar_petshop(){

        $this->data['form'] = new PetShopCadForm();
        $this->loadViewTemplate('cad-petshop');
    }

}