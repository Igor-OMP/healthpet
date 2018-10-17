<div class="container">
    <h2 class="text-center" style="margin: 50px auto 0">Cadastre sua PetShop!</h2>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php
            /**@var $form PetShopForm*/

            $form->createForm();
            if(isset($dados) && !empty($dados)):
            ?>

            <form action="<?=base_url('petshop/atualizar')?>" method="post" style="margin-bottom: 50px;">
                <?= $form->set('id_petshop')->setValue($dados['id_petshop'])->get()?>
                <fieldset>
                    <legend>Dados Básicos</legend>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="nm_petshop">Nome PetShop:</label>
                            <?= $form->set('nm_petshop')->setValue(ucwords($dados['nm_petshop']))->get()?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label for="nr_telefone">Telefone:</label>
                            <?= $form->set('nr_telefone')->setValue($dados['nr_telefone'])->get()?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="em_email">Email:</label>
                            <?= $form->set('em_email')->setValue($dados['em_email'])->get() ?>
                        </div>
                        <div class="col-md-1"></div>

                    </div>
                </fieldset>

                <fieldset>
                    <legend>Dados de Localização</legend>
                    <div class="form-group row">
                        <div class="col-md-5 col-md-offset-1">
                            <label for="nm_logradouro">Logradouro:</label>
                            <?= $form->set('nm_logradouro')->setValue($dados['nm_logradouro'])->get() ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label for="nr_cep">CEP:</label>
                            <?= $form->set('nr_cep')->setValue($dados['nr_cep'])->get() ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="nm_bairro">Bairro:</label>
                            <?= $form->set('nm_bairro')->setValue($dados['nm_bairro'])->get() ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label for="id_cidade">Cidade:</label>
                            <?= $form->set('id_cidade')->setValue($dados['id_cidade'])->get() ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="nm_complemento">Complemento:</label>
                            <?= $form->set('nm_complemento')->setValue($dados['nm_complemento'])->get() ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label for="nr_num">Número:</label>
                            <?= $form->set('nr_num')->setValue($dados['nr_num'])->get() ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Serviços Prestados</legend>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="id_servico">Serviços:</label>
                            <?= $form->set('id_servico')->setValue($dados['id_servico'])->get() ?>
                        </div>
                    </div>
                </fieldset>
                <hr>

                <div class="form-group row">
                    <div class="col-md-4 col-md-offset-3">
                        <button class="btn btn-primary">Enviar</button>
                    </div>
                    <div class="col-md-4">
                        <a  href="<?=base_url('petshop')?>" class="btn btn-default">Voltar</a>
                    </div>
                </div>
            </form>
            <?php
                    endif;
            ?>

        </div>
    </div>
</div>