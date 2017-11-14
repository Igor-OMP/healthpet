<?php
    /**
     * @var $this Controller
     * */

?>

<link rel="stylesheet" href="/assets/css/mobile/cad-user.css">
<div class="container" id="cad-user">
    <div class="row">
        <a href="/mobile" style="font-size: 3em;position: absolute;top:10px; left: 20px; color: #fff;"><i class="md md-keyboard-arrow-left"></i></a>
    </div>
    <h2 class="text-center">Cadastre-se</h2>
    <h5 style="margin-left: 20px;margin-top:20px;margin-bottom: 20px;color: #fff;"><span style="font-size: 2em;margin-"><sub>*</sub></span>&nbsp;&nbsp; &nbsp;campos obrigatórios.</h5>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <form action="/mobile/save-user"  class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="nm_usuario">Nome Completo *:</label>
                    <input type="text" class="form-control" placeholder="Escreva seu nome." name="nm_usuario" id="nm_usuario" required="required">
                    <div class="">
                        <p class="alert-message"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="em_email">Email *:</label>
                    <input type="email" class="form-control" placeholder="Escreva seu email." name="em_email" id="em_email" required="required">
                    <div class="">
                        <p class="alert-message email"></p>
                    </div>
                </div>
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
                    <label for="nr_tel">Telefone:</label>
                    <input type="tel" class="form-control phone_with_ddd" placeholder="Número de telefone" name="nr_tel" id="nr_tel" >
                    <div class="">
                        <p class="alert-message"></p>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $("#em_email").focusout(function(){
        var email = $(this).val();
        var emailFilter=/^.+@.+\..{2,}$/;
        var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/;
        var token = <?= '"'.$this->enc('true').'"'?>;
        if(email != ''){

            if( !emailFilter.test(email) || email.match(illegalChars)){
                //console.log('error');
                $(".email").html('escreva um email válido').addClass('active');
            }else{
                $.ajax({
                    type:'post',
                    dataType:'text',
                    url:'/mobile/verify-email',
                    async:true,
                    cache:false,
                    data:{em_email:email},

                    success: function(data){

                        if(data == token){
                            $(".email").html('email já cadastrado!').addClass('active');
                        }else{
                            $(".email").removeClass('active');
                        }
                    }
                });
            }

        }
    });

    $("#em_email").focusin(function(){
        $(".email").removeClass('active');
    });

    $("#conf_senha").focusin(function(e){

        $(this).keyup(function(){
            let conf = $(this).val();
            if( conf == $("#pw_senha").val()){
                $(".conf-senha").html('').removeClass('active');
            }else{
                $(".conf-senha").html('senha não confere.').addClass('active');
            }
        });

    });

</script>