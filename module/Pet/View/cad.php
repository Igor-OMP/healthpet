<link rel="stylesheet" href="<?=base_url('assets/css/fileinput.min.css')?>">
<div class="container">
    <h2 class="text-center">Cadastro de Pet</h2>
    <hr>
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <?php
            /**@var $form PetForm*/
            $form;

            ?>

            <form action="<?=base_url('pet/salvar')?>" method="post" style="margin-bottom: 50px;" id="pet-form">
               <?=$form->set('id_pet')->setValue($data['id_pet'])->get()?>
                <div class="form-group row">
                    <div class="">
                        <label for="nm_pet">Nome Pet:</label>
                        <?= $form->set('nm_pet')->setValue($data['nm_pet'])->get()?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="">
                        <label for="id_especie">Espécie:</label>
                        <?= $form->set('id_especie')->setValue($data['id_especie'])->get() ?>
                    </div>
                </div>

                <div id="id_raca_pagination" class="row"></div>

                <div class="form-group row">
                    <div class="">
                        <label for="flag_porte">Porte:</label>
                        <?= $form->set('flag_porte')->setValue($data['flag_porte'])->get() ?>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="">
                        <label for="dt_nasc">Data Nascimento:</label>
                        <?= $form->set('dt_nasc')->setValue($data['dt_nasc'])->get() ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="">
                        <label for="ft_pet">Foto Pet:</label>
                        <?= $form->get('ft_pet')?>
                    </div>
                </div>
                <div class="form-group row" style="margin-top: 50px;">
                    <a  href="<?=base_url('pet')?>" class="btn btn-default">Voltar</a>
                    <button  type="submit" class="btn btn-primary" style="margin-left:100px;" >Enviar</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>

    $(document).on('ready', function() {
        var url ='<?=$data['ft_pet']?>';
        $("#ft_pet").fileinput({
            allowedFileExtensions: ["jpg", "png", "gif"],
            initialPreviewAsData: true,
            initialPreview: [url],
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

        initRacas();
    });

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

    function initRacas() {
        var raca = '<?=$data['id_raca']?>'
        $.ajax({
            type: 'post',
            dataType: 'text',
            url: '/raca/get-racas',
            async: true,
            cache: false,
            data: {
                id: $("#id_especie").val(),

            },

            success: function (data) {
                if (data != 'null') {
                    data = JSON.parse(data);

                    carregar_racas(data,raca);
                }
            }
        });
    }
    function carregar_racas(dados,selected=null){

        //console.log(data[0]);
        $.ajax({
            type:'post',
            dataType:'text',
            url:'/pet/id-raca-pagination',
            async:true,
            cache:false,
            data:{
                data:dados,
                selected:selected
            },
            success: function(data) {
                $("#id_raca_pagination").html(data);
            }
        });
    }
</script>