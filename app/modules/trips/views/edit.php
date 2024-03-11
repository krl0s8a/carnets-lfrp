<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i>
            <?= lang('edit_trip'); ?>
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
                    <?php echo lang('info_edit'); ?>
                </p>

                <div class="row">
                    <div class="col-md-7">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                Detalles del viaje
                            </legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php
                                        echo form_label('Dia del viaje', 'date');
                                        echo form_input('date', set_value('date', formatDate($trip->date, 'Y-m-d', 'd/m/Y')), array('class' => 'form-control date'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <?php
                                        echo lang('field_service', 'service_id');
                                        ?>
                                        <select required="required" name="service_id" id="service_id"
                                            class="form-control required">
                                            <?php
                                            foreach ($services as $v) {
                                                ?>
                                                <option <?php echo ($trip->service_id == $v->id) ? 'selected="selected"' : ''; ?> value="<?php echo $v->id; ?>">
                                                    <?php echo ' [' . $v->id . '] ' . $v->name . ' | ' ?>
                                                    <?php echo lang('field_departure') . ': ' . $v->departure_time ?>
                                                    <?php echo lang('field_arrival') . ': ' . $v->arrival_time ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo lang('lbl_bus', 'bus_id');
                                        echo form_dropdown('bus_id', $buses, set_select('bus_id', $trip->bus_id), array('class' => 'form-control', 'id' => 'bus_id'));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= lang('lbl_drive', 'drive_id') ?>
                                        <?php
                                        echo form_dropdown('drive_id', $drivers, set_select('drive_id', $trip->drive_id), array('class' => 'form-control'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php
                                        echo lang('field_type', 'type');
                                        echo form_dropdown('type', array('P' => 'Permanente', 'R' => 'Refuerzo'), set_value('type', $trip->type), array('class' => 'form-control'));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php
                                        echo lang('status', 'status');
                                        echo form_dropdown('status', array('T' => 'Habilitado', 'F' => 'Suspendido'), set_value('status', $trip->status), array('class' => 'form-control'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-5">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                Tipo de boletos asociados
                            </legend>
                            <p>
                                Tipos de boletos asociados al viaje
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (isset($tickets) && is_array($tickets)): ?>
                                        <?php foreach ($tickets as $k => $v): ?>
                                            <label for="t-<?= $v->id ?>">
                                                <input type="checkbox" <?php echo in_array($v->id, $tickets_trip) ? ' checked="checked" ' : ''; ?> value="<?= $v->id ?>" name="tickets[]"
                                                    id="t-<?= $v->id ?>">
                                                <?php echo $v->name; ?>
                                            </label>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="form-group">

                </div>

            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('trips'), lang('cancel'), array('class' => 'btn btn-link')); ?>
    </div>
    <?= form_close(); ?>
</div>