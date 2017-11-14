<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 24/10/2017
 * Time: 01:45
 */
class EspecieForm extends FormAbstract
{
    public function __construct()
    {
        $this->form = new FormBuilder('especie-form');
        $this->form->configure(array("prevent" => array("bootstrap", "jQuery"),'action'=>BASE_URL.'especie/salvar'));
        $this->form->hidden('id_especie');
        $this->form->text('Nome da Espécie:','nm_especie',['class'=>'form-control']);
        $this->form->buttonsEnviarHome('/especie/salvar','/especie');
    }

}