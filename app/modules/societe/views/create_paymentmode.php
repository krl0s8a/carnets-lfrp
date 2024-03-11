<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> <?php echo lang('create_paymentmode'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreatePaymentmode'] ?>
        <?php echo form_open('societe/create_paymentmode', $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <p><?php echo lang('info_create_paymentmode'); ?></p>
            <?php 
            echo form_hidden('fk_soc', $fk_soc);
            // Identificados
            echo co_form_input(array(
                'name' => 'label',
                'id' => 'label',
                'class' => 'form-control',
                'required' => 'required',
                'value' => 'CB-'.$label,
                'readonly' => 'readonly'
            ),set_value('label'),lang('lbl_label'));
            // Nombre banco
            echo co_form_input(array(
                'name' => 'bank',
                'id' => 'bank',
                'class' => 'form-control',
                'required' => 'required'
            ),set_value('bank'), lang('lbl_bank'));
            // Numero de la cuenta
            echo co_form_input(array(
                'name' => 'number',
                'id' => 'number',
                'class' => 'form-control',
                'required' => 'required'
            ),set_value('number'), lang('lbl_number'));
            // Direccion del banco
            ?>
            <div class="form-group">
                <?php echo lang('lbl_domiciliation','domiciliation'); ?>
                <textarea name="domiciliation" id="domiciliation" class="form-control"></textarea>
            </div>
            <?php
            // Nombre del dueño de la cuenta
            // echo co_form_input(array(
            //     'name' => 'proprio',
            //     'id' => 'proprio',
            //     'class' => 'form-control'
            // ),set_value('proprio'), lang('lbl_proprio'));
            // Direccion del dueño de la cuenta?>
            <!-- <div class="form-group">
                <?php echo lang('lbl_owner_address','owner_address'); ?>
                <textarea name="owner_address" id="owner_address" class="form-control"></textarea>
            </div> -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_add_paymentmode"><?php echo lang('btn_add_paymentmode') ?></button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>