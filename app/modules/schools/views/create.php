<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('create_school'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib) ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-8">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Datos de la escuela</legend>
                    <div class="row">
                        <!-- Nombre -->
                        <div class="col-md-10">
                            <div class="form-group <?php echo form_error('name') ? 'has-error' : ''; ?>">
                                <?php
                                echo lang('field_name', 'name');
                                echo form_input(array(
                                    'name' => 'name',
                                    'id' => 'name',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'value' => set_value('name')
                                ));
                                ?>
                                <small class="help-block">
                                    <?php echo form_error('name'); ?>
                                </small>
                            </div>
                        </div>
                        <!-- Numero -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php
                                echo lang('field_number', 'number');
                                echo form_input(array(
                                    'name' => 'number',
                                    'id' => 'number',
                                    'class' => 'form-control',
                                    'value' => set_value('number')
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- CUe -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo lang('field_cue', 'cue');
                                echo
                                    form_input(
                                        array(
                                            'name' => 'cue',
                                            'id' => 'cue',
                                            'class' => 'form-control',
                                            'value' => set_value('cue')
                                        )
                                    );
                                ?>
                            </div>
                        </div>
                        <!-- Nivel -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo lang('field_level', 'level') ?>
                                <?php echo form_dropdown(
                                    'level',
                                    array(
                                        'Consejo' => 'Consejo',
                                        'Digemas' => 'Digemas'
                                    ),
                                    isset($school) ? $school->level : '',
                                    array(
                                        'class' => 'form-control'
                                    )
                                ) ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-4">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Contacto</legend>
                    <div class="row">
                        <!-- Telefono -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo lang('field_telephone', 'telephone') ?>
                                <?php echo form_input(
                                    array(
                                        'name' => 'telephone',
                                        'class' => 'form-control',
                                        'value' => set_value('telephone')
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                echo lang('field_location', 'city_id');
                                echo form_dropdown('city_id', $cities, isset($school) ? $school->city_id : '', array('class' => 'form-control'));
                                ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo form_submit(array('class' => 'btn btn-primary', 'name' => 'save'), lang('save'));
        echo anchor(site_url('schools'), lang('cancel'), array('class' => 'btn btn-link'));
        ?>
    </div>
    <?= form_close(); ?>
</div>