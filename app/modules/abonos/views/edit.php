<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i>
            <?= lang('title_edit_abono'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'method' => 'post'];
    echo form_open($this->uri->uri_string(), $attrib);
    echo form_hidden('id', $abono->id);
    ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-3">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Pasajero</legend>
                    <?php
                    echo form_label(lang('lbl_type'));
                    echo '<p>' . $typepassenger[$abono->type] . '</p>';
                    echo form_label(lang('lbl_dni'));
                    echo '<p>' . $abono->dni . '</p>';
                    echo form_label(lang('lbl_last_name'));
                    echo '<p>' . $abono->last_name . '</p>';
                    if ($abono->type != 4) {
                        echo form_label(lang('lbl_first_name'));
                        echo '<p>' . $abono->first_name . '</p>';
                    }
                    echo anchor('passengers/edit/' . $abono->passenger_id, 'Detalles completo del pasajero >>', array('class' => 'btn-md btn-link'));
                    ?>
                </fieldset>
            </div>
            <div class="col-md-9">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Datos del abono :
                        <?php echo complete_digits($abono->id, 5); ?>
                    </legend>
                    <div class="row">
                        <!-- Nro de abono -->
                        <div class="col-md-2">
                            <?php
                            echo co_form_input(
                                array(
                                    'name' => 'id',
                                    'id' => 'id',
                                    'class' => 'form-control',
                                    'disabled' => 'disabled'
                                ),
                                set_value('id', complete_digits($abono->id, 5)),
                                lang('lbl_number_abono')
                            );
                            ?>
                        </div>
                        <?php if ($abono->type != 3): ?>
                            <!-- Periodo -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo form_label(lang('lbl_period'), 'period'); ?>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <?php
                                            $arr = explode('/', $abono->period);
                                            echo form_dropdown('month', months(), $arr[0], array('class' => 'form-control'));
                                            ?>
                                        </div>
                                        <div class="col-md-5">
                                            <?php echo form_dropdown('year', years(), $arr[1], date('Y'), array('class' => 'form-control'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Escuela -->
                            <div class="col-md-6" style="display: none;">
                                <?php
                                echo co_form_dropdown(
                                    array(
                                        'name' => 'school_id',
                                        'id' => 'school_id',
                                        'class' => 'form-control'
                                    ),
                                    $schools,
                                    set_select('school_id', $abono->school_id),
                                    lang('lbl_school')
                                );
                                ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="row">
                        <!-- Origen -->
                        <div class="col-md-6">
                            <?php
                            echo co_form_dropdown(
                                array(
                                    'name' => 'from',
                                    'id' => 'from',
                                    'class' => 'form-control'
                                ),
                                $cities,
                                set_value('from', $abono->from),
                                lang('lbl_from')
                            );
                            ?>
                        </div>
                        <!-- Destino -->
                        <div class="col-md-6">
                            <?php
                            echo co_form_dropdown(
                                array(
                                    'name' => 'to',
                                    'id' => 'to',
                                    'class' => 'form-control'
                                ),
                                $cities,
                                set_value('to', $abono->to),
                                lang('lbl_to')
                            );
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Viajes (ida) -->
                        <div class="col-md-2">
                            <?php
                            echo co_form_number(
                                array(
                                    'name' => 'ida',
                                    'id' => 'ida',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'min' => 0
                                ),
                                set_value('ida', $abono->ida),
                                lang('lbl_ida')
                            );
                            ?>
                        </div>
                        <!-- Viajes (vuelta) -->
                        <div class="col-md-2">
                            <?php
                            echo co_form_number(
                                array(
                                    'name' => 'vta',
                                    'id' => 'vta',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'min' => 0
                                ),
                                set_value('vta', $abono->vta),
                                lang('lbl_vta')
                            );
                            ?>
                        </div>
                        <!-- Linea -->
                        <div class="col-md-2">
                            <?php
                            echo co_form_dropdown(
                                array(
                                    'name' => 'line_id',
                                    'id' => 'line_id',
                                    'class' => 'form-control',
                                    'required' => 'required'
                                ),
                                $lines,
                                set_value('line_id', $abono->line_id),
                                lang('lbl_line')
                            );
                            ?>
                        </div>
                        <!-- Tarifa -->
                        <div class="col-md-2">
                            <?php
                            echo co_form_dropdown(
                                array(
                                    'name' => 'tariff_id',
                                    'id' => 'tariff_id',
                                    'class' => 'form-control',
                                    'required' => 'required'
                                ),
                                $tariffs,
                                set_value('tariff_id', $abono->tariff_id),
                                lang('lbl_tariff')
                            );
                            ?>
                        </div>
                        <!-- Precio -->
                        <div class="col-md-2">
                            <?php
                            echo co_form_number(
                                array(
                                    'name' => 'price',
                                    'class' => 'form-control',
                                    'step' => 0.01,
                                    'disabled' => 'disabled'
                                ),
                                set_value('price', $abono->price),
                                lang('lbl_price')
                            );
                            ?>
                        </div>
                        <!-- Descuento -->
                        <div class="col-md-2">
                            <?php
                            echo co_form_number(
                                array(
                                    'name' => 'discount',
                                    'class' => 'form-control',
                                    'min' => 0
                                ),
                                set_value('discount', $abono->discount),
                                lang('lbl_discount')
                            );
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Creacion -->
                        <div class="col-md-3">
                            <?php
                            echo co_form_input(
                                array(
                                    'name' => 'created_on',
                                    'class' => 'form-control',
                                    'disabled' => 'disabled'
                                ),
                                set_value('created_on', formatDateTime($abono->created_on, 'Y-m-d', 'd/m/Y')),
                                lang('lbl_created_on')
                            );
                            ?>
                        </div>
                        <!-- Actualizacion -->
                        <div class="col-md-3">
                            <?php
                            echo co_form_input(
                                array(
                                    'name' => 'modified_on',
                                    'class' => 'form-control',
                                    'disabled' => 'disabled'
                                ),
                                set_value('modified_on', formatDateTime($abono->modified_on, 'Y-m-d', 'd/m/Y')),
                                lang('lbl_modified_on')
                            );
                            ?>
                        </div>
                        <!-- Estado -->
                        <div class="col-md-4">
                            <?php
                            echo co_form_dropdown(
                                array(
                                    'name' => 'status',
                                    'class' => 'form-control'
                                ),
                                array('1' => 'Pendiente', '2' => 'Impreso', '3' => 'Anulado'),
                                set_value('status', $abono->status),
                                lang('lbl_status')
                            );
                            ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo form_submit(array('name' => 'save', 'class' => 'btn btn-primary'), lang('save'));
        echo form_submit(array('name' => 'print', 'class' => 'btn btn-default'), lang('print'));
        echo form_submit(array('name' => 'delete', 'class' => 'btn btn-danger'), lang('delete'));
        echo anchor('abonos', lang('cancel'), array('class' => 'btn btn-link'));
        ?>
    </div>
    <?php echo form_close(); ?>
</div>