<link rel="stylesheet" href="<?=base_url('assets/css/admin.css')?>">



<div class="col-md-12">
    <div id="pagination">

    </div>
</div>

<script>
    $(function () {
        $.ajax({
            type: 'post',
            dataType: 'text',
            url: '/documento/pagination',
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
</script>



