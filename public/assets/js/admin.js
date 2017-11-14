

$("#consulta").on('click', function () {
    $.ajax({
        type: 'post',
        dataType: 'text',
        url: '/Ata/Ata/consulta',
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
});

$("#cadastro").on('click', function () {
    $("#pagination").resize();
    $.ajax({
        type: 'post',
        dataType: 'text',
        url: '/Ata/Ata/cadastro',
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
});



    $("#cad-tipo-ata").on('click', function () {
        $.ajax({
            type: 'post',
            dataType: 'text',
            url: '/TipoAta/TipoAta/pagination',
            cache: false,
            async: true,
            data: {},

            beforeSend: function () {
                carregar()
            },
            success: function (data) {
                if(data.resposta == false){
                    window.location.href='';
                }
                $('#pagination').html(data);
            }
        });
    });



function carregar() {
    $('#pagination').html(
        '<div class="col-md-4 col-md-offset-4"><i class="fa fa-spin fa-refresh" style="font-size: 72px;"></i></div>'
    );

}



