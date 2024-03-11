<fieldset class="scheduler-border" id="fd_<?php echo $id; ?>">
    <legend class="scheduler-border"><?php echo lang('lgd_routes').' a : '.$city->name; ?></legend>
    <div class="form-group">
        <div id="cities_<?php echo $id; ?>">
            
        </div>
    </div>
    <div class="form-group form-inline">
        <label>
            Desde : <?php echo form_dropdown('from', $cities, '', array('class' => 'form-control','id' => 'from_'.$id)); ?>
        </label>
        <label>
            Hasta : <?php echo form_dropdown('to', $cities, '', array('class' => 'form-control','id' => 'to_'.$id)); ?>
        </label>
        <span class="btn btn-sm btn-primary add-tramo" id="ps_<?php echo $id; ?>"><i class="fa fa-plus"></i></span>
    </div>
</fieldset>