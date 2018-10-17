<?php
if(!isset($_SESSION)){
    session_start();
}
$url = (isset($url)? $url:'#')
?>

<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <a href="<?= base_url('admin');?>" class="logo">
                <i class="ion-social-github" style="font-size: 70px;position: relative;top: 0;left: 20px;"></i>
        </div>
    </div>

    <!-- Navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <a href="<?=$this->redirect('/logout');?>" class="right-bar-toggle waves-effect waves-light"><i
                                class="glyphicon glyphicon-log-out"></i>&nbsp;Sair</a>
                    </li>

                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->


