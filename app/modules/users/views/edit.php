<?php
defined('BASEPATH') or exit('No direct script access allowed');
$min_password_length = 'Minimo 8';
$currentMethod = $this->router->method;
$editSettings = $currentMethod == 'edit';
$attrib = ['data-toggle' => 'validator', 'role' => 'form', 'autocomplete' => 'off'];
echo form_open($this->uri->uri_string(), $attrib);
?>
<div class="row">
    <div class="col-sm-12">
        <ul id="myTab" class="nav nav-tabs">
            <li class="">
                <a href="#edit" class="tab-grey">
                    <?= lang('us_tab_edit') ?>
                </a>
            </li>
            <?php if ($user->employee_id != 0) { ?>
                <li>
                    <a href="<?php echo base_url('employees/edit/') . $user->employee_id ?>">
                        Información de empleado
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <div id="edit" class="tab-pane fade in">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-edit nb"></i>
                            <?= lang('us_edit_user'); ?>
                        </h2>
                    </div>
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
                                echo co_form_input(
                                    array(
                                        'id' => 'pass_confirm',
                                        'name' => 'pass_confirm',
                                        'class' => 'form-control',
                                        'data-bv-regexp-message' => lang('us_pasword_hint')
                                    ),
                                    set_value('pass_confirm'),
                                    lang('bf_password_confirm'), ''
                                );
                                if ($user->employee_id == 0) {
                                    ?>
                                    <label>El usuario no esta asociado a ningun empleado</label>
                                    <?php
                                    echo co_form_dropdown(
                                        array(
                                            'name' => 'employee_id',
                                            'id' => 'employee_id',
                                            'class' => 'form-control'
                                        ),
                                        $employees,
                                        set_value('employee_id'),
                                        'Seleccione empleado a vincular:'
                                    );
                                } else {
                                    echo co_form_checkbox(
                                        array(
                                            'name' => 'employee_id',
                                            'id' => 'employee_id'
                                        ),
                                        0,
                                        false,
                                        'Quitar empleado vinculado'
                                    );
                                }
                                ?>
                            </div>
                            <div class="col-md-3">
                                <div class="alert alert-info" style="margin-top: 30px;">Logs</div>
                                <p>
                                    <b>
                                        <?= lang('us_last_login') ?>
                                    </b> :
                                    <?= ($user->last_login <> '0000-00-00 00:00:00') ? formatDateTime($user->last_login, 'Y-m-d', 'd/m/Y') : '' ?>
                                </p>
                                <p>
                                    <b>
                                        <?= lang('us_last_ip') ?>
                                    </b> :
                                    <?= $user->last_ip ?>
                                </p>
                                <br>
                                <p>
                                    <b>
                                        <?= lang('bf_created_on') ?>
                                    </b> :
                                    <?= formatDateTime($user->created_on, 'Y-m-d', 'd/m/Y') ?>
                                </p>
                                <p>
                                    <b>
                                        <?= lang('bf_modified_on') ?>
                                    </b> :
                                    <?= ($user->modified_on <> '0000-00-00 00:00:00') ? formatDateTime($user->modified_on, 'Y-m-d', 'd/m/Y') : '' ?>
                                </p>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>