<?php #xd($dados);?>

<div id="modal-info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title" id="custom-width-modalLabel"><?=ucwords($dados['nm_petshop'])?></h2>
            </div>
            <div class="modal-body">
                <h3>Dados da Empresa</h3>
                <p>Email: <?=$dados['em_email']?></p>
                <p>Telefone: <?=$dados['nr_telefone']?></p>
                <hr>
                <h3>Localização</h3>
                <?php
                    $end= $endereco->getById(['id_endereco'=>$dados['id_endereco']]);

                ?>

                <p>Endereco: <?=$end['nm_logradouro'].'- '.$end['nm_bairro']. ' - Cep:'.$end['nr_cep']?></p>
                <p>Complemento: <?=$end['nm_complemento'].'- '.$end['nr_num']?></p>
                <p>Cidade: <?=ucwords($cidade->getNomeCidadeById(['id_cidade'=>$end['id_cidade']]))?></p>
                <hr>
                <h3>Servicos</h3>
                <?php
                    $servicos = $petserv->getServicosByPetShopId(['id_petshop'=>$dados['id_petshop']]);

                    if(!isset($servicos[0])){
                        echo $servico->getNomeServicoById($servicos);
                    }else{
                        foreach($servicos as $value){

                            echo $servico->getNomeServicoById($value).'<br>';
                        }
                    }


                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>