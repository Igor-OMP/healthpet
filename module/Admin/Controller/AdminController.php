<?php


class AdminController extends \Controller
{
    public function index($data = null)
    {
        $this->hasIdentify();
        $data=$_SESSION['user'];
        $this->data['message']='Bem-Vindo '.ucwords($data['nm_user']);
        //$get = $this->getRequest();
        $this->loadTemplate('index', ['message'=>'TESTE']);
    }

}