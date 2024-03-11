<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('create_trip'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('info_create'); ?></p>
                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo form_open($this->uri->uri_string(), $attrib)
                ?>
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
                                        //echo lang('Crear viaje por','type_trip');
                                        ?>
                                        <label for="type_trip">Crear viaje por</label><br>
                                        <label><input type="radio" id="type_day" value="0" name="type_trip" checked="checked">Día</label>
                                        <label><input type="radio" id="type_period" value="1" name="type_trip">Periódo</label>
                                    </div>
                                </div>
                                <div class="box-day">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php 
                                            echo form_label('Dia del viaje', 'date');
                                            echo form_input('date', date('d/m/Y'), array('class' => 'form-control date'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-period" style="display: none;">
                                    <div class="col-md-2">  
                                        <div class="form-group">
                                            <?php 
                                            echo form_label('Desde', 'start_date');
                                            echo form_input('start_date', date('d/m/Y'), array('class' => 'form-control date'));
                                            ?>
                                        </div>                      
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php 
                                            echo form_label('Hasta', 'end_date');
                                            echo form_input('end_date', date('d/m/Y'), array('class' => 'form-control date'));
                                            ?>
                                        </div>
                                    </div>                        
                                </div>                    
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <?php 
                                        echo lang('field_service', 'service_id');                     
                                        ?>
                                        <select required="required" name="service_id" id="service_id" class="form-control required">
                                            <?php
                                            foreach ($services as $v) {
                                                ?>
                                                <option value="<?php echo $v->id; ?>">
                                                    <?php echo $v->name.' | ' ?>
                                                    <?php echo lang('field_departure').': '.$v->departure_time ?>
                                                    <?php echo lang('field_arrival').': '.$v->arrival_time ?>
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
                                        echo lang('field_bus','bus_id');
                                        echo form_dropdown('bus_id', $buses,'',array('class' => 'form-control','id' => 'bus_id'));
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= lang('field_drive', 'drive_id') ?>
                                        <?php
                                        echo form_dropdown('drive_id', $choferes, '',array('class' => 'form-control'));
                                                    ?>
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo lang('field_type','type'); 
                                        echo form_dropdown('type', array('P' => 'Permanente','R' => 'Refuerzo'), 'P', array('class' => 'form-control'));
                                        ?>
                                    </div>
                                </div>    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo lang('status','status'); 
                                        echo form_dropdown('status', array('T' => 'Habilitado','F' => 'Suspendido'), 'T', array('class' => 'form-control'));
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
                                Seleccione los tipos de boletos asociados al viaje o viajes
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (isset($tickets) && is_array($tickets)): ?>
                                    <?php foreach ($tickets as $k => $v): ?>
                                        <label for="t-<?= $v->id ?>">
                                            <input type="checkbox" value="<?= $v->id ?>" name="tickets[]" id="t-<?= $v->id ?>">
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
                    <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('trips'), '<i class="fa fa-close"></i> '.lang('cancel'), array('class' => 'btn btn-warning')); ?>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>