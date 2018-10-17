<div class="container">
    <h2 class="text-center" style="margin: 50px auto 0">Cadastre sua PetShop!</h2>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php
            $form->createForm();

            if(isset($data)){
                xd($data);
            }
            ?>

            <form action="<?=base_url('petshop/salvar')?>" method="post" style="margin-bottom: 50px;">

                <fieldset>
                    <legend>Dados Básicos</legend>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="nm_petshop">Nome PetShop:</label>
                            <?= $form->get('nm_petshop') ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label for="nm_petshop">Telefone:</label>
                            <?= $form->get('nr_telefone') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="nm_petshop">Email:</label>
                            <?= $form->get('em_email') ?>
                        </div>
                        <div class="col-md-1"></div>

                    </div>
                </fieldset>

                <fieldset>
                    <legend>Dados de Localização</legend>
                    <div class="form-group row">
                        <div class="col-md-5 col-md-offset-1">
                            <label for="nm_petshop">Logradouro:</label>
                            <?= $form->get('nm_logradouro') ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label for="nm_petshop">CEP:</label>
                            <?= $form->get('nr_cep') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="nm_petshop">Bairro:</label>
                            <?= $form->get('nm_bairro') ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label for="nm_petshop">Cidade:</label>
                            <?= $form->get('id_cidade') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="nm_petshop">Complemento:</label>
                            <?= $form->get('nm_complemento') ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label for="nm_petshop">Número:</label>
                            <?= $form->get('nr_num') ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Serviços Prestados</legend>
                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-1">
                            <label for="id_servico">Serviços:</label>
                            <?= $form->get('id_servico') ?>
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
        </div>
    </div>
</div>
