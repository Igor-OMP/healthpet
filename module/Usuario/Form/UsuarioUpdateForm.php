<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 26/10/2017
 * Time: 18:15
 */
class UsuarioUpdateForm extends FormAbstract
{
    protected $form;

    public function __construct($id='usuario_form')
    {
        $this->form = new FormBuilder($id);
        $this->form->configure(array("prevent" => array("bootstrap", "jQuery"),'action'=>BASE_URL.'usuario/atualizar'));
        $this->form->hidden('id_usuario');
        $this->form->text('Nome:','nm_usuario',['placeholder'=>'Escreva seu nome aqui','requided'=>1,'class'=>'form-control']);
        $this->form->email('Email:','em_email',['placeholder'=>'Digite o email aqui.','requided'=>1,'class'=>'form-control']);
        $this->form->telefone('Telefone:','nr_tel',['placeholder'=>'Digite o telefone aqui.',
            'requided'=>1,'class'=>'form-control phone_with_ddd']);
        #$this->form->button('Enviar',"");
        # $this->form->button('Cancelar',"button",['on-click'=>'history.go(-1)','style'=>'float:right;']);
        $this->form->password('Senha Atual:','pw_pass',[
            'placeholder'=>'Digite a senha aqui...',
            'class'=>'form-control',
            'shortDesc'=>'Não é possível  visualizar a senha pois já está criptografada.'
        ]);
        $this->form->password('Nova Senha:','pw_senha',[
            'placeholder'=>'Digite a senha aqui...',
            'class'=>'form-control']);
        $this->form->buttonsEnviarHome('','/usuario');

        // $this->form->createForm();

    }

}