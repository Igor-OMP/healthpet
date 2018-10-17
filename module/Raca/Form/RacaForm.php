<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 24/10/2017
 * Time: 01:30
 */
class RacaForm extends FormAbstract
{
    public function __construct()
    {
        $this->form = new FormBuilder('raca-form');
        $this->form->configure(array("prevent" => array("bootstrap", "jQuery"),'action'=>BASE_URL.'raca/salvar'));
        $this->form->hidden('id_raca');
        $this->form->text('Nome da Raça:','nm_raca',['class'=>'form-control']);
        $this->form->select(
            'Espécie',
            'id_especie',
            'EspecieModel',
            'getEspecies',
            ['value'=>'id_especie','option'=>'nm_especie'],
            [''=>''],
            ['class'=>'form-control']
        );
        $this->form->buttonsEnviarHome('/raca/salvar','/raca');

    }
}