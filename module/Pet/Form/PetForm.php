<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 16/11/2017
 * Time: 13:22
 */
class PetForm extends FormAbstract
{
    public  function __construct()
    {
        $this->form = new FormBuilder('pet-form');
        $this->form->configure(array("prevent" => array("bootstrap", "jQuery"),'action'=>BASE_URL.'pet/salvar'));
        $this->form->hidden('id_pet');
        $this->form->hidden('id_usuario');
        $this->form->text('Nome do Pet:','nm_pet',['class'=>'form-control']);
        $this->form->select(
            'Espécie',
            'id_especie',
            'EspecieModel',
            'getEspecies',
            ['value'=>'id_especie','option'=>'nm_especie'],
            [''=>''],
            ['class'=>'form-control']
        );

        $this->form->date('Data Nasc.:','dt_nasc',['class'=>'form-control']);
        $this->form->radio('Porte:','flag_porte',null,null,null,['1'=>'Pequeno','2'=>'Médio','3'=>'Grande'],['style'=>'opacity:1']);
        $this->form->file('Foto','ft_pet',['class'=>'form-control file-loading','id_ft_pet']);
        $this->form->buttonsEnviarHome('/pet/salvar','/pet');

    }

}