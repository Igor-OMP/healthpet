<?php
#xd($racas);

if(isset($racas[0])){
    $data = $racas;
}else{
    $data[]= $racas;
}
?>
    <label class="control-label" for="id_raca">Raças:</label>

        <select name="id_raca" id="id_raca" class="form-control" required="required">
            <option value=""></option>
            <?php foreach($data as $raca):?>
                <option value="<?=$raca['id_raca']?>"><?=ucwords($raca['nm_raca'])?></option>
            <?php endforeach;?>
        </select>
