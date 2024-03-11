<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('create_trip'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib)
        ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_create'); ?>
                </p>
                <div class="row">
                    <div class="col-md-2">
                        <?php
                        echo co_form_dropdown(
                            array(
                                'name' => 'create_by',
                                'id' => 'create_by',
                                'class' => 'form-control'
                            ),
                            array('day' => lang('day'), 'period' => lang('period')),
                            '',
                            lang('create_by')
                        );
                        ?>
                    </div>
                    <div class="box-day col-md-2">
                        <?php
                        echo co_form_input(
                            array(
                                'name' => 'date',
                                'class' => 'form-control date'
                            ),
                            set_value('date', date('d/m/Y')),
                            'Dia del viaje'
                        );
                        ?>
                    </div>
                    <div class="box-period" style="display: none;">
                        <div class="col-md-2">
                            <?php
                            echo co_form_input(
                                array(
                                    'name' => 'start_date',
                                    'class' => 'form-control date'
                                ),
                                set_value('start_date', date('d/m/Y')),
                                'Desde'
                            );
                            ?>
                        </div>
                        <div class="col-md-2">
                            <?php
                            echo co_form_input(
                                array(
                                    'name' => 'end_date',
                                    'class' => 'form-control date'
                                ),
                                set_value('end_date'),
                                'Hasta'
                            );
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <?php echo lang('field_service', 'service_id');
                            ?>
                            <select required="required" name="service_id" id="service_id" class="form-control required">
                                <?php
                                foreach ($services as $k => $v) {
                                    ?>
                                    <option value="<?php echo $k; ?>">
                                        <?php echo $v; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <?php
                        echo co_form_dropdown(
                            array(
                                'name' => 'drive_id',
                                'class' => 'form-control'
                            ),
                            $drivers,
                            set_value('drive_id'),
                            lang('lbl_drive')
                        );
                        ?>
                    </div>
                    <div class="col-md-2">
                        <?php
                        echo co_form_dropdown(
                            array(
                                'name' => 'bus_id',
                                'class' => 'form-control'
                            ),
                            $buses,
                            set_value('bus_id'),
                            lang('lbl_bus')
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo form_submit(
            array(
                'name' => 'save',
                'class' => 'btn btn-primary'
            ),
            lang('save')
        );
        ?>
    </div>
    <?= form_close(); ?>
</div>