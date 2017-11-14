<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 20/10/2017
 * Time: 12:14
 */
class UsuarioForm extends FormAbstract
{
    protected $form;

    public function __construct($id='usuario_form')
    {
        $this->form = new FormBuilder($id);
        $this->form->configure(array("prevent" => array("bootstrap", "jQuery"),'action'=>BASE_URL.'usuario/salvar'));
        $this->form->hidden('id_usuario');
        $this->form->text('Nome:','nm_usuario',['placeholder'=>'Escreva seu nome aqui','requided'=>1,'class'=>'form-control']);
        $this->form->email('Email:','em_email',['placeholder'=>'Digite o email aqui.','requided'=>1,'class'=>'form-control']);
        $this->form->telefone('Celular:','nr_tel',['placeholder'=>'Digite o telefone aqui.',
            'requided'=>1,'class'=>'form-control phone_with_ddd']);
        #$this->form->button('Enviar',"");
       # $this->form->button('Cancelar',"button",['on-click'=>'history.go(-1)','style'=>'float:right;']);
        $this->form->password('Senha:','pw_pass',[
            'placeholder'=>'Digite a senha aqui...',
            'class'=>'form-control']);
        $this->form->buttonsEnviarHome('','/usuario');

       // $this->form->createForm();

    }

}