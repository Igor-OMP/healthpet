
<div class="col-md-12">
    <div id="pagination" style="margin-bottom: 100px;">

    </div>
</div>


<script>
    function carregarPagination(){
        $.ajax({
            type: 'post',
            dataType: 'text',
            url: '/servico/pagination',
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

    function carregar() {
        $('#pagination').html(
            '<div class="col-md-4 col-md-offset-4"><i class="fa fa-spin fa-refresh" style="font-size: 380px;"></i></div>'
        );
    }

    $(function () {
        carregarPagination();
    });
</script>
