<!DOCTYPE html>
<html>
<head>
    <title>mobile Health Pet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="/assets/plugins/fullcalendar/dist/fullcalendar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/base-mobile.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/mobile/import.css')?>">

    <link href="/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/css/menu.css">
    <link href="/assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <link href="<?=base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="<?=base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')?>" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>

</head>


<body>

    <?php $this->loadViewTemplate($viewName,$viewData);?>


</body>
<script type="text/javascript" src="<?= base_url('assets/js/angular.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery-ui.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')?>"></script>

<script src="/assets/plugins/moment/moment.js"></script>
<script src="/assets/plugins/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="/assets/pages/jquery.fullcalendar.js"></script>

<!--MASCARAS-->
<script src="<?=base_url('assets/js/jquery.mask.min.js')?>"></script>
<script src="<?=base_url('assets/js/mask.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/app.js')?>"></script>
</html>