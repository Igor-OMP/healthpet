<?php
/**
 * @var $pet_ser PetShopServicoModel
 * @var $serv_model ServicoModel
 */

?>

<label class="control-label" for="id_servico">Serviços:</label>

<select name="id_servico" id="id_servico" class="form-control" required="required">
    <option value=""></option>
    <?php foreach($servicos as $servico):?>
        <option value="<?=$this->enc($servico['id_servico'])?>"><?=ucwords($serv_model->getNomeServicoById(['id_servico'=>$servico['id_servico']]))?></option>
    <?php endforeach;?>
</select>
