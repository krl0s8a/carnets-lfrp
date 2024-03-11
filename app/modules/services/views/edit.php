<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i>
            <?= lang('edit_service'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib);
    ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_edit'); ?>
                </p>
                <div class="row">
                    <div class="col-md-5">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">General</legend>
                            <div class="form-group">
                                <?php echo lang('field_name', 'name'); ?>
                                <?php echo form_input(
                                    array(
                                        'name' => 'name',
                                        'class' => 'form-control',
                                        'required' => 'required',
                                        'value' => set_value('name', isset($service->name) ? $service->name : '')
                                    )
                                ); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo lang('field_route', 'route_id_');
                                echo form_dropdown('route_id_', $routes, $service->route_id, array('class' => 'form-control', 'disabled' => 'disabled'));
                                echo form_hidden('route_id', $service->route_id);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php echo lang('field_period', 'period'); ?>
                                <div class="form-inline">
                                    Desde :
                                    <?php echo form_input(array('name' => 'start_date', 'class' => 'form-control date', 'size' => 10, 'value' => formatDate($service->start_date, 'Y-m-d', 'd/m/Y'))) ?>
                                    Hasta :
                                    <?php echo form_input(array('name' => 'end_date', 'class' => 'form-control date', 'size' => 10, 'value' => formatDate($service->end_date, 'Y-m-d', 'd/m/Y'))) ?>
                                </div>
                            </div>
                            <?php $days = explode('|', $service->recurring); ?>
                            <div class="form-group">
                                <?php echo lang('field_recurring', 'recurring'); ?>
                                <div class="form-check">
                                    <?php
                                    echo form_checkbox('recurring[]', 'monday', in_array('monday', $days) ? TRUE : FALSE, array('id' => 'monday', 'class' => 'form-check-input'));

                                    echo form_label(lang('every_monday'), 'monday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    echo form_checkbox('recurring[]', 'tuesday', in_array('tuesday', $days) ? TRUE : FALSE, array('id' => 'tuesday', 'class' => 'form-check-input'));
                                    echo form_label(lang('every_tuesday'), 'tuesday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    echo form_checkbox('recurring[]', 'wednesday', in_array('wednesday', $days) ? TRUE : FALSE, array('id' => 'wednesday', 'class' => 'form-check-input'));
                                    echo form_label(lang('every_wednesday'), 'wednesday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    echo form_checkbox('recurring[]', 'thursday', in_array('thursday', $days) ? TRUE : FALSE, array('id' => 'thursday', 'class' => 'form-check-input'));
                                    echo form_label(lang('every_thursday'), 'thursday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    echo form_checkbox('recurring[]', 'friday', in_array('friday', $days) ? TRUE : FALSE, array('id' => 'friday', 'class' => 'form-check-input'));
                                    echo form_label(lang('every_friday'), 'friday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    echo form_checkbox('recurring[]', 'saturday', in_array('saturday', $days) ? TRUE : FALSE, array('id' => 'saturday', 'class' => 'form-check-input'));
                                    echo form_label(lang('every_saturday'), 'saturday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    echo form_checkbox('recurring[]', 'sunday', in_array('sunday', $days) ? TRUE : FALSE, array('id' => 'sunday', 'class' => 'form-check-input'));
                                    echo form_label(lang('every_sunday'), 'sunday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-7">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Detalles del recorrido</legend>
                            <div class="form-group" id="bs_service_locations">
                                <?php echo Template::block('locations', 'services/getLocations'); ?>
                            </div>
                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo form_submit('service_update', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('services'), lang('cancel'), array('class' => 'btn btn-link')); ?>
    </div>
    <?= form_close(); ?>
</div>