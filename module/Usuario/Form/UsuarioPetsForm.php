<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 27/10/2017
 * Time: 16:57
 */
class UsuarioPetsForm extends FormAbstract
{

    public function __construct()
    {
        $this->form= new FormBuilder('usuario-pets-form');
        $this->form->configure(
           ['prevent'=>['bootstrat','jQuery'],
            'action'=>BASE_URL.'usuario/salvar-pets',

           ]
        );

        $this->form->text('Nome do Pet:','nm_pet',['class'=>'form-control','placeholder'=>'Digite o nome no pet...']);
        $this->form->text('Data de Nasc.:','dt_nasc',['class'=>'form-control datepicker']);
        $this->form->select(
            'Espécie:',
            'id_especie',
            'EspecieModel',
            'getEspecies',
            ['value'=>'id_especie','option'=>'nm_especie'],
            [''=>''],
            ['class'=>'form-control']
        );
        $this->form->file('Foto:','ft_pet',['class'=>'file-loading','id'=>'ft_pet']);
        $this->form->radio('Porte','flag_porte',null,null,[],['1'=>'Pequeno','2'=>'Médio','3'=>'Grande'],['class'=>'radio','style'=>'opacity:1']);
    }

}