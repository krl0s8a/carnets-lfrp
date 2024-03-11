<?php
$attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreateAbono'];
echo validation_errors();
?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= $toolbar_title ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li><a href="#"><i class="fa fa-plus-circle"></i> <?= lang('create_teacher'); ?></a></li>                 
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <?php echo form_open($this->uri->uri_string(), $attrib); ?>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><?php echo lang('lgd_general') ?></legend>
                    <div class="row">                        
                        <!-- Tipo de pasajero -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php echo form_label(lang('lbl_type'), 'type'); ?>    
                                <select name="type" id="type" class="form-control">
                                    <option value="1">Docente</option>
                                    <option value="2">Alumno</option>
                                </select>
                            </div>
                        </div>      
                        <!-- Escuela -->
                        <div class="col-md-4">
                            <div class="form-group <?php echo form_error('school_id') ? ' has-error' : ''; ?>">
                                <?php
                                echo form_label(lang('lbl_school'), 'school_id');
                                echo form_dropdown('school_id', $schools, set_value('school_id'), array('class' => 'form-control', 'id' => 'school_id', 'required' => 'required'));
                                ?>
                                <span class="help-block"><?php echo form_error('school_id'); ?></span>
                            </div>
                        </div>                  
                        <!-- Mes -->
                        <div class="col-md-3">
                            <div class="form-group">                            
                                <?php
                                echo form_label('Periodo', 'period');
                                ?>
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php echo form_dropdown('month', months(), date('m'), array('class' => 'form-control', 'id' => 'month')); ?>
                                    </div>
                                    <div class="col-md-5">
                                        <?php echo form_dropdown('year', years(), date('Y'), array('class' => 'form-control', 'id' => 'year'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button id="step-1" class="btn btn-primary" style="margin-top: 30px;" title="Continuar">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </div> 
                        </div>
                    </div>                 
                </fieldset>  
                <div id="div_grid" style="display: none;">    
                    <div class="row">
                        <div class="col-md-12" id="grid"></div>
                    </div>                          
                </div>                  
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>