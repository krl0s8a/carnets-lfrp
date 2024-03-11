<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$min_password_length = 'Minimo 8';
echo validation_errors();
?>
<div class="row">
    <div class="col-sm-12">
        <ul id="myTab" class="nav nav-tabs">
            <li class=""><a href="#edit" class="tab-grey">
                    <?= lang('us_profile') ?>
                </a></li>
            <li class=""><a href="#cpassword" class="tab-grey">
                    <?= lang('us_change_password') ?>
                </a></li>
        </ul>
        <div class="tab-content">
            <div id="edit" class="tab-pane fade in">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-edit nb"></i>
                            <?= lang('us_edit_profile'); ?>
                        </h2>
                    </div>
                    <?php
                    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                    echo form_open($this->uri->uri_string() . '#edit', $attrib);
                    ?>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-md-5">
                                <!-- Rol -->
                                <?php
                                $canManageUser = false;
                                if (!isset($user)) {
                                    $canManageUser = true;
                                } elseif ($this->auth->has_permission('Permissions.' . ucfirst($user->role_name) . '.Manage')) {
                                    $canManageUser = true;
                                }
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
                                                        ??
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
                                    <?php
                                endif;
                                // Nombre de usuario
                                echo co_form_input(
                                    array(
                                        'name' => 'username',
                                        'id' => 'username',
                                        'class' => 'form-control',
                                        'pattern' => '.{4,20}',
                                        'required' => 'required'
                                    ),
                                    set_value('username', isset($user) ? $user->username : ''),
                                    lang('bf_username')
                                );
                                // Correo electronico
                                echo co_form_email(
                                    array(
                                        'name' => 'email',
                                        'id' => 'email',
                                        'class' => 'form-control',
                                        'required' => 'required'
                                    ),
                                    set_value('email', isset($user) ? $user->email : ''),
                                    lang('bf_email')
                                );
                                ?>
                            </div>
                            <div class="col-md-6 col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-warning">
                                            <div class="panel-heading">Registros de acceso</div>
                                            <div class="panel-body" style="padding: 5px;">
                                                <div class="form-group">
                                                    <?php
                                                    echo '<p>' . lang('us_last_login') . ': ' . formatDateTime($user->last_login, 'Y-m-d', 'd/m/Y') . '</p>';
                                                    echo '<p>' . lang('us_last_ip') . ': ' . $user->last_ip . '</p>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php echo form_hidden('id', $user->id); ?>
                                <?php // echo form_hidden($csrf);  ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('update', lang('save'), 'class="btn btn-primary"'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div id="cpassword" class="tab-pane fade">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-key nb"></i>
                            <?= lang('us_change_password'); ?>
                        </h2>
                    </div>
                    <?php echo form_open($this->uri->uri_string() . '#cpassword', array('id' => 'change-password-form', 'data-toggle' => 'validator')); ?>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-md-5">
                                <?php
                                // Contraseña antigua
                                echo co_form_password(
                                    array(
                                        'name' => 'old_password',
                                        'id' => 'curr_password',
                                        'required' => 'required',
                                        'class' => 'form-control'
                                    ),
                                    '',
                                    lang('us_old_password')
                                );
                                // Contraseña nueva
                                echo co_form_password(
                                    array(
                                        'name' => 'password',
                                        'id' => 'password',
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'data-bv-regexp-message' => lang('pasword_hint')
                                    ),
                                    '',
                                    sprintf(lang('bf_password'), $min_password_length)
                                );
                                // Confirmar contraseña nueva
                                echo co_form_password(
                                    array(
                                        'name' => 'pass_confirm',
                                        'id' => 'pass_confirm',
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'data-bv-identical' => true,
                                        'data-bv-identical-field' => 'password',
                                        'data-bv-regexp-message' => lang('pw_not_same')
                                    ),
                                    '',
                                    sprintf(lang('bf_password_confirm'), $min_password_length)
                                );
                                echo form_hidden('id', isset($user->id) ? $user->id : '');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('change_password', lang('us_change_password'), 'class="btn btn-primary"'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>