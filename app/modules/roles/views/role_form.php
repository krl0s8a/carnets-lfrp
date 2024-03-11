<?php
$errorClass = ' has-error';
echo validation_errors();
?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-wrench"></i>
            <?= lang('role_details'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib);
    echo form_hidden('role_id', isset($role) ? $role->role_id : ''); ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo lang('role_name', 'role_name') ?>
                    <?php
                    echo form_input(array(
                        'id' => 'role_name',
                        'name' => 'role_name',
                        'value' => set_value('role_name', isset($role) ? $role->role_name : ''),
                        'class' => 'form-control',
                        'required' => 'required'
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <?php echo lang('role_login_destination', 'login_destination') ?>
                    <?php
                    echo form_input(array(
                        'id' => 'login_destination',
                        'name' => 'login_destination',
                        'value' => set_value('login_destination', isset($role) ? $role->login_destination : ''),
                        'class' => 'form-control'
                    ));
                    ?>
                    <?php echo form_label(form_error('login_destination') ? form_error('login_destination') . '<br />' : '' . lang('role_destination_note'), 'login_destination', array('class' => form_error('login_destination') ? 'error' : 'help-inline')); ?>
                </div>
            </div>
            <div class="col-md-8">
                <?php echo lang('bf_description', 'description'); ?>
                <textarea name="description" id="description" rows="2"
                    class="form-control"><?php echo set_value('description', isset($role) ? $role->description : ''); ?></textarea>
                <?php echo form_label(form_error('description') ? form_error('description') : lang('role_max_desc_length'), 'description', array('class' => form_error('description') ? 'error' : 'help-inline')); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo lang('role_default_role', 'default'); ?>
                    <input type="checkbox" id="default" name="default" value="1" class="filled-in" <?php echo set_checkbox('default', 1, isset($role) && $role->default == 1); ?> />
                    <label for="default">
                        <?php echo lang('role_default_note'); ?>
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo lang('role_can_delete_role', 'can_delete_label') ?>
                    <input name="can_delete" type="radio" class="with-gap" id="can_delete_yes" <?php echo set_radio('can_delete', 1, isset($role) && $role->can_delete == 1); ?> value="1" />
                    <label for="can_delete_yes">
                        <?php echo lang('bf_yes'); ?>
                    </label>
                    <input name="can_delete" type="radio" class="with-gap" id="can_delete_no" value="0" <?php echo set_radio('can_delete', 0, isset($role) && $role->can_delete == 0); ?> />
                    <label for="can_delete_no">
                        <?php echo lang('bf_no'); ?>
                    </label>

                    <span class="help-inline">
                        <?php echo lang('role_can_delete_note'); ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo Module::run('roles/matrix'); ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('role_save_role'); ?>" />
        <?php
        echo anchor('roles', lang('bf_action_cancel'), array('class' => 'btn btn-warning'));
        if (isset($role) && $role->can_delete == 1 && has_permission('Bonfire.Roles.Delete')
        ):
            ?>
            <button type="submit" name="delete" class="btn btn-danger"
                onclick="return confirm('<?php e(js_escape(lang('role_delete_confirm') . ' ' . lang('role_delete_note'))); ?>')"><span
                    class="icon-trash icon-white"></span>&nbsp;
                <?php echo lang('role_delete_role'); ?>
            </button>
        <?php endif; ?>
    </div>
    <?php echo form_close(); ?>
</div>