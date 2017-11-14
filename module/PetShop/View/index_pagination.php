<?php #xd($usuarios);?>

<div class="container">
    <h1 class="text-center">Lista de PetShops</h1>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <a href="<?=base_url('petshop/cadastrar');?>" class="btn btn-success" style="float: right;">Adicionar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="table-list" class="table table-striped table-bordered">
                <thead>
                <tr>

                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Informações</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($petshops) && !empty($petshops)):
                foreach($petshops as $key => $petshop):?>
                <tr>

                    <td><?=ucwords($petshop['nm_petshop']);?></td>
                    <td><?=$petshop['nr_telefone'];?></td>
                    <td><?=$petshop['em_email'];?></td>
                    <td class="text-center"><button class="btn btn-default btn-rounded waves-effect waves-light m-t-10 btn-modal" data-info="<?=$this->enc($petshop['id_petshop'])?>">Detalhes</button></td>
                    <td class="text-center">
                        <a href="<?=base_url('usuario/cadastrar/'.$this->enc($petshop['id_petshop']))?>" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-danger" data-value="<?=$this->enc($petshop['id_petshop'])?>">Excluir</a>
                    </td>

                </tr>
                <?php endforeach;
                else:?>
                    <td colspan="6"> Não existem informações cadastradas no momento.</td>
                <?php
                    endif;
                ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<div id="modal">

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
    });
$(".btn-modal").click(function(e){
    e.preventDefault();

    $.ajax({
        type:'post',
        dataType:'text',
        url:'/petshop/modal',
        async:true,
        cache:false,
        data:{
            id_petshop:$(this).data('info')
        },
        success:function(data){
            $("#modal").html(data);
            $("#modal-info").modal('show');
        }
    });

});
</script>