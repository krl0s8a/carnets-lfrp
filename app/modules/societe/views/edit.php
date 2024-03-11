<?php echo validation_errors(); ?>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="<?php echo site_url('societe/edit/' . $societe->id); ?>" class="tab-grey">
                    <?php
                    echo lang('tab_societe'); ?>
                </a></li>
            <li><a href="<?php echo site_url('societe/paymentmodes/' . $societe->id); ?>">
                    <?php echo lang('payment_modes') ?>
                </a></li>
        </ul>
        <div id="tab-content">
            <div id="tab-1" class="tab-pane fade in">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-edit nb"></i>
                            <?= lang('lgd_edit'); ?>
                        </h2>
                    </div>
                    <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmEdit'] ?>
                    <?php echo form_open($this->uri->uri_string(), $attrib); ?>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                echo co_form_input(array(
                                    'name' => 'name',
                                    'id' => 'name',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ), set_value('name', $societe->name), lang('lbl_name'));
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php
                                echo co_form_input(array(
                                    'name' => 'name_alias',
                                    'id' => 'name_alias',
                                    'class' => 'form-control'
                                ), set_value('name_alias', $societe->name_alias), lang('lbl_name_alias'));
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php
                                echo co_form_dropdown(
                                    array('name' => 'type', 'class' => 'form-control'),
                                    $types,
                                    set_value('type', $societe->type),
                                    lang('lbl_type')
                                );
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <?php
                                echo co_form_dropdown(
                                    array('name' => 'client', 'class' => 'form-control'),
                                    array(0 => 'No', 1 => 'Si'),
                                    set_value('client', $societe->client),
                                    lang('lbl_client')
                                );
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php
                                echo co_form_dropdown(
                                    array('name' => 'provider', 'class' => 'form-control'),
                                    array(1 => 'Si', 0 => 'No'),
                                    set_value('provider', $societe->provider),
                                    lang('lbl_provider')
                                );
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php
                                echo co_form_input(array(
                                    'name' => 'cuit',
                                    'id' => 'cuit',
                                    'class' => 'form-control',
                                    'required' => 'required'
                                ), set_value('cuit', $societe->cuit), lang('lbl_cuit'));
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php
                                echo co_form_dropdown(
                                    array('name' => 'iva', 'class' => 'form-control'),
                                    array(1 => 'Si', 0 => 'No'),
                                    set_value('iva', $societe->iva),
                                    lang('lbl_iva')
                                );
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php
                                echo co_form_input(array(
                                    'name' => 'value_iva',
                                    'id' => 'value_iva',
                                    'class' => 'form-control'
                                ), set_value('value_iva', $societe->value_iva), lang('lbl_value_iva'));
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                echo co_form_telephone(array(
                                    'name' => 'phone',
                                    'id' => 'phone',
                                    'class' => 'form-control'
                                ), set_value('phone', $societe->phone), lang('lbl_phone'));
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php
                                echo co_form_email(array(
                                    'name' => 'email',
                                    'id' => 'email',
                                    'class' => 'form-control'
                                ), set_value('email', $societe->email), lang('lbl_email'));
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php
                                echo co_form_input(array(
                                    'name' => 'url',
                                    'id' => 'url',
                                    'class' => 'form-control',
                                ), set_value('url', $societe->url), lang('lbl_url'));
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php echo lang('lbl_address', 'address'); ?>
                                    <textarea name="address" id="address"
                                        class="form-control"><?php echo $societe->address; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                // Provincia
                                echo co_form_dropdown(
                                    array('name' => 'fk_state', 'class' => 'form-control'),
                                    $states,
                                    set_value('fk_state', $societe->fk_state),
                                    lang('lbl_fk_state')
                                );
                                // Ciudad
                                echo co_form_dropdown(
                                    array('name' => 'fk_city', 'class' => 'form-control'),
                                    $cities,
                                    set_value('fk_city', $societe->fk_city),
                                    lang('lbl_fk_city')
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_hidden('fk_country', 'AR'); ?>
                        <?php echo form_submit('save', lang('save'), array('class' => 'btn btn-primary')); ?>
                        <?php echo anchor('societe', lang('cancel'), array('class' => 'btn btn-link')) ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>