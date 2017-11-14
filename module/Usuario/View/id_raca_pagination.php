<div class="control-group form-group" style="padding:0" id="element_id_raca">
    <label class="control-label" for="id_raca">Raças:</label>
    <div class="controls">
        <select name="id_raca" id="id_raca" class="form-control">
            <option value=""></option>
            <?php foreach($racas as $raca):?>
                <option value="<?=$raca['id_raca']?>"><?=ucwords($raca['nm_raca'])?></option>
            <?php endforeach;?>
        </select>
    </div>
</div>