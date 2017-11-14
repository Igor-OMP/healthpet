<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 23/10/2017
 * Time: 20:30
 */
class FormAbstract
{
    /**@var FormBuilder*/
    protected  $form;
    protected $elements;

    public function setData($data =[]){
        #xd($data);
       if(!is_array($data)){
           echo 'variável $data não é um array';
           die;
       }

      $this->form->setValues($data);

    }

    public function get($element){
        return $this->form->get($element);
    }
    public function render(){
        $this->form->render();
    }
    public function createForm(){
        return $this->form->createForm();
    }
}