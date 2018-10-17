<?php
$msg = (isset($message) && !empty($message))? $message : 'Bem-Vindo '. ucwords($user['nm_user']);

?>

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <!--<ol class="breadcrumb pull-right">
                <li><a href="#">Minton</a></li>
                <li class="active">Dashboard</li>
            </ol>-->
            <h3 class="page-title"><?=$msg;?></h3>
        </div>
    </div>
</div>
<!-- end row -->