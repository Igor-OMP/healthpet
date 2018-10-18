<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 28/11/2016
 * Time: 13:17
 */


class LoginController extends \Controller
{
    public function login()
    {
        $this->terminal(false);
        $user = (new Sessions())->get_session_data('user');
        $data = [
            'login' => true,
            'user'=>$user,
            'login_class'=>TRUE
        ];
        $this->loadTemplate('login', $data);
    }

    public function autenticar()
    {

        try {

            $post = $this->getPost();
            $post['senha'] = md5($post['senha']);
            $loginModel = new LoginModel();
            $dados = $loginModel->autenticar($post);


            if($dados != NULL){
                $dados['adm']=true;
                $session = new Sessions();
                $session->create_session('user', $dados, true);
                $session->set_session_id();
                #$this->setSession($session);

                $url =  $this->redirect('/admin');
            }else{
                $url =  $this->redirect('/login');
            }

            $this->route($url);

        } catch (Exception $e) {
            echo ' erro ao autencicar';
        }
    }

    public function autenticarAdm()
    {
        try {
            $post = $this->getPost();
            #xd($post);

            $loginModel = new LoginModel();
            $dados = $loginModel->autenticarAdm($post);
            #xd($dados);

            if($dados != NULL){

                #$dados['associ_nome']=$dados['user_name'];
                $dados['associ_nome']=$dados['usr_login'];
                $dados['adm']=true;
                $session = new Sessions();
                $session->create_session('user', $dados, true);
                $session->set_session_id();
                #$this->setSession($session);

                $url =  $this->redirect(['controller' => 'Admin', 'action' => 'index']);

            }else{
                $url =  $this->redirect(['action' => 'loginAdm']);
            }

            $this->route($url);

        } catch (Exception $e) {
            echo ' erro ao autencicar';
        }
    }

    public function logout($url = '/login')
    {


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

}