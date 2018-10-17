<?php

?>
<?= $this->renderMob('header')?>
<link rel="stylesheet" href="/assets/css/mobile/agenda.css">
<div class="container-fluid"id="agenda">
    <h2 class="text-center">Agenda</h2>
    <div class="row">
        <div class="col-md-8 col-lg-6 col-sm-10 col-xs-10 col-sm-offset-1 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">
            <form id="agenda-form" class="form-horizontal" >
                <input type="hidden" name="id_pet" value="<?=$id_pet?>" id="id_pet">
                <input type="hidden" name="id_usuario" value="<?=$this->enc($id_usuario)?>">
                <div class="form-group">
                    <label for="id_petshop">PetShop:</label>
                    <select name="id_petshop" id="id_petshop" class="form-control">
                        <option value="">&nbsp;</option>
                        <?php foreach($petshop as $item):?>
                            <option value="<?=$this->enc($item['id_petshop'])?>"><?=ucwords($item['nm_petshop'])?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <div id="id_servico_pagination"></div>
                </div>
                <div class="form-group">
                    <label for="dt_servico">Data Evento:</label>
                    <input type="date" class="form-control" name="dt_servico" id="dt_servico">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Enviar">
                </div>
            </form>
            <br>
            <hr>

        </div>

        <h2 class="text-center">Eventos</h2>
        <div id="eventos_pagination"></div>
    </div>
</div>


<script>

    $(function(){
        carregarEventos();
    });
    $("#agenda-form input[type=submit]").click(function(e){
        e.preventDefault();

        var form = $("#agenda-form").serialize();
        $.ajax({
            type:'post',
            dataType:'text',
            url:'/mobile/cad-agenda',
            async:true,
            cache:false,
            data:{dados:form},
            success:function(data){
                carregarEventos($("#id_pet").val());
            }
        });

        $("#agenda-form").trigger("reset");
    });
    function carregarEventos(){

        var id= $("#id_pet").val();
        $.ajax({
            type:'post',
            dataType:'text',
            url:'/mobile/eventos',
            async:true,
            cache:false,
            data:{id:id},
            success:function(data){
                $("#eventos_pagination").html(data);
            }
        });
    }

    $("#id_petshop").change(function(){
        var id = $(this).val();

        $.ajax({
            type:'post',
            dataType:'text',
            url:'/mobile/id-servico-petshop',
            async:true,
            cache:false,
            data:{data:id},
            success:function(data){
                $("#id_servico_pagination").html(data);
            }
        });
    });
</script>