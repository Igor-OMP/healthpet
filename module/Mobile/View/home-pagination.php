<?php
/**@var $this Controller
 *@var $especie EspecieModel
 *@var $raca RacaModel
 */
$data_atual = new DateTime();

$objData = new DateTime('now');
# xd($data);
?>


<div id="home-main">
    <h2 class="text-center">Lista de Pets</h2>
    <?php foreach($data as $item):
        # x($item['dt_nasc']);
        $arr = explode('/',date('d/m/Y',strtotime($item['dt_nasc'])));
        $objData->setDate($arr[2],$arr[1],$arr[0]);
        $data_dif = $data_atual->diff($objData);
        #xd($data_dif);
        ?>
        <div class="col-sm-10 col-lg-6 col-sm-offset-1 col-lg-offset-3">

            <div class="card-box widget-user">
                <button class="btn-danger btn-pet-excluir" data-pet="<?=$this->enc($item['id_pet'])?>">Excluir</button>
                <div>
                    <img src="<?=$item['ft_pet']?>" class="img-responsive img-thumbnail" alt="user">
                    <div class="wid-u-info">
                        <h4 class="m-t-0 m-b-5"><?=ucwords($item['nm_pet']) ?></h4>
                        <p class="text-muted m-b-5 font-13"><span class="text-success">Espécie</span>: <?= ucwords($raca->getNomeEspecieByRacaId(['id_raca'=>$item['id_raca']],'nm_especie'))?></p>
                        <p class="text-muted m-b-5 font-13"><span class="text-success">Raça</span>: <?=ucwords($raca->getNomeRacaById(['id_raca'=>$item['id_raca']],'nm_raca'))?></p>
                        <p class="text-muted m-b-5 font-13"><span class="text-success">Data Nasc.</span>: <?=$this->converterDataBancoMySQL2Brazil($item['dt_nasc'])?></p>
                        <p class="text-muted m-b-5 font-13"><span class="text-success">Idade.</span>: <?= (($data_dif->y== 0)?'':(($data_dif->y > 1)?$data_dif->y.' anos e ':$data_dif->y.' ano e ')).(($data_dif->m > 1)?$data_dif->m.' meses':$data_dif->m.' mês')?></p>
                        <p class="text-muted m-b-5 font-13"><span class="text-success">Porte</span>: <?= ($item['flag_porte']=='1')?'Pequeno':(($item['flag_porte']=='2')?'Médio':'Grande')?></p>

                    </div>
                </div>
                <ul class="list-inline">
                    <li>
                        <h5 class="text-muted m-t-20">Agenda</h5>
                        <h4 class="m-b-0 text-center"><a href="/mobile/agenda/<?=$this->enc($item['id_pet'])?>"><i class="ion-calendar"></i> </a></h4>
                    </li>

                    <li>
                        <h5 class="text-muted m-t-20">Cartão de Vacina</h5>
                        <h4 class="m-b-0 text-center"><a href="/mobile/card-vacina/<?=$this->enc($item['id_pet'])?>"><i class="ion-ios7-medkit-outline"></i></a></h4>
                    </li>
                </ul>
            </div>
        </div>
        <?php

    endforeach;?>

    <a class="btn-floating btn-large waves-effect waves-light red btn-add" href="/mobile/cad-pet"><i class="material-icons">add</i></a>
</div>


<script>
    $('.btn-pet-excluir').click(function () {
        var id= $(this).data('pet');

        swal({
            title: "Você tem certeza?",
            text: "Essa ação irá excluir esse registro do banco de dados",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type:'POST',
                    dataType:'text',
                    url:'/mobile/pet-delete',
                    async:false,
                    cache:false,
                    data:{
                        id:id
                    },
                    beforeSend: function(){
                        $("#home").html(
                            '<div class="col-xs-12"><i class="fa fa-spin fa-spinner"></i></div>'
                        );
                    },
                    success: function(data){
                        if(data=='<?=$this->enc('success')?>'){
                            swal("Deletado!", "Seu registro foi deletado com sucesso.", "success");
                            carregarHome();
                        }
                    }

                });

            } else {
                swal("Cancelado", "Seu registro está seguro :)", "error");
            }
        });
    });
</script>
