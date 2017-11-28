

<div class="wrapper-page">
    <div class="" style="color:white;background: #555; height: 120px;width: 120px;margin:0 auto 20px;border-radius: 50%;text-align: center">
        <i class="ion-social-github" style="font-size: 80px;position: relative;top: 20px;"></i>
    </div>
    <div class="text-center">
        <a href="" class="logo-lg">
<!--            <img src="/assets/images/logo-principal.png" alt=""><br>-->
            <span>LOGIN</span>
        </a>
    </div>

    <?php if(!$user):?>
        <form action="<?= $this->redirect(['controller'=>'Login','action'=>'autenticar'])?>" class="form-horizontal m-t-20" method="POST">

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
            <!--<div class="form-group col-md-11 col-md-push-1">
                <a href="<?/*=base_url('petshop/cadastrar_petshop')*/?>"style="color:#fff;"  class="text-left col-md-6">Cadastrar petshop</a>
                <a href="#"style="color:#fff;"  class="text-right col-md-6">Esqueci o login</a>
            </div>-->
        </form>

    <?php else:?>
        <div class="col-md-12 text-center">
            <a href="<?= $this->redirect(['controller'=>'Admin','action'=>'index']);?>" class="btn btn-info">Usuário Logado</a>
        </div>
    <?php endif;?>
</div>
<script>
    $(function(){
        $('html,body').addClass('login_class');

    });
</script>

