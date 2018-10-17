
<div class="container-fluid" id="login">
    <div class="logo-login col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <i class="ion-social-github"></i>
    </div>


           <form action="<?=base_url('mobile/auth')?>" method="post" class="form-horizontal col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4">

               <div class="form-group">
                   <label for="em_email">Email</label>
                   <input type="text" class="form-control" id="em_email" name="em_email">
               </div>
               <div class="form-group">
                   <label for="pw_pass">Senha</label>
                   <input type="password" class="form-control" id="pw_pass" name="pw_pass">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-outline btn-block">Login</button>
               </div>
           </form>

        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4 text-center">
            <a href="/mobile/cad-user" style="color: #fff;float: left;">Cadastre-se</a>
            <a href="/mobile/recuperar-senha" style="color: #fff;float: right;">Esqueci a senha</a>
        </div>

</div>