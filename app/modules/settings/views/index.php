<?php

$errorClass = isset($errorClass) ? $errorClass : ' error';
$showExtendedSettings = !empty($extended_settings);
if ($showExtendedSettings) {
    $defaultCountry = 'US';
    $defaultState = '';
    $countryFieldId = false;
    $stateFieldId = false;
}

if (validation_errors()):
    ?>
    <div class="alert alert-block alert-error fade in">
        <a class="close" data-dismiss="alert">&times;</a>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-cog"></i>
            <?= $toolbar_title ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?= lang('set_update_info'); ?>
                </p>
                <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form']; ?>
                <?php echo form_open_multipart($this->uri->uri_string(), $attrib); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?= lang('set_tab_settings') ?>
                            </legend>
                            <?php Template::block('settingsMain', 'settings/index/main', array('errorClass' => $errorClass)); ?>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?= lang('set_tab_tickets') ?>
                            </legend>
                            <?php Template::block('settingsTicket', 'settings/index/ticket', array('errorClass' => $errorClass)); ?>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?= lang('set_tab_security') ?>
                            </legend>
                            <?php Template::block('settingsSecurity', 'settings/index/security', array('errorClass' => $errorClass)); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="cleafix"></div>
                <div class="form-group">
                    <?php
                    echo form_submit(
                        array(
                            'name'  => 'save',
                            'class' => 'btn btn-primary',
                            'value' => lang('bf_action_save') . ' ' . lang('bf_context_settings')
                        )
                    );
                    ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>