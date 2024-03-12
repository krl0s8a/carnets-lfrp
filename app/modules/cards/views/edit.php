<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>
                <?php echo lang('edit_city') . ' [' . $city->id . ']'; ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmEdit'] ?>
        <?php echo form_open('cities/edit', $attrib); ?>
        <?php echo form_hidden('id', $city->id); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <?php
            // Nombre
            echo co_form_input(array(
                'name'     => 'name',
                'id'       => 'name',
                'class'    => 'form-control',
                'required' => 'required'
            ), $city->name, lang('field_name'));
            // Codigo postal
            echo co_form_input(array(
                'name'  => 'code',
                'id'    => 'code',
                'class' => 'form-control'
            ), $city->code, lang('field_code'));

            // Provincia
            echo co_form_dropdown(
                array('name' => 'state_id', 'class' => 'form-control'),
                $states,
                $city->state_id,
                lang('field_state')
            );
            // estado
            echo co_form_dropdown(
                array('name' => 'status', 'class' => 'form-control'),
                array('T' => lang('active'), 'F' => lang('inactive')),
                $city->status,
                lang('status')
            );
            ?>
        </div>
        <div class="modal-footer">
            <span class="btn btn-sm btn-primary" id="btn_edit">
                <?php echo lang('btn_edit') ?>
            </span>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                <?= lang('close') ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>