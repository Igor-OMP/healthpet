<style>
    #change-pass h4,.alert-message{color: white;}
</style>

<div class="container" id="change-pass" style="margin-top: 100px;">
    <div class="row">
        <?php
        /*MENSAGENS DO SISTEMA*/
        if(isset($_SESSION['flash_message'])){

            $this->render('layout/admin/messages',['msg'=>$_SESSION['flash_message']]);
        }
        ?>
    </div>
    <div class="row">
        <a href="/mobile" style="font-size: 3em;position: absolute;top:10px; left: 20px; color: #fff;"><i class="md md-keyboard-arrow-left"></i></a>
    </div>
    <h2 class="text-center" >Redefinir a senha</h2>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <h4>Usuario: <?= ucwords($user)?></h4>
            <h4>Email: <?= ucwords($email)?></h4>
            <form action="/mobile/update-senha"  class="form-horizontal" method="post" style="margin-top: 50px;">
                <input type="hidden" name="id_usuario" value="<?=$id?>">

                <div class="form-group">
                    <label for="pw_senha">Senha *:</label>
                    <input type="password" class="form-control" placeholder="Escreva sua senha." name="pw_senha" id="pw_senha" required="required">
                    <div class="">
                        <p class="alert-message"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="conf_senha">Confirmar Senha *:</label>
                    <input type="password" class="form-control" placeholder="Confirme a  senha." name="conf_senha" id="conf_senha" required="required">
                    <div class="">
                        <p class="alert-message conf-senha"></p>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" id="btn-enviar" value="Enviar Email">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#btn-enviar").attr("disabled","disabled");
    });

    $("#conf_senha").focusin(function(e){

        $(this).keyup(function(){
            let conf = $(this).val();
            if( conf == $("#pw_senha").val()){
                $(".conf-senha").html('senhas conferem');
                $("#btn-enviar").removeAttr("disabled");
            }else{
                $(".conf-senha").html('senha não confere.').addClass('active');
            }
        });

    });
</script>
