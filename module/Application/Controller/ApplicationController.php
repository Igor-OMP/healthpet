<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 31/10/2017
 * Time: 12:45
 */
class ApplicationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update_message(){
        $this->hasIdentify();
        $this->loadView('layout/admin/messages');
    }
}