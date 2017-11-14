<?= $this->renderMob('header')?>
<link rel="stylesheet" href="/assets/css/mobile/card-vacina.css">
<div class="container-fluid" id="card-vacina" data-pet="<?=$id_pet?>">
   <div id="card-vacina-pagination"></div>
</div>

<script>
    $(function(){
        carregarCartao();
    });

    function carregarCartao(){
        var id = $("#card-vacina").data('pet');
        $.ajax({
            type:'POST',
            dataType:'text',
            url:'/mobile/card-vacina-pagination',
            async:true,
            cache:false,
            data:{
                id:id
            },
            beforeSend: function(){
                $("#card-vacina-pagination").html(
                    '<div class="col-xs-12"><i class="fa fa-spin fa-spinner"></i></div>'
                );
            },
            success: function(data){
                $("#card-vacina-pagination").html(data);
            }

        });
    }
</script>