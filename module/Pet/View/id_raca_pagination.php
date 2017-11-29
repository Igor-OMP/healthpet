<?php
if(isset($racas[0])){
    $data = $racas;
}else{
    $data[]= $racas;
}
?>


<div class="control-group form-group" style="padding:0" id="element_id_raca">
    <label class="control-label" for="id_raca">Raças:</label>
    <div class="controls">
        <select name="id_raca" id="id_raca" class="form-control" >
            <option value=""></option>
            <?php foreach($data as $raca):
                if(isset($selected) && $raca['id_raca'] == $selected):?>
                    <option value="<?=$raca['id_raca']?>" selected="selected"><?=ucwords($raca['nm_raca'])?></option>
                <?php else:?>
                    <option value="<?=$raca['id_raca']?>"><?=ucwords($raca['nm_raca'])?></option>
                    <?php
                endif;
            endforeach;?>
        </select>
    </div>
</div>