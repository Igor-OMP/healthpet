<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 31/10/2017
 * Time: 13:11
 */
class PetShopForm extends FormAbstract
{

    protected $form;
    public function __construct($id='pet-shop-form')
    {

        $this->form = new FormBuilder($id);
        $this->form->configure([
            'prevent'=>['bootstrap','jquery'],
            'action'=>BASE_URL.'petshop/salvar'
        ]);
        $this->form->hidden('id_petshop');
        $this->form->text('Nome do PetShop:','nm_petshop',['class'=>'form-control','placeholder'=>'Digite o nome do petshop aqui...']);
        $this->form->text('Logradouro:','nm_logradouro',[
            'class'=>'form-control',
            'placeholder'=>'(Quadra, Rua, Avenida  e etc)'
        ]);
        $this->form->text('Bairro:','nm_bairro',[
            'class'=>'form-control',
            'placeholder'=>'Digite o nome bairro '
        ]);
        $this->form->text('Complemento:','nm_complemento',[
            'class'=>'form-control',
            'placeholder'=>'Ex: Lote 06 casa 01 '
        ]);
        $this->form->text('Número:','nr_num',[
            'class'=>'form-control',
            'placeholder'=>'Ex: apt 101, lote 06 e etc'
        ]);
        $this->form->text('CEP:','nr_cep',[
            'class'=>'form-control cep',
            'placeholder'=>'Ex: 99999999',
            'shortDesc'=>'Não precisa inserir pontos e hífen'
        ]);

        $this->form->checkbox(
            'Serviços',
            'id_servico',
            'ServicoModel',
            'getServicos',
            ['value'=>'id_servico','option'=>'nm_servico'],
            ['class'=>'checkbox', 'style'=>'opacity:1;']
            );

        $this->form->telefone('Telefone:','nr_telefone',[
            'class'=>'form-control phone_with_ddd_old',
            'required'=>1,
            'placeholder'=>'Ex: (61) 99999-9999',
            'shortDesc'=>'Não precisa inserir pontos e hífen'
        ]);
        $this->form->email('Email:','em_email',[
            'class'=>'form-control',
            'required'=>1,
            'placeholder'=>'Ex: example@example.com'
        ]);
        $this->form->select(
            'Cidade',
            'id_cidade',
            'CidadeModel',
            'getCidades',
            ['value'=>'id_cidade','option'=>'nm_cidade'],
            [''=>''],
            ['class'=>'form-control']
        );

    }
}