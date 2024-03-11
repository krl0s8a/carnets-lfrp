<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i>
                <?php echo lang('create_city'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreate'] ?>
        <?php echo form_open('cities/create', $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <p>
                <?php echo lang('info_create'); ?>
            </p>
            <?php
            // Nombre
            echo co_form_input(array(
                'name'     => 'name',
                'id'       => 'name',
                'class'    => 'form-control',
                'required' => 'required'
            ), set_value('name'), lang('field_name'));
            // codigo postal
            echo co_form_input(array(
                'name'  => 'code',
                'id'    => 'code',
                'class' => 'form-control'
            ), set_value('code'), lang('field_code'));

            // Provincia
            echo co_form_dropdown(
                array('name' => 'state_id', 'class' => 'form-control'),
                $states,
                set_value('state_id', 2),
                lang('field_state')
            );
            ?>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_add">
                <?php echo lang('btn_add') ?>
            </button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                <?= lang('close') ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>