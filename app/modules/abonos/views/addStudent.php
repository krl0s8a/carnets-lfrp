<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Agregar alumno y/o origen/destino</h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreateStudent'] ?>
        <?php echo form_open('#', $attrib); ?>
        <input type="hidden" name="passenger_id" id="mpassenger_id">
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="row">
                <div class="col-md-4">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><?php echo lang('lgd_personal') ?></legend>   
                        <!-- DNI -->
                        <div class="form-group">
                            <?php
                            echo lang('field_dni', 'dni');
                            echo form_input(array(
                                'type' => 'number',
                                'name' => 'dni',
                                'id' => 'mdni',
                                'class' => 'form-control',
                                'required' => 'required',
                                'maxlength' => 8
                            ));
                            ?>
                        </div>                     
                        <!-- Apellido -->
                        <div class="form-group">
                            <?php echo lang('field_last_name', 'last_name'); ?>
                            <?php echo form_input('last_name', '', array('class' => 'form-control', 'required' => 'required', 'id' => 'mlast_name')); ?>
                        </div>
                        <!-- Nombre/s -->
                        <div class="form-group">
                            <?php echo lang('field_first_name', 'first_name'); ?>
                            <?php echo form_input('first_name', '', array('class' => 'form-control', 'required' => 'required', 'id' => 'mfirst_name')); ?>
                        </div>                        
                        <!-- Nivel -->                        
                        <div class="form-group">
                            <?php
                            $options = array('P' => 'Primario', 'S' => 'Secundario', 'T' => 'Terciario', 'U' => 'Universitario');
                            echo lang('field_level', 'level');
                            echo form_dropdown('level', $options, '', array('class' => 'form-control', 'id' => 'level'));
                            ?>
                        </div>                        
                    </fieldset>
                </div>
                <div class="col-md-8">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><?php echo lang('lgd_school') ?></legend>   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo lang('field_school', 'school_id'); ?>
                                    <select name="school_id" id="school_id" class="form-control">
                                        <option value="">--Seleccione--</option>
                                        <?php foreach ($schools as $k => $v): ?>
                                            <option value="<?= $k ?>"><?= $v ?></option>
                                        <?php endforeach ?>
                                    </select>                        			
                                </div>
                            </div>
                        </div>  
                        <p class="alert alert-info">Si no sabe cual es la Escuela del alumno puede agregarla despues.</p>
                        <div class="row">
                            <!-- Desde -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo lang('field_from', 'from'); ?>
                                    <?php echo form_dropdown('from', $cities, '', array('class' => 'form-control')); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Hasta -->
                                <div class="form-group">
                                    <?php echo lang('field_to', 'to'); ?>
                                    <?php echo form_dropdown('to', $cities, '', array('class' => 'form-control')); ?>
                                </div>
                            </div>                        	
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" name="save-student" id="save-student">Agregar</button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/bootstrapValidator.min.js') ?>"></script>