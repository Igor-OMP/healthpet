<?php
if(isset($_SESSION['user']))
    $user= $_SESSION['user'];

?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Menu Principal</li>

                <li class="active">
                    <a href="<?=base_url('admin');?>" class="waves-effect waves-primary active"><i class="md md-dashboard"></i><span> Painel Principal </span></a>
                </li>
                <!--MENU USUARIOS-->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-group"></i>
                        <span>Usuários</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="list-unstyled">
                        <li><a href="<?=base_url('usuario');?>" style="cursor: pointer">Visualizar</a></li>
                       <!--<li><a href="#" style="cursor: pointer" id="">Pets</a></li>-->
                        <!--<li><a href="#" style="cursor: pointer" id="">Agenda</a></li>-->
                    </ul>
                </li>

                <!--MENU PETSHOP-->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-home"></i>
                        <span>PetShop</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="list-unstyled">
                        <li><a href="<?=base_url('petshop')?>" style="cursor: pointer">Visualizar</a></li>
                       <!--<li><a href="#" style="cursor: pointer" id="">Serviços</a></li>-->
                       <!--<li><a href="#" style="cursor: pointer" id="">Agenda</a></li>-->
                    </ul>
                </li>

                <!--MENU PETS-->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-github-alt"></i>
                        <span>Pets</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="list-unstyled">
                        <li><a href="<?=base_url('pet')?>" style="cursor: pointer">Visualizar</a></li><!--
                        <li><a href="#" style="cursor: pointer" id="">Agenda</a></li>-->
                        <li><a href="#" style="cursor: pointer" id="">Histórico</a></li>
                    </ul>
                </li>

                <!--MENU CONFIGURAÇÕES-->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-gears"></i>
                        <span>Configurações</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="list-unstyled">
                        <li class="has_sub">
                            <a href="javascript:void(0);"  style="cursor: pointer">
                                <span>Animais</span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul class="list-unstyled">
                                <li><a href="<?=base_url('especie')?>">Espécies</a></li>
                                <li><a href="<?=base_url('raca')?>">Raças</a></li>
                            </ul>
                        </li>

                        <li><a href="<?=base_url('servico');?>" style="cursor: pointer" id="">Serviços</a></li>
                       <!-- <li><a href="#" style="cursor: pointer" id="">Endereço</a></li>-->
                        <li><a href="<?=base_url('cidade')?>" style="cursor: pointer" id="">Cidade</a></li>

                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="clearfix"></div>
    </div>


    <div class="user-detail">
        <div class="dropup">
            <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                <img src="/img/funcionarios/img_avatar.png" alt="user-img" class="img-circle">
                            <span class="user-info-span">
                                <br>
                                <h5 class="m-t-0 m-b-0"><?= utf8_encode(ucwords($user['nm_user'])) ?></h5>
                                <p class="text-muted m-b-0">
                                    <small><i class="fa fa-circle text-success"></i> <span>Online</span></small>
                                </p>
                            </span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                <li><a href="javascript:void(0)"><i class="md md-settings"></i><span>status</span></a></li>
                <li><a href="<?=base_url('logout')?>"><i class="md md-settings-power"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->