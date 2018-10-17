<?php
/**
 * @var $this Controller
 * @var $especie EspecieModel
 * @var $raca RacaModel
 */

$especie = fabric('EspecieModel');

$especie_data = $especie->All();
$raca = fabric('RacaModel');
$this->renderMob('header');
?>

<link rel="stylesheet" href="<?=base_url('assets/css/fileinput.min.css')?>">
<div class="container-fluid" id="cad-pet">

    <div class="container-fluid" id="page">
        <h2 class="text-center">Cadastro de Pets</h2>

        <form class="form-horizontal col-md-6 col-md-offset-3 col-sm-8 col-md-offset-2 col-xs-12 col-lg-4 col-lg-offset-4" method="post" action="/mobile/cadastrar" enctype="multipart/form-data">

            <input type="hidden" value="<?=$this->enc($user['id_usuario'])?>" name="id_usuario">
            <div class="form-group">
                <label for="nm_pet">Nome:</label>
                <input type="text" class="form-control" placeholder="Nome do pet"  required="required" name="nm_pet" id="nm_pet">
            </div>
            <div class="form-group">
                <label for="id_especie">Espécie:</label>
                <select name="id_especie" id="id_especie" class="form-control">
                    <option value=""></option>
                    <?php foreach($especie_data as $item): ?>
                        <option value="<?=$item['id_especie']?>"><?=ucwords($item['nm_especie'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <div id="id_raca_pagination"></div>
            </div>
            <div class="form-group">
                <label for="dt_nasc">Data Nasc.:</label>
                <input type="date" class="form-control" id="dt_nasc" name="dt_nasc" >
            </div>

            <div class="form-group">
                <label for="flag_porte">Porte:</label>
                <select name="flag_porte" id="flag_porte" class="form-control" required="required">
                    <option value="<?=$this->enc(1)?>">Pequeno</option>
                    <option value="<?=$this->enc(2)?>">Médio</option>
                    <option value="<?=$this->enc(3)?>">Grande</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ft_pet">Foto:</label>
                <input type="file" class="form-control ft_pet" id="ft_pet" name="ft_pet" >
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success btn-block" value="Enviar">
            </div>
        </form>
    </div>

</div>
<script src="/assets/js/fileinput.min.js"></script>
<script>
    $(function(){
        $(document).on('ready', function() {
            $(".ft_pet").fileinput({
                allowedFileExtensions: ["jpg", "png", "gif"],
                initialPreviewAsData: true,

                deleteUrl: "/site/file-delete",
                overwriteInitial: false,
                //maxFileSize: 1024,
                initialCaption: "Selecione o arquivo desejado...",
                title:''
            });
    })});

    $("input[type=text]").focusin(function(){
       $(".toobar-footer").attr("style","display:none");
    });
    $("input[type=text]").focusout(function(){
        $(".toobar-footer").attr("style","display:block");
    });

    $("#id_especie").change(function(){
        var id = $(this).val();
        carregar_racas(id);
    });
    function carregar_racas(dados){
        console.log(dados);
        $.ajax({
            type:'post',
            dataType:'text',
            url:'/mobile/id_raca_pagination',
            async:true,
            cache:false,
            data:{data:dados},
            success: function(data) {
                $("#id_raca_pagination").html(data);
            }
        });
    }


</script>
