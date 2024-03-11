<div class="row">
    <!--Method activation--->
    <div class="col-md-2" style="display: none;">
        <div class="form-group">
            <?php echo form_label(lang('bf_activate_method'), 'user_activation_method'); ?>
            <?php
            $options = array(
                '0' => lang('bf_activate_none'),
                '1' => lang('bf_activate_email'),
                '2' => lang('bf_activate_admin')
            );
            echo form_dropdown(
                array(
                    'name'  => 'user_activation_method',
                    'id'    => 'user_activation_method', 'class' => 'form-control'
                ),
                $options,
                isset($settings['auth.user_activation_method']) ? $settings['auth.user_activation_method'] : '');
            ?>
        </div>
    </div>
    <!--Type access-->
    <div class="col-md-2">
        <div class="form-group">
            <?php echo form_label(lang('bf_login_type'), 'login_type'); ?>
            <?php
            $options = array(
                'email'    => lang('bf_login_type_email'),
                'username' => lang('bf_login_type_username'),
                'both'     => lang('bf_login_type_both')
            );
            echo form_dropdown(
                array(
                    'name'  => 'login_type',
                    'id'    => 'login_type', 'class' => 'form-control'
                ),
                $options, isset($settings['auth.login_type']) ? $settings['auth.login_type'] : ''
            );
            ?>
        </div>
    </div>
    <!---Remember lenghth-->
    <div class="col-md-2">
        <div class="form-group" <?php echo form_error('remember_length') ? $errorClass : ''; ?> id="remember-length"
            <?php echo $settings['auth.allow_remember'] ? '' : ' style="display:none"'; ?>>
            <?php echo form_label(lang('bf_remember_time'), 'remember_length'); ?>
            <?php
            $options = array(
                '604800'  => '1 ' . lang('bf_week'),
                '1209600' => '2 ' . lang('bf_weeks'),
                '1814400' => '3 ' . lang('bf_weeks'),
                '2592000' => '30 ' . lang('bf_days')
            );
            echo form_dropdown(array('name' => 'remember_length', 'id' => 'remember_length', 'class' => 'form-control'), $options, isset($settings['auth.remember_length']) ? $settings['auth.remember_length'] : '');
            ?>
        </div>
    </div>
    <!-- Paswword min length-->
    <div class="col-md-2">
        <div class="form-group">
            <?php echo form_label(lang('bf_password_strength'), 'remember_length'); ?>
            <?php
            echo form_input(
                array(
                    'name'  => 'password_min_length',
                    'id'    => 'password_min_length',
                    'value' => set_value('password_min_length', isset($settings['auth.password_min_length']) ? $settings['auth.password_min_length'] : ''),
                    'class' => 'form-control'
                )
            );
            ?>
            <small>
                <?php echo lang('bf_password_length_help'); ?>
            </small>
        </div>
    </div>
    <!--Allow remember-->
    <div class="col-md-2">
        <div class="form-group"><br>
            <?php echo form_label(
                lang('bf_allow_remember') . ' ' . form_checkbox(array('name' => 'allow_remember', 'id' => 'allow_remember'), 1, isset($settings['auth.allow_remember']) && $settings['auth.allow_remember'] == 1),
                'allow_remember'
            ); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo form_label(lang('set_force_reset')); ?>
            <a href="<?php echo site_url('users/force_password_reset_all'); ?>" class="btn btn-danger"
                onclick="return confirm('<?php echo lang('set_password_reset_confirm'); ?>');">
                <?php echo lang('set_reset'); ?>
            </a>
            <small>
                <?php echo lang('set_reset_note'); ?>
            </small>
        </div>
    </div>
</div>