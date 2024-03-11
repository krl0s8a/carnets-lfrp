<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_point'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmEditPoint'] ?>
        <?php echo form_open('points/edit', $attrib); ?>
        <div class="modal-body">     
            <div class="alerts-modal"></div>       
            <?php
            echo form_hidden('id', $point->id);
            // Nombre
            echo co_form_input(
                    array(
                        'name' => 'name',
                        'class' => 'form-control',
                        'value' => $point->name
                    ),
                    set_value('name'),
                    lang('field_name')
            );
            // Ubicacion
            echo co_form_dropdown(
                    array(
                        'name' => 'city_id',
                        'class' => 'form-control'
                    ),
                    $cities,
                    set_value('city_id', $point->city_id),
                    lang('field_city')
            );
            ?>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_edit"><?php echo lang('save'); ?></button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>