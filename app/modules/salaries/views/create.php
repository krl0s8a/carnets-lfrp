<div class="box">
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib);
    ?>
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('salary_create'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-md-4">
                <?php
                // Empleado
                echo co_form_dropdown(
                    array('name' => 'fk_employee', 'class' => 'form-control'),
                    $employees,
                    set_value('fk_employee', 2),
                    lang('lbl_employee')
                );
                // Etiqueta
                echo co_form_input(array(
                    'name' => 'label',
                    'id' => 'label',
                    'class' => 'form-control',
                    'required' => 'required',
                    'value' => 'Sueldo'
                ), set_value('label'), lang('lbl_label'));
                // Fecha de inicio de periodo
                echo co_form_input(array(
                    'name' => 'date_start_period',
                    'id' => 'date_start_period',
                    'class' => 'form-control date',
                    'required' => 'required',
                    'placeholder' => 'dd/mm/aaaa'
                ), set_value('date_start_period', dataFirstMonthDay()), lang('lbl_date_start_period'));
                // Fecha final de periodo
                echo co_form_input(array(
                    'name' => 'date_end_period',
                    'id' => 'date_end_period',
                    'class' => 'form-control date',
                    'required' => 'required',
                    'placeholder' => 'dd/mm/aaaa'
                ), set_value('date_end_period', dataLastMonthDay()), lang('lbl_date_end_period'));
                // Monto
                echo co_form_input(array(
                    'name' => 'amount',
                    'id' => 'amount',
                    'class' => 'form-control',
                    'required' => 'required'
                ), set_value('amount'), lang('lbl_amount'));
                // Comentarios
                echo form_textarea(array(
                    'name' => 'note',
                    'id' => 'note',
                    'class' => 'form-control required'
                ), set_value('note'), lang('lbl_comment'));
                ?>
            </div>
            <div class="col-md-4">
                <?php
                // Cuenta Bancaria
                echo co_form_dropdown(
                    array('name' => 'fk_bank_account', 'class' => 'form-control'),
                    $banks,
                    set_value('fk_bank_account'),
                    lang('lbl_bank_account')
                );
                // Tipo de pago
                echo co_form_dropdown(
                    array('name' => 'type_payment', 'class' => 'form-control'),
                    $payments,
                    set_value('type_payment'),
                    lang('lbl_type_payment')
                );
                echo co_form_input(array(
                    'name' => 'date_payment',
                    'id' => 'date_payment',
                    'class' => 'form-control date',
                    'placeholder' => 'dd/mm/aaaa'
                ), set_value('date_payment', date('d/m/Y')), lang('lbl_date_payment'));
            
                echo co_form_checkbox(
                    array('name' => 'pay', 'id' => 'pay', 'class' => 'form-control'),
                    1,
                    true,
                    'Registrar automaticamente el pago'
                );
                ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('salaries'), lang('cancel'), array('class' => 'btn btn-link')); ?>
    </div>
    <?php echo form_close(); ?> 
</div>