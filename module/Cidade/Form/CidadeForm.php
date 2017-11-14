<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 23/10/2017
 * Time: 23:08
 */
class CidadeForm extends  FormAbstract
{
    public function __construct()
    {
        $this->form = new FormBuilder('cidade-form');
        $this->form->configure(array("prevent" => array("bootstrap", "jQuery"),'action'=>BASE_URL.'cidade/salvar'));
        $this->form->hidden('id_cidade');

        $this->form->text('Nome da Cidade:','nm_cidade',['class'=>'form-control','placeholder'=>'Digite o nome da cidade aqui...']);

        $this->form->buttonsEnviarHome('/cidade/salvar','/cidade');
    }

}