<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('title_new_employee'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open('employees/create', $attrib)
        ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_create'); ?>
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?php echo lang('lgd_personal') ?>
                            </legend>
                            <?php
                            // Apellidpo
                            echo co_form_input(array(
                                'name' => 'last_name',
                                'id' => 'last_name',
                                'class' => 'form-control',
                                'required' => 'required'
                            ), set_value('last_name'), lang('last_name'));
                            // Nombre
                            echo co_form_input(array(
                                'name' => 'first_name',
                                'id' => 'first_name',
                                'class' => 'form-control',
                                'required' => 'required'
                            ), set_value('first_name'), lang('first_name'));
                            // fecha de nacimiento
                            echo co_form_input(array(
                                'name' => 'birth',
                                'id' => 'birth',
                                'class' => 'form-control date',
                                'placeholder' => 'dd/mm/aaaa'
                            ), set_value('birth'), lang('birth'));
                            // Genero
                            echo co_form_dropdown(
                                array(
                                    'name' => 'gender',
                                    'class' => 'form-control'
                                ),
                                genderSelect(),
                                set_value('gender'),
                                lang('gender')
                            );
                            //DNI
                            echo co_form_input(array(
                                'name' => 'dni',
                                'id' => 'dni',
                                'class' => 'form-control',
                                'required' => 'required',
                                'max_length' => '8',
                                'placeholder' => '99999999'
                            ), set_value('dni'), lang('dni'));
                            // CUIL
                            echo co_form_input(array(
                                'name' => 'cuil',
                                'id' => 'cuil',
                                'class' => 'form-control',
                                'required' => 'required',
                                'max_length' => '13',
                                'placeholder' => '11-11111111-1'
                            ), set_value('cuil'), lang('cuil'));
                            ?>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?php echo lang('lgd_laboral'); ?>
                            </legend>
                            <?php
                            // Posicion
                            echo co_form_dropdown(
                                array(
                                    'name' => 'position',
                                    'class' => 'form-control'
                                ),
                                positionSelect(),
                                set_value('position'),
                                lang('position')
                            );
                            // Legajo
                            echo co_form_number(array(
                                'name' => 'work_file',
                                'id' => 'work_file',
                                'class' => 'form-control',
                                'required' => 'required'
                            ), set_value('work_file'), lang('work_file'));
                            // Fecha de inicio contratacion
                            echo co_form_input(array(
                                'name' => 'dateemployment',
                                'id' => 'dateemployment',
                                'class' => 'form-control date',
                                'placeholder' => 'dd/mm/aaaa'
                            ), set_value('dateemployment'), lang('dateemployment'));
                            // Fecha Finalizacion contratación
                            echo co_form_input(array(
                                'name' => 'dateemploymentend',
                                'id' => 'dateemploymentend',
                                'class' => 'form-control date',
                                'placeholder' => 'dd/mm/aaaa'
                            ), set_value('dateemploymentend'), lang('dateemploymentend'));
                            ?>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?php echo lang('lgd_contact'); ?>
                            </legend>
                            <div class="form-group">
                                <?php echo lang('address', 'address'); ?>
                                <textarea name="address" id="address" rows="2" class="form-controll"></textarea>
                            </div>
                            <?php
                            // Provincia
                            echo co_form_dropdown(
                                array(
                                    'name' => 'state_id',
                                    'class' => 'form-control'
                                ),
                                $states,
                                set_value('state_id', 2),
                                lang('state')
                            );
                            // Localidad
                            echo co_form_dropdown(
                                array(
                                    'name' => 'city_id',
                                    'class' => 'form-control'
                                ),
                                $cities,
                                set_value('city_id', 1),
                                lang('city')
                            );
                            // Telegono movil
                            echo co_form_telephone(array(
                                'name' => 'movil_phone',
                                'id' => 'movil_phone',
                                'class' => 'form-control'
                            ), set_value('movil_phone'), lang('movil_phone'));
                            // Email
                            echo co_form_email(array(
                                'name' => 'email',
                                'id' => 'email',
                                'class' => 'form-control'
                            ), set_value('email'), lang('email'));
                            ?>
                        </fieldset>
                    </div>
                </div>
                <div class="form-group">

                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo form_button(
            array(
                'type' => 'submit',
                'name' => 'save',
                'class' => 'btn btn-primary'
            ),
            '<i class="fa fa-floppy-o"></i> ' . lang('save')
        );
        echo anchor('employees', lang('cancel'), array('class' => 'btn btn-link'))
            ?>
    </div>

    <?= form_close(); ?>
</div>