<?php
/**
 * @var $this Controller
 * */

?>

<div class="container" id="cad-user" style="margin-top: 100px;">
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
    <h2 class="text-center" >Recuperar a senha</h2>
    <h4 style="color: white;" class="col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        Para redefinir sua senha digite  o endereço de email que você usa para fazer login no HealthPet.
    </h4>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <form action="/mobile/request-token"  class="form-horizontal" method="post" style="margin-top: 50px;">

                <div class="form-group">
                    <label for="em_email">Digite o email cadastrado:</label>
                    <input type="email" class="form-control" placeholder="Escreva seu email." name="em_email" id="em_email" required="required">
                    <div class="">
                        <p class="alert-message email" style="color: white;"></p>
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

    $("#btn-enviar").attr("disabled","disabled");

    var timer = setInterval(checkEmail,1000);

    function checkEmail(){
        var email = $("#em_email").val();
        var emailFilter=/^.+@.+\..{2,}$/;
        var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/;
        var token = <?= '"'.$this->enc('true').'"'?>;
        if(email != ''){

            if( !emailFilter.test(email) || email.match(illegalChars)){
                //console.log('error');
                $(".email").html('email não cadastrado').addClass('active');
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

                            $(".email").html('email cadastrado.').addClass('active');
                            $(".btn-block").removeAttr("disabled");
                        }else{

                            $$(".email").html('email não cadastrado').addClass('active');
                            $("#btn-enviar").attr("disabled","disabled");
                        }
                    }
                });
            }

        }
        console.log("chamado");
    }

    $("#em_email").focusin(function(){
        $(".email").removeClass('active');
    });


</script>