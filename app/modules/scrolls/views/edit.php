<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> <?php echo lang('edit_scroll').' ['.$scroll->id.']'; ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validatorr', 'role' => 'form', 'id' => 'frmEditScroll'] ?>
        <?php echo form_open('scrolls/edit', $attrib); ?>
        <?php echo form_hidden('id', $scroll->id); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="row">
                <div class="col-md-6">
                    <?php 
                    echo co_form_dropdown(
                        array(
                            'name' => 'ticket_id',
                            'class' => 'form-control'
                        ),
                        $type_tickets,
                        $scroll->ticket_id,
                        lang('field_ticket_type')
                    );
                    ?>
                </div>
                <div class="col-md-6">
                    <?php 
                    echo co_form_number(
                        array(
                            'name' => 'serial',
                            'id' => 'serial',
                            'class' => 'form-control'
                        ),
                        set_value('serial',$scroll->serial),
                        lang('field_serial')
                    );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php 
                    echo co_form_number(
                        array(
                            'name' => 'ffrom',
                            'class' => 'form-control',
                            'min' => 1 
                        ),
                        set_value('ffrom',$scroll->ffrom),
                        lang('field_ticket_from')
                    );
                    ?>
                </div>
                <div class="col-md-6">
                    <?php 
                    echo co_form_number(
                        array(
                            'name' => 'tto',
                            'class' => 'form-control',
                            'min' => 00000 
                        ),
                        set_value('tto',$scroll->tto),
                        lang('field_ticket_to')
                    );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">                    
                    <?php 
                    echo co_form_number(
                        array(
                            'name' => 'quantity',
                            'class' => 'form-control',
                            'min' => 1
                        ),
                        set_value('quantity', $scroll->quantity),
                        lang('field_quantity')
                    );
                    ?>
                </div>
                <div class="col-md-6">
                    <?php 
                    echo co_form_dropdown(
                        array(
                            'name' => 'status',
                            'class' => 'form-control'
                        ),
                        array(
                            'Sin asignar' => 'Sin asignar',
                            'Asignado' => 'Asignado',
                            'Finalizado' => 'Finalizado',
                            'Anulado' => 'Anulado'
                        ),
                        $scroll->status,
                        lang('status')
                    );
                    ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <span class="btn btn-sm btn-primary" id="btn_edit"><?php echo lang('btn_edit') ?></span>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>