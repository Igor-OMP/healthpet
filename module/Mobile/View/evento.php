<?php
    /**@var $this Controller
     * **/
$petshop = new PetShopModel();

#xd($eventos);
if(!isset($eventos)){
        echo'<h4>Não existem eventos cadastrados para esse pet.</h4>';
}else{?>
    <link rel="stylesheet" href="/assets/css/mobile/evento.css">


       <div id="evento">

           <table class="table table-bordered" style="width: 100%;">
               <thead>
               <tr>
                   <th>Detalhes</th>
                   <th>Data</th>
                   <th>Ação</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($eventos as $eve):?>
                   <tr>
                       <td><?='<a href="" class="btn-modal" data-agenda="'.$this->enc($eve['id_agenda']).'" >'.ucwords($petshop->getNomePetShopById(['id_petshop'=>$eve['id_petshop']])).'</a>'?></td>
                       <td><?=date('d/m/y',strtotime($eve['dt_servico']))?></td>
                       <td>
                           <button class="btn btn-danger btn-excluir" data-agenda="<?=$this->enc($eve['id_agenda'])?>"><i class="ion-trash-a"></i></button>
                          <!-- <button class="btn btn-success" data-agenda="<?/*=$this->enc($eve['id_agenda'])*/?>"><i class="ion-checkmark"></i></button>-->
                       </td>


                   </tr>
               <?php endforeach;?>
               </tbody>
           </table>
       </div>

<?php }?>
<div id="modal">
</div>
<!-- Sweet-Alert  -->

<script>

    $(".btn-modal").click(function(e){
        e.preventDefault();

        $.ajax({
            type:'post',
            dataType:'text',
            url:'/mobile/evento-modal',
            async:true,
            cache:false,
            data:{
                id_agenda:$(this).data('agenda')
            },
            success:function(data){

                $("#modal").html(data);
                $("#modal-info").modal('show');
            }
        });

    });

    $('.btn-excluir').click(function () {
        var id= $(this).data('agenda');

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
                    url:'/mobile/evento-delete',
                    async:false,
                    cache:false,
                    data:{
                        id:id
                    },
                    success: function(data){
                       if(data=='<?=$this->enc('success')?>'){
                           swal("Deletado!", "Seu registro foi deletado com sucesso.", "success");
                           carregarEventos();
                       }
                    }

                });

            } else {
                swal("Cancelado", "Seu registro está seguro :)", "error");
            }
        });
    });

</script>