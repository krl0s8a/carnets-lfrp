<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('new_assign'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form','id' => 'frmCreateAssign']; ?>
        <?php echo form_open('scrolls/assign', $attrib); ?>
        <input type="hidden" name="scroll_id" id="scroll_id" value="<?php echo $scroll->id; ?>">
        <div class="modal-body">  
            <div class="alerts-modal"></div>  
            <div class="form-group">
                <?php echo lang('field_drive','drive_id'); ?>
                <div class="input-group">
                    <select name="drive_id" id="drive_id" class="form-control">
                        <?php foreach ($drives as $k => $v): ?>
                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="input-group-addon no-print"><a><i title="Ver asignaciones en progreso del chofer" class="fa fa-eye" id="in_progress"></i></a></div>
                </div>                
                <small class="help-block">                    
                    <div id="assignments"></div>
                </small>
            </div>        
            <?php 
            echo co_form_dropdown(
                array(
                    'name' => 'ticket_id',
                    'id' => 'ticket_id',
                    'class' => 'form-control'
                ),
                $tickets,
                set_value('ticket_id',$scroll->id),
                lang('field_type_ticket')
            );
            ?>
            <div class="row">
                <div class="col-md-4">
                <?php 
                echo co_form_input(
                    array(
                        'name' => 'serial',
                        'id' => 'serial',
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ),
                    set_value('serial',$scroll->serial),
                    lang('field_serial')
                );
                ?>  

                </div>
                <div class="col-md-4">
                <?php 
                echo co_form_input(
                    array(
                        'name' => 'number_ticket_start',
                        'id' => 'number_ticket_start',
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ),
                    set_value('number_ticket_start',$scroll->ffrom),
                    lang('field_number_ticket_start')
                )
                ?>  
                </div>  
                <div class="col-md-4">
                <?php 
                echo co_form_input(
                    array(
                        'name' => 'number_ticket_end',
                        'id' => 'number_ticket_end',
                        'class' => 'form-control'
                    ),
                    set_value('number_ticket_end',$scroll->tto),
                    lang('field_number_ticket_end')
                )
                ?>  
                </div>                
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_to_assign"><?php echo lang('btn_to_assign') ?></button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>
