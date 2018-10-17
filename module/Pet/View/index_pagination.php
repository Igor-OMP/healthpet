<?php
    /**@RacaModel */
    $raca;
;?>

<div class="container">
    <h1 class="text-center">Lista de Pets</h1>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="table-list" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Dono</th>
                    <th>Raça</th>
                    <th>Nascimento</th>
                    <th>Porte</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($pets) && !empty($pets)):
                    foreach($pets as $pet):
                        #$data = $especie->getById(['id_especie'=>$raca['id_especie']]);
                        #$data = $data['nm_especie'];
                        ?>
                        <tr>
                            <td class="text-center"><img src="<?=ucwords($pet['ft_pet'])?>" alt="" class="img-responsive img-thumbnail" width="80" height="80"></td>
                            <td><?=ucwords($pet['nm_pet'])?></td>
                            <td><?=ucwords($usuario->getNomeUsuarioById(['id_usuario'=>$pet['id_usuario']],'nm_usuario'))?></td>
                            <td><?=ucwords($raca->getNomeRacaById(['id_raca'=>$pet['id_raca']],'nm_raca'))?></td>
                            <td><?=$this->converterDataBancoMySQL2Brazil($pet['dt_nasc'])?></td>
                            <td><?=($pet['flag_porte'] =='1')?'Pequeno':(($pet['flag_porte']=='2')?'Médio':'Grande')?></td>
                         
                            <td class="text-center">
                                <a href="<?=base_url('pet/cadastrar/'.$this->enc($pet['id_pet']))?>" class="btn btn-warning"><i class="md md-edit"></i></a>
                                <button href="#" class="btn btn-danger waves-effect waves-light btn-excluir" data-id="<?= $this->enc($pet['id_pet'])?>"><i class="md md-delete"></i></button>
                            </td>

                        </tr>
                    <?php   endforeach;
                else:
                    ?>
                    <tr>
                        <td colspan="3"> Não  existem dados no momento</td>
                    </tr>

                <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Datatables-->
<script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/dataTables.buttons.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/buttons.bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/jszip.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/pdfmake.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/vfs_fonts.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/buttons.html5.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/buttons.print.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/dataTables.fixedHeader.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/dataTables.keyTable.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/responsive.bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/dataTables.scroller.min.js')?>"></script>

<script>
    $(document).ready(function(){
        $('#table-list').DataTable({
            "language": {
                "zeroRecords": "Nenhum resultado encontrado - Desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "sLengthMenu":"Mostrar _MENU_ registros",
                "search":"Filtrar",
                "paginate": {
                    "previous": "Anterior",
                    "next":"Próximo"
                }
            }
        });

        /*BUTTON EXCLUIR*/
        $('.btn-excluir').click(function () {
            var id= $(this).data('id');


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
                        url:'/pet/excluir',
                        async:false,
                        cache:false,
                        data:{
                            id:id
                        },
                        success: function(data){
                            swal("Deletado!", "Seu arquivo foi deletado com sucesso.", "success");

                            carregarPagination();
                        }

                    });

                } else {
                    swal("Cancelado", "Seu arquivo está seguro :)", "error");
                }
            });
        });

    });

</script>