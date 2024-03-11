<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> <?php echo lang('edit_assign') . ' [' . $assign->id . ']'; ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmUpdate']; ?>
        <?php echo form_open('assignments/edit', $attrib); ?>
        <?php echo form_hidden('id', $assign->id); ?>
        <div class="modal-body">  
            <div class="alerts-modal"></div>          
            <p><strong><?php echo lang('field_drive') ?></strong> : <?php echo $assign->last_name . ' ' . $assign->first_name ?></p>
            <p><strong><?php echo lang('field_type_ticket') ?></strong> : <?php echo $assign->name; ?></p>
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
                            set_value('serial', $assign->serial),
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
                            set_value('number_ticket_start', $assign->number_ticket_start),
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
                            set_value('number_ticket_end', $assign->number_ticket_end),
                            lang('field_number_ticket_end')
                    )
                    ?>  
                </div>                
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_edit"><?php echo lang('btn_edit') ?></button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>
