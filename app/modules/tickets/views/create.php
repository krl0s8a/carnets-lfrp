<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> <?php echo lang('create_ticket'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreate'] ?>
        <?php echo form_open('tickets/create', $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <?php
            // Codigo
            echo co_form_input(
                    array(
                        'name' => 'code',
                        'class' => 'form-control'
                    ),
                    set_value('code'),
                    lang('field_code')
            );
            // Descripcion
            echo co_form_input(
                    array(
                        'name' => 'name',
                        'class' => 'form-control',
                        'required' => 'required'
                    ),
                    set_value('name'),
                    lang('field_name')
            );
            // Precio
            echo co_form_number(
                    array(
                        'name' => 'price',
                        'id' => 'price',
                        'class' => 'form-control',
                        'required' => 'required',
                        'step' => 0.01,
                        'min' => 0
                    ),
                    set_value('price'),
                    lang('field_price')
            );
            // Cantidad
            echo co_form_number(
                    array(
                        'name' => 'quantity',
                        'id' => 'quantity',
                        'class' => 'form-control',
                        'required' => 'required',
                        'min' => 0
                    ),
                    set_value('quantity'),
                    lang('field_quantity')
            );
            ?>
        </div>        
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_add"><?php echo lang('btn_add') ?></button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>