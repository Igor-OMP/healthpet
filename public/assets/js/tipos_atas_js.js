$(document).ready(function () {
    $('#datatable-buttons').DataTable({
        "language":{
            "search":"",
            "sInfo": "Mostrando de  _START_ a _END_ de _TOTAL_ registros",
            "sLengthMenu": "Mostrar _MENU_ Registros",
        },

    });

    $("#datatable-buttons_filter label input").attr('placeholder','Faça sua busca aqui...');

    $(".btn_alterar").click(function(){
        var id = $(this).data('value');

        $.ajax({
            type:'post',
            dataType:'text',
            url:'/TipoAta/alterar',
            async:true,
            cache:false,
            data:{
                id_tipo_documento:id
            },
            beforeSend: function(){
                $("#pagination").html(
                    carregar()
                );
            },
            success: function(data){
                $("#pagination").html(data);
            }
        });
    });

    $(".btn_excluir").click(function(){
        var id = $(this).data('value');

        $.ajax({
            type:'post',
            dataType:'text',
            url:'/TipoAta/excluir',
            async:true,
            cache:false,
            data:{
                id_tipo_documento:id
            },
            beforeSend: function(){
                $("#pagination").html(
                    carregar()
                );
            },
            success: function(data){
                recarregar();
            }
        });
    });

    function recarregar() {
        $.ajax({
            type: 'post',
            dataType: 'text',
            url: '/TipoAta/pagination',
            cache: false,
            async: true,
            data: {},

            beforeSend: function () {
                carregar()
            },
            success: function (data) {
                if (data.resposta == false) {
                    window.location.href = '';
                }
                $('#pagination').html(data);
            }, error: function (xhr, ajaxOptions, thrownError) {
                var httpCode = xhr.status;
                alert(httpCode + ': ' + thrownError);
            }
        });
    }


    $("#tipo-cadastro").click(function(){
        var id = $(this).data('value');

        $.ajax({
            type:'post',
            dataType:'text',
            url:'/TipoAta/TipoAta/cadastro',
            async:true,
            cache:false,
            data:{
                id_ata:id
            },
            beforeSend: function(){
                $("#pagination").html(
                    carregar()
                );
            },
            success: function(data){
                $("#pagination").html(data);
            }
        });
    });

});
