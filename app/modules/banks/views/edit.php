<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i>
            <?= lang('title_edit_bank'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib);
    ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-4">
                <?php
                // Etiqueta, banco o caja
                echo co_form_input(array(
                    'name' => 'name',
                    'id' => 'name',
                    'class' => 'form-control',
                    'required' => 'required'
                ), set_value('name', isset($bank) ? $bank->name : ''), lang('lbl_bank_box'));
                // Tipo de cuenta
                echo co_form_dropdown(
                    array('name' => 'type', 'class' => 'form-control', 'required' => 'required'),
                    array(0 => 'Caja de ahorro', 1 => 'Cuenta corriente', 2 => 'Cuenta caja'),
                    set_value('type', 2),
                    lang('lbl_type')
                );
                // Moneda
                echo co_form_dropdown(
                    array('name' => 'corrency_code', 'class' => 'form-control', 'required' => 'required'),
                    array('ARS' => 'Peso Argentino ($)'),
                    set_value('corrency_code', 'ARS'),
                    lang('lbl_corrency_code')
                );
                // Estado
                echo co_form_dropdown(
                    array('name' => 'status', 'class' => 'form-control', 'required' => 'required'),
                    array(0 => 'Abierto', 1 => 'Cerrado'),
                    set_value('status', 0),
                    lang('lbl_status')
                );
                // Pais de la cuenta
                echo co_form_dropdown(
                    array('name' => 'fk_country', 'class' => 'form-control', 'required' => 'required'),
                    array('AR' => 'Argentina (AR)'),
                    set_value('fk_country', 'AR'),
                    lang('lbl_country')
                );
                ?>
            </div>
            <div class="col-md-4">
                <?php
                // Saldo inicial
                echo co_form_input(array(
                    'name' => 'amount',
                    'id' => 'amount',
                    'class' => 'form-control',
                    'value' => 0,
                    'min' => 0
                ), set_value('amount'), lang('lbl_amount'));
                // Fecha (Operacion / Valor)
                echo co_form_input(array(
                    'name' => 'date',
                    'id' => 'date',
                    'class' => 'form-control date',
                    'value' => date('d/m/Y')
                ), set_value('date'), lang('lbl_date'));
                ?>
                <div class="form-group">
                    <?php echo lang('lbl_comment', 'comment'); ?>
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>
            </div>
            <div class="no-caja">
                <div class="col-md-4">
                    <?php
                    // Nombre banco
                    echo co_form_input(array(
                        'name' => 'bank',
                        'id' => 'bank',
                        'class' => 'form-control'
                    ), set_value('bank'), lang('lbl_bank'));
                    // Numero de la cuenta
                    echo co_form_input(array(
                        'name' => 'number',
                        'id' => 'number',
                        'class' => 'form-control'
                    ), set_value('number'), lang('lbl_number'));
                    // Direccion del banco
                    ?>
                    <div class="form-group">
                        <?php echo lang('lbl_domiciliation', 'domiciliation'); ?>
                        <textarea name="domiciliation" id="domiciliation" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('banks'), lang('cancel'), array('class' => 'btn btn-link')); ?>
    </div>
    <?php echo form_close(); ?>
</div>