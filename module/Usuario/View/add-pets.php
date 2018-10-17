<?php
$form->createForm()?>




<link rel="stylesheet" href="<?=base_url('assets/css/fileinput.min.css')?>">

<div class="container">
    <h2 class="text-center">Adicionar pets</h2>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <form action="<?=base_url('usuario/add-pets/')?>" method="post" style="margin-bottom: 50px;" id="usuario-pets-form">
                <input type="hidden" name="id" id="id" value="<?=$id?>">
                <div class="form-group row">
                    <div class="">
                        <label for="nm_petshop">Nome Pet:</label>
                        <?= $form->get('nm_pet') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="">
                        <label for="id_especie">Espécie:</label>
                        <?= $form->get('id_especie') ?>
                    </div>
                </div>

                <div id="id_raca_pagination" class="row"></div>

                <div class="form-group row">
                    <div class="">
                        <label for="flag_porte">Foto Pet:</label>
                        <?= $form->get('flag_porte') ?>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="">
                        <label for="dt_nasc">Data Nascimento:</label>
                        <?= $form->get('dt_nasc') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="">
                        <label for="ft_pet">Foto Pet:</label>
                        <?= $form->get('ft_pet') ?>
                    </div>
                </div>

            </form>

        </div>

        <div class="col-md-6">
            <h3 class="text-center">Pets Adicionados</h3>
            <div id="pets"></div>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-md-10 col-md-offset-1">
            <button class="btn btn-primary" id="btn-add">Adicionar</button>
            <a href="<?=base_url('usuario')?>" class="btn btn-default" style="margin-left: 30px;" id="">Cancelar</a>
            <button class="btn btn-success" id="btn-gravar" style="float: right">Gravar</button>
        </div>
    </div>

</div>
<!--<script src="<?/*=base_url('assets/js/jquery.blockUI.js')*/?>"></script>-->

<script>

    $(document).on('ready', function() {
        $("#ft_pet").fileinput({
            allowedFileExtensions: ["jpg", "png", "gif"],
            initialPreviewAsData: true,

            deleteUrl: "/site/file-delete",
            overwriteInitial: false,
            //maxFileSize: 1024,
            initialCaption: "Selecione o arquivo desejado...",
            title:''
        });
        sessionStorage.clear();
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            //startDate :'today',
            autoclose: true
        });


    });

    function armazenar(data){
       var key = data.key;
        data = JSON.stringify(data);

        if(sessionStorage.getItem(key) == null){
            sessionStorage.setItem(key,data);
        }

    }

    function apagar_armazenamento(key){
        if(sessionStorage.getItem(key)){
            sessionStorage.removeItem(key);
        }
    }

    function carregar_racas(dados){

        //console.log(data[0]);
        $.ajax({
            type:'post',
            dataType:'text',
            url:'/usuario/id-raca-pagination',
            async:true,
            cache:false,
            data:{data:dados},
            success: function(data) {
                $("#id_raca_pagination").html(data);
            }
        });
    }

    function  fechar(obj){
        var pai = obj.parentNode;
        pai = pai.parentNode;
        var key = pai.getAttribute('data-key');
        pai.parentNode.removeChild(pai);
        apagar_armazenamento(key);
    }

    $('#id_especie').change(function(){

        $.ajax({
            type:'post',
            dataType:'text',
            url:'/raca/get-racas',
            async:true,
            cache:false,
            data:{
                id:$(this).val()
            },

            success: function(data){
               if(data != 'null'){
                   data = JSON.parse(data);
                   carregar_racas(data);
               }
            }

        });
    });
    $("#btn-gravar").click(function(e){

        e.preventDefault();
        var array = [];
        var count = 0;

        /*init messege*/
        swal({
            title: "Você tem certeza?",
            text: "Essa ação irá gravar esse(s) registro(s) no banco de dados",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, grave!",
            cancelButtonText: "Não, cancele!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                for(count;count <= Number(sessionStorage.count);count++ ){
                    if(sessionStorage.getItem('data_'+count)){
                        array.push(sessionStorage.getItem('data_'+count));
                    }
                }
                console.log(array);
                if(array.length > 0){
                    console.log('enviando...');
                    $.ajax({
                        type:"post",
                        dataType:"text",
                        url:"/usuario/write-pets",
                        async:true,
                        cache:false,
                        data:{
                            array:array
                        },
                        success: function(data){
                            console.log(typeof data);
                            if(data == '<?=$this->enc('success')?>'){
                                window.location.href ='/usuario';
                            }else{
                                console.log(data);
                                return false;
                            }
                        }
                    });
                }

            } else {
                swal("Cancelado", "Os dados não foram gravados :)", "error");
            }
        });
        /*end message*/


    });


    $("#btn-add").on('click',function(){
        var form = $("#usuario-pets-form");

        if (sessionStorage.count) {
            sessionStorage.count = Number(sessionStorage.count) + 1;
        } else {
            sessionStorage.count = 1;
        }

        var data ={
            "key":"data_"+sessionStorage.count,
            "id":$("#id").val(),
            "nm_pet":form.find('#nm_pet').val(),
            "id_raca":form.find('#id_raca option:selected').val(),
            "dt_nasc":form.find("#dt_nasc").val(),
            "flag_porte":form.find('input[name=flag_porte]:checked').attr("value"),
            "ft_pet": $(".kv-file-content img").attr('src')
        };


        armazenar(data);

        $("#pets").append(
            '<div class ="col-md-8 col-md-offset-2" data-key="'+"data_"+sessionStorage.count+'">'+
                '<div style="position: relative;top:0; right:0;">' +
                    '<button onclick="fechar(this)"  class="btn-fechar" style="width:21px;height:24px;background-color:#fff;border: 1px solid rgba(0,0,0,0.08);float: right;z-index: 999;" >x</button>'+
                '</div>'+
                '<div class="card-box widget-user">'+
                    '<div>'+
                        '<img src="'+ $(".kv-file-content img").attr('src') +'" class="img-responsive img-circle" alt="user">'+
                        '<div class="wid-u-info">'+
                            '<h4 class="m-t-0 m-b-5">'+ form.find("#nm_pet").val() +'</h4>'+
                            '<p class="text-muted m-b-5 font-13">'+
                                  form.find("#id_especie option:selected").html() +
                                ' - '+ form.find("#id_raca option:selected").html()+
                                ' - '+ form.find("input[name=flag_porte]:checked").val()+
                            '</p>'+
                            '<small class="text-warning"><b>'+ 'Data de Nascimento: '+form.find('#dt_nasc').val()+ '</b></small>'+
                        '</div>'+
                    '</div>'+
               '</div>'+
           '</div>'

        );
    });
</script>