<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo $title ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frm_line'] ?>
        <?php echo form_open($this->uri->uri_string(), $attrib); ?>
        <?php echo form_hidden('id', isset($line->id) ? $line->id : ''); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <?php
            // Nombre
            echo co_form_input(array(
                'name'     => 'name',
                'id'       => 'name',
                'class'    => 'form-control',
                'required' => 'required'
            ), isset($line->name) ? $line->name : '', lang('field_name'));
            // estado
            echo co_form_dropdown(
                array('name' => 'status', 'class' => 'form-control'),
                array('T' => lang('active'), 'F' => lang('inactive')),
                isset($line->status) ? $line->status : '',
                lang('status')
            );
            ?>
        </div>
        <div class="modal-footer">
            <span class="btn btn-sm btn-primary" id="action_<?= $action ?>">
                <?php echo lang($action) ?>
            </span>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                <?= lang('close') ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>