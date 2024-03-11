<div class="box">
    <div class="box-header">
        <div class="box-header">
            <h2 class="blue"><i class="fa-fw fa fa-edit"></i>
                <?= lang('edit_salary'); ?>
            </h2>
        </div>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib);
    ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-4">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">
                        <?php echo lang('fdt_salary') ?>
                    </legend>
                    <?php
                    // Empleado
                    echo co_form_dropdown(
                        array('name' => 'fk_employee', 'class' => 'form-control'),
                        $employees,
                        set_value('fk_employee', $salary->fk_employee),
                        lang('lbl_employee')
                    );
                    // Etiqueta
                    echo co_form_input(array(
                        'name' => 'label',
                        'id' => 'label',
                        'class' => 'form-control',
                        'required' => 'required'
                    ), set_value('label', isset($salary) ? $salary->label : ''), lang('lbl_label'));
                    // Fecha de inicio de periodo
                    echo co_form_input(array(
                        'name' => 'date_start_period',
                        'id' => 'date_start_period',
                        'class' => 'form-control date',
                        'required' => 'required',
                        'placeholder' => 'dd/mm/aaaa'
                    ), set_value('date_start_period', isset($salary) ? formatDate($salary->date_start_period, 'Y-m-d', 'd/m/Y') : ''), lang('lbl_date_start_period'));
                    // Fecha final de periodo
                    echo co_form_input(array(
                        'name' => 'date_end_period',
                        'id' => 'date_end_period',
                        'class' => 'form-control date',
                        'required' => 'required',
                        'placeholder' => 'dd/mm/aaaa'
                    ), set_value('date_end_period', isset($salary) ? formatDate($salary->date_end_period, 'Y-m-d', 'd/m/Y') : ''), lang('lbl_date_end_period'));
                    // Monto
                    echo co_form_input(array(
                        'name' => 'amount',
                        'id' => 'amount',
                        'class' => 'form-control',
                        'required' => 'required'
                    ), set_value('amount', isset($salary) ? $salary->amount_salary : ''), lang('lbl_amount'));
                    // Comentarios
                    echo form_textarea(array(
                        'name' => 'note',
                        'id' => 'note',
                        'class' => 'form-control required'
                    ), set_value('note', isset($salary) ? $salary->note : ''), lang('lbl_comment'));
                    ?>
                </fieldset>
            </div>
            <div class="col-md-8">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">
                        <?php echo lang('fdt_payments') ?>
                    </legend>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($payments) && !empty($payments)) {
                                $this->load->view('payments_by_salary');
                            } else {
                                echo 'No se efectuo ningun pago todavia.';
                            }
                            ?>

                            <?php
                            if ($salary->status != 1) {
                                echo anchor(
                                    site_url('salaries/add_pay/' . $salary->id . '/' . $salary->amount_salary),
                                    lang('btn_add_pay'),
                                    array('class' => 'btn btn-warning', 'data-toggle' => 'modal', 'data-target' => '#myModal')
                                );
                            }
                            ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo form_submit('save', lang('save'), 'class="btn btn-primary"');

        echo anchor(site_url('salaries'), lang('cancel'), array('class' => 'btn btn-link'));
        ?>
    </div>
    <?= form_close() ?>
</div>