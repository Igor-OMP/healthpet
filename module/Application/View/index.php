<?php
$footer = (isset($login))?$login:false;
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Igor Oliveira">

    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon_1.ico')?>">

    <title>::HEALTH PET::</title>
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/plugins/switchery/switchery.min.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/plugins/jquery-circliful/css/jquery.circliful.css')?>" rel="stylesheet" type="text/css" />

    <link href="<?=base_url('assets/css/core.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/components.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/pages.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/menu.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/responsive.css')?>" rel="stylesheet" type="text/css">

    <!--SWEET ALERTS-->
    <link href="<?=base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')?>" rel="stylesheet" type="text/css">

    <!--DatePicker-->
    <link href="/assets/plugins/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- DataTables -->
    <link href="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/buttons.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/fixedHeader.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/responsive.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/plugins/datatables/scroller.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />

    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/js/modernizr.min.js')?>"></script>





    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>


<body class="fixed-left widescreen">

<!-- Begin page -->
<?php
if(!$footer){ ?>


<div id="wrapper">
    <?php
    }

    global $render;
    if($render == true){
        $this->render('layout/menu');
        $this->render('layout/admin/side-bar',$viewData);
        #xd($_SESSION);

    }
    ?>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <!-- Start content -->
    <?php if(!$footer):

    ?>
<div class="content-page">

    <div class="content">

        <?php
        endif;



        if(isset($login) && $login == true){
            echo '&nbsp;';
        }else{
            $this->render('layout/admin/breadcamp',['message'=>$message]);
        }
        ?>
        <div id="message_system">
            <?php
                /*MENSAGENS DO SISTEMA*/
                if(isset($_SESSION['flash_message'])){

                    $this->render('layout/admin/messages',['msg'=>$_SESSION['flash_message']]);
                }
            ?>
        </div>
        <?php
        $this->loadViewTemplate($viewName,$viewData,(isset($controller)? $controller : null))
        ?>

    </div>

    <?php
    if(!$footer):?>

    <?php
        $this->render('layout/footer');
    endif;
    ?>
</div>


</div>

<script>
    var resizefunc = [];
    console.log( $("#wrapper").height() );
</script>


<!-- Plugins  -->
<script src="<?=base_url('assets/js/jquery-ui.min.js')?>"></script>
<script src="<?=base_url('assets/js/fileinput.min.js')?>"></script>
<script src="<?=base_url('assets/js/detect.js')?>"></script>
<script src="<?=base_url('assets/js/fastclick.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.slimscroll.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.blockUI.js')?>"></script>
<script src="<?=base_url('assets/js/waves.js')?>"></script>
<script src="<?=base_url('assets/js/wow.min.js');?>"></script>
<script src="<?=base_url('assets/js/jquery.nicescroll.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.scrollTo.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/switchery/switchery.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.blockUI.js')?>"></script>

<!-- Sweet-Alert  -->
<script src="<?= base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')?>"></script>

<!--DatePicker-->
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
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

    function updateMessege(){
        $.ajax({
            type:"post",
            dataType:"text",
            url:'/application/update-message',
            async:true,
            cache:false,
            data:{},
            success: function(data){
                $("#message_system").html(data);
            }
        });
    }

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