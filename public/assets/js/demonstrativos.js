$(document).ready(function () {
    $('#datatable-buttons').DataTable({
        "language": {
            "search": "",
            "sInfo": "Mostrando de  _START_ a _END_ de _TOTAL_ registros",
            "sLengthMenu": "Mostrar _MENU_ Registros",
        },
        "order": [[ 3, "desc" ]],
        "columnDefs": [ {
            "targets": [ 1,2,3,4,5 ],
            "searchable": false
        } ]

    });

    $("#datatable-buttons_filter label input").attr('placeholder', 'Digite o ano do demonstrativo...');

    $(".btn_alterar").click(function () {
        var id = $(this).data('value');

        $.ajax({
            type: 'post',
            dataType: 'text',
            url: '/Ata/Ata/alterar',
            async: true,
            cache: false,
            data: {
                id_ata: id
            },
            beforeSend: function () {
                $("#pagination").html(
                    carregar()
                );
            },
            success: function (data) {
                $("#pagination").html(data);
            }
        });
    });

    $(".btn_excluir").click(function(){
        var id = $(this).data('value');

        $.ajax({
            type:'post',
            dataType:'text',
            url:'/Ata/Ata/excluir',
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
                recarregar();

            }
        });
    });

});

function recarregar() {
    $.ajax({
        type: 'post',
        dataType: 'text',
        url: '/Ata/Ata/demonstrativo',
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


