<div id="login">
    <div class="container">
        <div class="login-form-div">
            <div class="login-content">
                <?php echo form_open(LOGIN_URL, array('autocomplete' => 'off', 'id' => 'sign_in', 'class' => 'login', 'data-toggle' => 'validator')); ?>
                <div class="div-title col-sm-12">
                    <h3 class="text-primary"><?= lang('us_login') ?></h3>
                </div>
                <?php echo Template::message(); ?>
                <div class="col-sm-12">
                    <div class="form-group textbox-wrap">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?php
                            echo form_input(array(
                                'type' => 'text',
                                'name' => 'login',
                                'class' => 'form-control',
                                'value' => set_value('login'),
                                'tabindex' => 1,
                                'placeholder' => $this->settings_lib->item('auth.login_type') == 'both' ? lang('us_username') . '/' . lang('us_email') : lang('bf_' . $this->settings_lib->item('auth.login_type')),
                                'autofocus' => 'autofocus',
                                'autocomplete' => 'off',
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="form-group textbox-wrap">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <?php
                            echo form_input(array(
                                'type' => 'password',
                                'name' => 'password',
                                'class' => 'form-control',
                                'tabindex' => 2,
                                'placeholder' => lang('us_password'),
                                'required' => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-action col-sm-12">
                    <div class="checkbox pull-left">
                        <div class="custom-checkbox">
                            <?php echo form_checkbox('remember_me', '1', false, 'id="remember_me"'); ?>
                        </div>
                        <span class="checkbox-text pull-left"><label for="remember_me"><?= lang('us_remember_note') ?></label></span>
                    </div>
                    <button type="submit" name="log-me-in" class="btn btn-success pull-right"><?= lang('us_let_me_in') ?> &nbsp; <i class="fa fa-sign-in"></i></button>
                </div>
                <?php echo form_close(); ?>     
                <div class="clearfix"></div>
            </div>
            <div class="login-form-links link2" style="display: none;">
                <h4 class="text-danger"><?= lang('us_forgot_your_password') ?></h4>
                <span><?= lang('us_dont_worry') ?></span>
                <a href="#forgot_password" class="text-danger forgot_password_link"><?= lang('click_here') ?></a>
                <span><?= lang('us_to_rest') ?></span>
            </div>
        </div>        
    </div>
</div>
<div id="forgot_password" style="display: none;">
    <div class="container">
        <div class="login-form-div">
            <div class="login-content">
                <?php echo form_open('users/forgot_password', array('autocomplete' => 'off', 'class' => 'login', 'data-toggle' => 'validator')); ?>
                <div class="div-title col-sm-12">
                    <h3 class="text-primary"><?= lang('us_reset_password') ?></h3>         
                </div>
                <div class="col-sm-12">
                    <div class="textbox-wrap form-group">
                        <div class="input-group">
                            <span class="input-group-addon "><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" required="required" placeholder="<?= lang('us_email') ?>"/>
                        </div>
                    </div>
                    <div class="form-action">
                        <a class="btn btn-success pull-left login_link" href="#login">
                            <i class="fa fa-chevron-left"></i> <?= lang('back') ?>
                        </a>
                        <button type="submit" class="btn btn-primary pull-right">
                            <?= lang('submit') ?> &nbsp;&nbsp; <i class="fa fa-envelope"></i>
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>      
            </div>
        </div>
    </div>
</div>