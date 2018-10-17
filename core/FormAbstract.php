<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 23/10/2017
 * Time: 20:30
 */
class FormAbstract
{
    /** @var $form FormBuilder
     * @var $element
     */
    protected  $form;
    protected $elements;
    protected $element;
    protected $element_name;

    public function setData($data =[]){
        #xd($data);
       if(!is_array($data)){
           echo 'variável $data não é um array';
           die;
       }

      $this->form->setValues($data);

    }
    public function set($name){
        $this->element = $this->form->get($name,TRUE);
        $this->element_name = $this->element->getAttribute('name');
        return $this;
    }
    public function setValue($value){
            $this->element->setAttribute("value",$value);
            return $this;
    }
    public function get($element =null,$option = FALSE){
        if($element ==null)
            $element = $this->element_name;

        return $this->form->get($element,$option);
    }
    public function render(){
        $this->form->render();
    }
    public function createForm(){
        return $this->form->createForm();
    }
}