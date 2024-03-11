<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> <?php echo lang('create_societe'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreate'] ?>
        <?php echo form_open('societe/create', $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="row">
                <div class="col-md-4">
                    <?php 
                    echo co_form_input(array(
                        'name' => 'name',
                        'id' => 'name',
                        'class' => 'form-control',
                        'required' => 'required',
                    ),set_value('name'),lang('lbl_name'));
                    ?>
                </div>
                <div class="col-md-4">
                    <?php 
                    echo co_form_input(array(
                        'name' => 'name_alias',
                        'id' => 'name_alias',
                        'class' => 'form-control'
                    ),set_value('name_alias'),lang('lbl_name_alias'));
                    ?>
                </div>
                <div class="col-md-4">
                    <?php 
                    echo co_form_dropdown(
                        array('name' => 'type','class' => 'form-control'), 
                        $types, 
                        set_value('type',0),
                        lang('lbl_type')
                    );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <?php 
                    echo co_form_dropdown(
                        array('name' => 'client','class' => 'form-control'), 
                        array(0 => 'No', 1 => 'Si'), 
                        set_value('client',0),
                        lang('lbl_client')
                    );
                    ?>
                </div>
                <div class="col-md-2">
                    <?php 
                    echo co_form_dropdown(
                        array('name' => 'provider','class' => 'form-control'), 
                        array(1 => 'Si', 0 => 'No'),
                        set_value('provider',1),
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
                    ),set_value('cuit'),lang('lbl_cuit'));
                    ?>
                </div>
                <div class="col-md-2">
                    <?php 
                    echo co_form_dropdown(
                        array('name' => 'iva','class' => 'form-control'), 
                        array(1 => 'Si', 0 => 'No'),
                        set_value('iva',1),
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
                    ),set_value('value_iva'),lang('lbl_value_iva'));
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
                    ),set_value('phone'),lang('lbl_phone'));
                    ?>
                </div>
                <div class="col-md-4">
                    <?php 
                    echo co_form_email(array(
                        'name' => 'email',
                        'id' => 'email',
                        'class' => 'form-control'
                    ),set_value('email'),lang('lbl_email'));
                    ?>
                </div>
                <div class="col-md-4">
                    <?php 
                    echo co_form_url(array(
                        'name' => 'url',
                        'id' => 'url',
                        'class' => 'form-control'
                    ),set_value('url'),lang('lbl_url'));
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <?php echo lang('lbl_address','address'); ?>
                        <textarea name="address" id="address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php 
                    // Provincia
                    echo co_form_dropdown(
                        array('name' => 'fk_state','class' => 'form-control'), 
                        $states, 
                        set_value('fk_state',2),
                        lang('lbl_fk_state')
                    );
                    // Ciudad
                    echo co_form_dropdown(
                        array('name' => 'fk_city','class' => 'form-control'), 
                        $cities, 
                        set_value('fk_city',1),
                        lang('lbl_fk_city')
                    );
                    ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_add"><?php echo lang('btn_add') ?></button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>