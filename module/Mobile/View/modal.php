<?php
    #x($dados);
    $pet = new PetModel();
    $petshop = new PetShopModel();
    $petshop = $petshop->getById(['id_petshop'=>$dados['id_petshop']]);
    $servico = new ServicoModel();
    $endereco = new EnderecoModel();
    $cidade = new CidadeModel();
    #xd($petshop);

?>

<div id="modal-info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:90%; margin: 20px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="custom-width-modalLabel"><?=ucwords($pet->getNomePetById(['id_pet'=>$dados['id_pet']]))?></h3>
            </div>
            <div class="modal-body">
                <h3>Dados da Empresa</h3>
                <p>Nome da Empresa: <?=ucwords($petshop['nm_petshop'])?></p>
                <p>Email: <?=$petshop['em_email']?></p>
                <p>Telefone: <?=$petshop['nr_telefone']?></p>
                <hr>
                <h3>Localização</h3>
                <?php
                $end= $endereco->getById(['id_endereco'=>$petshop['id_endereco']]);

                ?>

                <p>Endereco: <br><?=$end['nm_logradouro'].'- '.$end['nm_bairro']?></p>
                <p>Cep: <?=$end['nr_cep']?></p>
                <p>Complemento: <?=$end['nm_complemento'].'-'.$end['nr_num']?></p>
                <p>Cidade: <?=ucwords($cidade->getNomeCidadeById(['id_cidade'=>$end['id_cidade']]))?></p>
                <hr>
                <h3>Compromisso</h3>
                <p><?= ucwords($servico->getNomeServicoById(['id_servico'=>$dados['id_servico']]))?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>