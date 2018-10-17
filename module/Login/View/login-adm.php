<?php

?>

<div class="wrapper-page">
    <div class="text-center">
        <a href="" class="logo-lg">
            <i class="md md-group"></i>
            <span>Conselho Fiscal Administrativo</span>
<!--            <img src="/assets/images/logo-principal.png" alt="">-->
        </a>
    </div>

    <?php if(!$user):?>
    <form action="<?= $this->redirect(['controller'=>'Login','action'=>'autenticarAdm'])?>" class="form-horizontal m-t-20" method="POST">

        <hr>
        <div class="form-group col-md-11 col-md-push-1">
            <input type="text" class="form-control" name = "login" required placeholder="Login">
            <i class="md md-account-circle form-control-feedback l-h-34"></i>
        </div>
        <div class="form-group col-md-11 col-md-push-1">
            <input type="password" class="form-control"  name ="senha"  required placeholder="Password">
            <i class="md md-vpn-key form-control-feedback l-h-34"></i>

        </div>
        <div class="form-group col-md-11 col-md-push-1">
            <input type="submit" class="btn btn-primary col-md-12" value="Entrar">
            <?php //echo password_hash("123456", PASSWORD_DEFAULT)."\n"; ?>
        </div>
<!--        <div class="form-group">-->
<!--            <a href="#" class="text-left col-md-6">esqueci a senha</a>-->
<!--            <a href="#" class="text-right col-md-6">esqueci o login</a>-->
<!--        </div>-->
    </form>

    <?php else:?>
            <div class="col-md-12 text-center">
                <a href="<?= $this->redirect(['controller'=>'Admin','action'=>'index']);?>" class="btn btn-info">Usuário Logado</a>
            </div>
    <?php endif;?>

</div>


