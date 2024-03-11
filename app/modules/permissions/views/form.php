<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?= $title . ' ' . lang('perm_details'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frm_permission'] ?>
        <?php echo form_open($this->uri->uri_string(), $attrib); ?>
        <?php echo form_hidden('id', isset($permission->permission_id) ? $permission->permission_id : ''); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="form-group">
                <?php echo lang('field_name', 'name') ?>
                <?php
                echo form_input(array(
                    'id'        => 'name',
                    'name'      => 'name',
                    'value'     => set_value('name', isset($permission) ? $permission->name : ''),
                    'class'     => 'form-control',
                    'maxlength' => 30,
                    'required'  => 'required'
                ));
                ?>
            </div>
            <div class="form-group">
                <?php echo lang('perm_description', 'description') ?>
                <textarea name="description" id="description" cols="" class="form-control"
                    rows="2"><?php echo set_value('description', isset($permission) ? $permission->description : '') ?></textarea>
            </div>
            <div class="form-group">
                <?php echo lang('status', 'status') ?>
                <?php
                $options = array(
                    'active'   => lang('active'),
                    'inactive' => lang('inactive'),
                    'deleted'  => lang('deleted')
                );
                echo form_dropdown(
                    array(
                        'name'  => 'status',
                        'id'    => 'status',
                        'class' => 'form-control'
                    ),
                    $options, isset($permission) ? $permission->status : ''
                );
                ?>
            </div>
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