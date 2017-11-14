<?php
if(!isset($_SESSION)){
    session_start();
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= $this->redirect(['module'=>'Site','controller'=>'home','action'=>'index']);?>">Compre Mais</a>
        </div>
        <ul class="nav navbar-nav">
            <li class=""><a href="<?= $this->redirect(['controller'=>'Admin','action'=>'index']);?>">Home</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastro
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= $this->redirect(['controller'=>'Banner','action'=>'cadastro']);?>">Cadastrar Banner</a></li>
                    <li><a href="<?= $this->redirect(['controller'=>'Usuario','action'=>'cadastro']);?>">Cadastrar Usuário</a></li>
                    <li><a href="<?= $this->redirect(['controller'=>'Cidade','action'=>'cadastro']);?>">Cadastrar Cidade</a></li>
                    <div class="divider"></div>
                    <li><a href="<?= $this->redirect(['controller'=>'Cliente','action'=>'cadastro']);?>">Cadastrar Clientes</a></li>
                    <li><a href="<?= $this->redirect(['controller'=>'Empresa','action'=>'cadastro']);?>">Cadastrar Empresa</a></li>
                    <li><a href="<?= $this->redirect(['controller'=>'EmpresaBanner','action'=>'cadastro']);?>">Cadastrar Empresa - Banners</a></li>
                    <div class="divider"></div>
                    <li><a href="<?= $this->redirect(['controller'=>'EmpresaTabloide','action'=>'cadastro']);?>">Cadastrar Empresa - Tablóide</a></li>
                    <li><a href="<?= $this->redirect(['controller'=>'Produto','action'=>'cadastro']);?>">Cadastrar Produtos</a></li>
                    <li><a href="<?= $this->redirect(['controller'=>'Tabloide','action'=>'cadastro']);?>">Cadastrar Tablóides</a></li>
                    <div class="divider"></div>
                    <li><a href="<?= $this->redirect(['controller'=>'TabloideProduto','action'=>'cadastro']);?>">Cadastrar Tablóides - Produtos</a></li>
                    <li><a href="<?= $this->redirect(['controller'=>'TipoUsuario','action'=>'cadastro']);?>">Cadastrar Tipos de Usuários</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if(!isset($_SESSION['user'])){?>
                <li ><a href="<?= $this->redirect(['controller'=>'Login','action'=>'login']);?>"><span class="glyphicon glyphicon-user"></span> Entrar</a></li>
            <?php }else{ $dados = $_SESSION['user'];?>
                <li ><a href="<?= $this->redirect(['controller'=>'Login','action'=>'logout']);?>"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
            <?php }?>
        </ul>
    </div>
</nav>