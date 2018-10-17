<aside class="col-md-3">
    <div class="row">
        <div class="tabela-sortimento col-md-12"><!-- Inicio  da Tabela de  Sortimento-->

            <div class="sep-sort" role="tabpanel">
                   <span class="text-center"> Navegue pelas sessões de <br>sortimento</span>
            </div>
            <div class="sort-categ">
                <ul class="category">
                    <li><a href="#">Básico </a> <span> + </span></li>
                    <li><a href="#">Bebidas </a><span> + </span></li>
                    <li><a href="#">Mercearia </a><span> + </span></li>
                    <li><a href="#">Mercearia Doce</a><span> + </span></li>
                    <li><a href="#">Higiene </a><span> + </span></li>
                    <li><a href="#">Farelos e Massas </a><span> + </span></li>
                    <li><a href="#">Escolar </a><span> + </span></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="tabela-sortimento col-md-10"><!-- Inicio  da Tabela de  Sortimento-->

            <div class="sep-sort" role="tabpanel">
                Cadastre e receba as noticias pelo email e pelo celular
            </div>
            <div class="sort-categ">
                <form action="<?=$this->redirect(['controller'=>'Cliente','action'=>'gravarCliente'])?>" method="post">
                    <div class="form-group">
                        <label for="nm_cliente"><h4>Nome:</h4></label>
                        <input type="text" class="form-control col-md-12" placeholder="Seu nome aqui..."
                               id="nm_cliente" name="nm_cliente">
                    </div>
                    <div class="form-group">
                        <label for="em_email"><h4>Email:</h4></label>
                        <input type="email" class="form-control col-md-12" placeholder="Seu email aqui..."
                               id="em_email" name="em_email">
                    </div>
                    <div class="form-group">
                        <label for="tel_cliente"><h4>Telefone:</h4></label>
                        <input type="telefone" class="form-control col-md-12 telefone"
                               placeholder="Seu telefone aqui..." id="telefone"  name="nr_telefone_celular">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary col-md-4 ">Cadastrar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</aside>