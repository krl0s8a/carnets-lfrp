<?php
echo validation_errors();
$errorClass = ' error';
$controlClass = 'span6';
$fieldData = array(
    'errorClass' => $errorClass,
    'controlClass' => $controlClass,
);

$currentMethod = $this->router->method;
$editSettings = $currentMethod == 'edit';

if (isset($password_hints)) {
    $fieldData['password_hints'] = $password_hints;
}

$renderPayload = null;
if (isset($current_user)) {
    $fieldData['current_user'] = $current_user;
}
if (isset($user)) {
    $fieldData['user'] = $user;
    $renderPayload = $user;
}

if (isset($password_hints)):
    ?>
    <div class="alert alert-info fade in">
        <a data-dismiss="alert" class="close">&times;</a>
        <?php echo $password_hints; ?>
    </div>
    <?php
endif;
?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i>
            <?= $toolbar_title ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'autocomplete' => 'off', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib);
    ?>
    <div class="box-content">
        <p class="introtext">
            <?php echo lang('us_account_details'); ?>
        </p>
        <div class="row">
            <div class="col-md-3">
                <?php
                $canManageUser = false;
                if (!isset($user)) {
                    $canManageUser = true;
                } elseif ($this->auth->has_permission('Permissions.' . ucfirst($user->role_name) . '.Manage')) {
                    $canManageUser = true;
                }
                // ROl
                if ($canManageUser && $this->auth->has_permission('Bonfire.Roles.Manage')):
                    ?>
                    <div class="form-group">
                        <?php echo lang('us_role', 'role_id') ?>
                        <select name="role_id" id="role_id" class="form-control show-tick">
                            <?php
                            if (!empty($roles) && is_array($roles)):
                                foreach ($roles as $role):
                                    if ($this->auth->has_permission('Permissions.' . ucfirst($role->role_name) . '.Manage')):
                                        // The selected role is the role assigned to the
                                        // user or the site's default role.
                                        $selectedRole = isset($user) ? ($user->role_id == $role->role_id) : ($role->default == 1);
                                        ?>
                                        <option value="<?php echo $role->role_id; ?>" <?php echo set_select('role_id', $role->role_id, $selectedRole); ?>>
                                            <?php e(ucfirst($role->role_name)); ?>
                                        </option>
                                        <?php
                                    endif;
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                <?php endif; ?>
                <?php if (settings_item('auth.login_type') !== 'email' || settings_item('auth.use_usernames')): ?>
                    <?php
                    echo co_form_input(
                        array(
                            'id' => 'username',
                            'name' => 'username',
                            'class' => 'form-control',
                            'pattern' => '.{4,20}',
                            'required' => 'required'
                        ),
                        set_value('username', isset($user) && is_object($user) ? $user->username : ''),
                        lang('bf_username')
                    );
                    ?>
                <?php endif; ?>
                <?php
                echo co_form_email(
                    array(
                        'id' => 'email',
                        'name' => 'email',
                        'class' => 'form-control',
                        'required' => 'required',
                    ),
                    set_value('email', isset($user) && is_object($user) ? $user->email : ''),
                    lang('bf_email')
                );

                echo co_form_input(
                    array(
                        'id' => 'password',
                        'name' => 'password',
                        'class' => 'form-control',
                        'data-bv-regexp-message' => lang('us_pasword_hint')
                    ),
                    set_value('password', isset($gen_password) ? $gen_password : ''),
                    lang('bf_password'), '',
                    '<span class="help-block">' . lang('us_pasword_hint') . '</span>'
                );
                echo co_form_checkbox(
                    array(
                        'name' => 'employee',
                        'id' => 'employee'
                    ),
                    1,
                    isset($user->employee) && $user->employee == 1,
                    lang('us_employee')
                );
                ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo form_submit(
            array(
                'name' => 'save',
                'class' => 'btn btn-primary',
                'value' => ($this->uri->segment(2) == 'create') ? lang('bf_action_create') . ' ' . lang('bf_user') : lang('bf_action_save')
            )
        );
        echo anchor(base_url('users'), lang('bf_action_cancel'), array('class' => 'btn btn-link'));
        ?>
    </div>
    <?php echo form_close(); ?>
</div>