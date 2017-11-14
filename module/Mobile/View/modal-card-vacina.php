<?php
#xd($dados);
$pet = new PetModel();
$petshop = new PetShopModel();
$petshop = $petshop->getById(['id_petshop'=>$dados['id_petshop']]);
$servico = new ServicoModel();
$pet_cv = new PetCartaoModel();
$pet_cv = $pet_cv->getById(['id_cartao_vacina'=>$dados['id_cartao_vacina']]);
#xd($pet_cv);
#$endereco = new EnderecoModel();
#$cidade = new CidadeModel();
#xd($petshop);

?>

<div id="modal-info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:90%; margin: 20px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="custom-width-modalLabel"><?=ucwords($pet->getNomePetById(['id_pet'=>$pet_cv['id_pet']]))?></h3>
            </div>
            <div class="modal-body">
                <h3>Dados da Empresa</h3>
                <p>Nome da Empresa: <?=ucwords($petshop['nm_petshop'])?></p>
                <p>Email:<a href="maito:<?=$petshop['em_email']?>"><?=$petshop['em_email']?></a></p>
                <p>Telefone: <a href="tel:<?=str_replace([" ","(",")"],["","",""],$petshop['nr_telefone'])?>"><?=$petshop['nr_telefone']?></a></p>
                <hr>

                <h3>Compromisso</h3>
                <p><?= ucwords($servico->getNomeServicoById(['id_servico'=>$dados['id_servico']]))?></p>

                <h3>Descrição</h3>
                <p><?=$dados['txt_desc']?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>