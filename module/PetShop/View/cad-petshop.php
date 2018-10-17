<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon_1.ico')?>">

    <title>::HEALTH PET::</title>
    <link href="<?=base_url('assets/plugins/switchery/switchery.min.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/plugins/jquery-circliful/css/jquery.circliful.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/core.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/components.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/pages.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/menu.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/responsive.css')?>" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/buttons.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/fixedHeader.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/responsive.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/scroller.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />


    <!--<script src="<?/*=base_url('assets/js/modernizr.min.js')*/?>"></script>-->
    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <style>

    </style>
</head>


<body class="">

<!-- Begin page -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <!-- Start content -->
    <div class="container">
        <h2 class="text-center" style="margin: 50px auto 0">Cadastre sua PetShop!</h2>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php session_start();
                $form->createForm();

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
                    <hr>

                    <div class="form-group row">
                        <div class="col-md-4 col-md-offset-3">
                            <button class="btn btn-primary">Enviar</button>
                        </div>
                        <div class="col-md-4">
                            <a  href="<?=base_url()?>" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    var resizefunc = [];
    console.log( $("#wrapper").height() );
</script>


<!-- Plugins  -->
<script src="<?=base_url('assets/js/jquery-ui.min.js')?>"></script>
<script src="<?=base_url('assets/js/detect.js')?>"></script>
<script src="<?=base_url('assets/js/fastclick.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.slimscroll.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.blockUI.js')?>"></script>
<script src="<?=base_url('assets/js/waves.js')?>"></script>
<script src="<?=base_url('assets/js/wow.min.js');?>"></script>
<script src="<?=base_url('assets/js/jquery.nicescroll.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.scrollTo.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/switchery/switchery.min.js')?>"></script>

<!-- Counter Up  -->
<script src="<?=base_url('assets/plugins/waypoints/lib/jquery.waypoints.js')?>"></script>
<script src="<?=base_url('assets/plugins/counterup/jquery.counterup.min.js')?>"></script>

<!-- circliful Chart -->
<script src="<?=base_url('assets/plugins/jquery-circliful/js/jquery.circliful.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')?>"></script>

<!-- skycons -->
<script src="<?=base_url('assets/plugins/skyicons/skycons.min.js')?>" type="text/javascript"></script>

<!-- Page js  -->
<script src="<?=base_url('assets/pages/jquery.dashboard.js')?>"></script>
<!--MASCARAS-->
<script src="<?=base_url('assets/js/jquery.mask.min.js')?>"></script>
<script src="<?=base_url('assets/js/mask.js')?>"></script>
<!-- Custom main Js -->
<script src="<?=base_url('assets/js/jquery.core.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.app.js')?>"></script>





<script>
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
        $('.circliful-chart').circliful();

    });

    // BEGIN SVG WEATHER ICON
    if (typeof Skycons !== 'undefined'){
        var icons = new Skycons(
            {"color": "#3bafda"},
            {"resizeClear": true}
            ),
            list  = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for(i = list.length; i--; )
            icons.set(list[i], list[i]);
        icons.play();
    };


    function chamadaAjax(params){
        $.ajax({
            type: params.type,
            dataType: params.dataType,
            url: params.url,
            cache: false,
            async: true,
            data: {

            },

            beforeSend: function () {
                carregar()
            },
            success: function (data) {
                if (data.resposta == false) {
                    window.location.href = '';
                }
                $('#pagination').html(data);
            }, error: function (xhr, ajaxOptions, thrownError) {
                var httpCode = xhr.status;
                alert(httpCode + ': ' + thrownError);
            }

        });
    }

</script>

</body>
</html>