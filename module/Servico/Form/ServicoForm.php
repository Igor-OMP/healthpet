<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 22/10/2017
 * Time: 21:40
 */

class ServicoForm extends FormAbstract
{
    protected $form;

    public function __construct($id='servico-form')
    {

        $this->form = new FormBuilder($id);
        $this->form->configure(array("prevent" => array("bootstrap", "jQuery"),'action'=>BASE_URL.'servico/salvar'));
        $this->form->hidden('id_servico');

        $this->form->text('Nome do Servico:','nm_servico',['class'=>'form-control','placeholder'=>'Digite o nome do servico aqui...']);
        $this->form->select(
            'Serviços Pai:',
            'id_servico_pai',
            'ServicoModel',
            'getServicos',
            ['value'=>'id_servico','option'=>'nm_servico'],
            [''=>''],
            ['class'=>'form-control']);
        $this->form->buttonsEnviarHome('/servico/salvar','/servico');

    }


}