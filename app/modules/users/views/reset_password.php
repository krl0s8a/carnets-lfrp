<div class="alert alert-info fade in">
    <h4 class="alert-heading">
        <?php echo lang('us_reset_password_note'); ?>
    </h4>
</div>
<?php if (validation_errors()): ?>
    <div class="alert alert-error fade in">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i>
            Reset Your Password
        </h2>
    </div>
    <div class="box-content">
        <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal')); ?>
        <input type="hidden" name="user_id" value="<?php echo $user->id ?>" />

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">
                <?php echo lang('bf_password'); ?>
            </label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña...">
                <p class="help-block">
                    <?php echo lang('us_password_mins'); ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="pass_confirm" class="col-sm-2 control-label">
                <?php echo lang('bf_password_confirm'); ?>
            </label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="pass_confirm" id="pass_confirm"
                    placeholder="<?php echo lang('bf_password_confirm'); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="set_password" id="submit">
                    <?php e(lang('us_set_password')); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>