<?php ;?>

<div class="container">
    <h1 class="text-center">Lista de Serviços</h1>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <a href="<?=base_url('servico/cadastrar');?>" class="btn btn-success" style="float: right;">Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="table-list" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Serviço</th>
                    <th>Serviço Pai</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($servico) && !empty($servico)):
                    foreach($servico as $serv):

                        ?>
                        <tr>
                            <td><?=ucwords($serv['nm_servico'])?></td>
                            <td><?php
                                $data = $model->getById(['id_servico'=>$serv['id_servico_pai']]);
                                echo (empty($serv['id_servico_pai']))?'Serviço Principal':ucwords($data['nm_servico']);
                                ?></td>
                            <td class="text-center">
                                <a href="<?=base_url('servico/cadastrar/'.$this->enc($serv['id_servico']))?>" class="btn btn-warning"><i class="md md-edit"></i></a>
                                <button href="#" class="btn btn-danger waves-effect waves-light btn-excluir" data-id="<?= $this->enc($serv['id_servico'])?>"><i class="md md-delete"></i></button>
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
                        url:'/servico/excluir',
                        async:false,
                        cache:false,
                        data:{
                            id_servico:id
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