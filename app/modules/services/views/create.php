<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('create_service'); ?>
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
                    <?php echo lang('info_create'); ?>
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
                                        'value' => set_value('name')
                                    )
                                ); ?>
                            </div>
                            <div class="form-group" style="display: none;">
                                <?php
                                echo lang('field_line', 'line_id');
                                echo form_dropdown('line_id', $lines, '', array('class' => 'form-control', 'id' => 'line_id'));
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo lang('field_route', 'route_id'); ?>
                                <select name="route_id" id="route_id" class="form-control" required="required">
                                    <option value="">-- Seleccione el recorrido --</option>
                                    <?php if (isset($routes) && is_array($routes)): ?>
                                        <?php foreach ($routes as $k => $v): ?>
                                            <?php $d = ($v->direction == 1) ? 'Ida' : 'Vuelta'; ?>
                                            <option value="<?= $v->id ?>">
                                                <?php echo "[$v->id] " . $v->name . ' - ' . $d . ' (Linea : ' . $v->line . ')'; ?>
                                            </option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php echo lang('field_period', 'period'); ?>
                                <div class="form-inline">
                                    Desde :
                                    <?php echo form_input(array('name' => 'start_date', 'class' => 'form-control date', 'size' => 10, 'value' => date('d/m/Y'))) ?>
                                    Hasta :
                                    <?php echo form_input(array('name' => 'end_date', 'class' => 'form-control date', 'size' => 10)) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo lang('field_recurring', 'recurring'); ?>
                                <div class="form-check">
                                    <?php echo form_checkbox(
                                        array(
                                            'name' => 'recurring[]',
                                            'id' => 'monday',
                                            'value' => 'monday',
                                            'checked' => 'checked',
                                            'class' => 'form-check-input'
                                        )
                                    );
                                    echo form_label(lang('every_monday'), 'monday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php echo form_checkbox(
                                        array(
                                            'name' => 'recurring[]',
                                            'id' => 'tuesday',
                                            'value' => 'tuesday',
                                            'checked' => 'checked',
                                            'class' => 'form-check-input'
                                        )
                                    );
                                    echo form_label(lang('every_tuesday'), 'tuesday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php echo form_checkbox(
                                        array(
                                            'name' => 'recurring[]',
                                            'id' => 'wednesday',
                                            'value' => 'wednesday',
                                            'checked' => 'checked',
                                            'class' => 'form-check-input'
                                        )
                                    );
                                    echo form_label(lang('every_wednesday'), 'wednesday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php echo form_checkbox(
                                        array(
                                            'name' => 'recurring[]',
                                            'id' => 'thursday',
                                            'value' => 'thursday',
                                            'checked' => 'checked',
                                            'class' => 'form-check-input'
                                        )
                                    );
                                    echo form_label(lang('every_thursday'), 'thursday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php echo form_checkbox(
                                        array(
                                            'name' => 'recurring[]',
                                            'id' => 'friday',
                                            'value' => 'friday',
                                            'checked' => 'checked',
                                            'class' => 'form-check-input'
                                        )
                                    );
                                    echo form_label(lang('every_friday'), 'friday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php echo form_checkbox(
                                        array(
                                            'name' => 'recurring[]',
                                            'id' => 'saturday',
                                            'value' => 'saturday',
                                            'checked' => 'checked',
                                            'class' => 'form-check-input'
                                        )
                                    );
                                    echo form_label(lang('every_saturday'), 'saturday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php echo form_checkbox(
                                        array(
                                            'name' => 'recurring[]',
                                            'id' => 'sunday',
                                            'value' => 'sunday',
                                            'checked' => 'checked',
                                            'class' => 'form-check-input'
                                        )
                                    );
                                    echo form_label(lang('every_sunday'), 'sunday', array('class' => 'form-check-label'));
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-7">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Detalle del recorrido</legend>
                            <div class="form-group" id="bs_service_locations"></div>
                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo form_submit('service_create', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('services'), lang('cancel'), array('class' => 'btn btn-link')); ?>
    </div>
    <?= form_close(); ?>
</div>