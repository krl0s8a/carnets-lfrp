<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> <?php echo lang('new_salary'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreate'] ?>
        <?php echo form_open('rrhh/create_user', $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Rol
                    echo co_form_dropdown(
                            array('name' => 'state_id', 'class' => 'form-control'),
                            $roles,
                            set_value('state_id', 2),
                            lang('fd_fk_user')
                    );
                    // Nombre de usuario
                    echo co_form_input(array(
                        'name' => 'date_start',
                        'id' => 'date_start',
                        'class' => 'form-control date',
                        'required' => 'required',
                        'placeholder' => 'dd/mm/aaaa'
                            ), set_value('date_start'), lang('fd_date_start_lbl'));
                    // Correo electronico
                    echo co_form_input(array(
                        'name' => 'date_end',
                        'id' => 'date_end',
                        'class' => 'form-control date',
                        'required' => 'required',
                        'placeholder' => 'dd/mm/aaaa'
                            ), set_value('date_end'), lang('fd_date_end_lbl'));
                    ?>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary" id="btn_add"><?php echo lang('btn_add') ?></button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>