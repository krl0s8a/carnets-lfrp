<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                Añadir pago
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frm-add-pay'] ?>
        <?php echo form_open($this->uri->uri_string(), $attrib); ?>
        <?php echo form_hidden('fk_salary', $fk_salary); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <?php
            echo co_form_input(
                array(
                    'name' => 'date_payment',
                    'class' => 'form-control'
                ),
                set_value('date_payment', date('d/m/Y')),
                lang('lbl_date_payment')
            );
            echo co_form_dropdown(
                array(
                    'name' => 'type_payment',
                    'class' => 'form-control'
                ),
                types_of_payment(),
                set_value('type_payment'),
                lang('lbl_type_payment')
            );
            echo co_form_dropdown(
                array(
                    'name' => 'fk_bank_account',
                    'class' => 'form-control'
                ),
                $banks,
                set_value('fk_bank_account'),
                lang('lbl_bank_account')
            );
            echo co_form_input(
                array(
                    'name' => 'amount',
                    'class' => 'form-control',
                    'required' => 'required'
                ),
                set_value('amount', ($amount_salary - $total_payments)),
                lang('lbl_amount')
            );
            ?>
            <span><b>Monto total:</b> $
                <?= $amount_salary ?>
            </span><br>
            <span><b>Ya pagado:</b> $
                <?= $total_payments ?>
            </span><br>
            <span><b>Resta por pagar:</b> $
                <?= round(($amount_salary - $total_payments), 2) ?>
            </span>
            <?php
            echo form_hidden('amount_salary',$amount_salary);
            echo form_hidden('total_payments', empty($total_payments) ? 0 : $total_payments);
            ?>
        </div>
        <div class="modal-footer">
            <?php
            echo form_button(
                array(
                    'id' => 'btn-add-pay',
                    'class' => 'btn btn-sm btn-primary'
                ),
                lang('save')
            );
            echo form_button(
                array(
                    'class' => 'btn btn-sm btn-default',
                    'data-dismiss' => 'modal'
                ),
                lang('cancel')
            );
            ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>