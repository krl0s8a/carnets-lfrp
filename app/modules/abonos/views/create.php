<?php echo validation_errors(); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('create_abono'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'method' => 'post', 'id' => 'frmCreate'];
    echo form_open($this->uri->uri_string(), $attrib);
    ?>
    <input type="hidden" name="people_id" id="people_id">
    <div class="box-content">
        <div class="row">
            <div class="col-md-3">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Pasajero</legend>
                    <div class="form-group">
                        <label for="">Seleccione pasajero:</label>
                        <?php
                        echo form_dropdown(
                            array(
                                'name' => 'passenger_id',
                                'id' => 'passenger_id',
                                'class' => 'form-control'
                            ),
                            $passengers,
                            set_value('passenger_id')
                        );
                        ?>
                        <span class="help-block">Si no encuentra al pasajero, debera agregarlo primero.</span>
                    </div>
                    <a href="">Agregar nuevo pasajero</a>
                </fieldset>
            </div>
            <div class="col-md-9">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Datos del abono</legend>
                    <div class="row">
                        <!-- Periodo -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo form_label(lang('lbl_period'), 'period'); ?>
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php echo form_dropdown('month', months(), date('m'), array('class' => 'form-control')); ?>
                                    </div>
                                    <div class="col-md-5">
                                        <?php echo form_dropdown('year', years(), date('Y'), array('class' => 'form-control'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Escuela -->
                        <div class="col-md-6 col-md-offset-2">
                            <?php
                            echo co_form_dropdown(
                                array(
                                    'name' => 'school_id',
                                    'id' => 'school_id',
                                    'class' => 'form-control'
                                ),
                                $schools,
                                set_value('school_id'),
                                lang('lbl_school')
                            );
                            ?>
                        </div>
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
                                set_value('from'),
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
                                set_value('to'),
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
                                set_value('ida'),
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
                                    'min' => 0,
                                    'value' => 0
                                ),
                                set_value('vta'),
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
                                array(),
                                set_value('line_id'),
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
                                array(),
                                set_value('tariff_id'),
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
                                set_value('price'),
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
                                set_value('discount', 0),
                                lang('lbl_discount')
                            );
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Estado -->
                        <div class="col-md-4">
                            <?php
                            echo co_form_dropdown(
                                array(
                                    'name' => 'status',
                                    'class' => 'form-control'
                                ),
                                array('1' => 'Pendiente', '2' => 'Impreso', '3' => 'Anulado'),
                                set_select('status'),
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
        echo anchor('abonos', lang('cancel'), array('class' => 'btn-link'))
            ?>
    </div>
    <?php echo form_close(); ?>
</div>