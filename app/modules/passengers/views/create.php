<div class="modal-dialog modal-md">
    <div class="modal-content">
        <?php
        $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreateAjax'];
        echo form_open($this->uri->uri_string(), $attrib)
            ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i>
                <?php echo lang('title_create_customer'); ?>
            </h4>
        </div>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <input type="hidden" name="people_id" id="people_id">
            <?php
            // type customer
            echo co_form_dropdown(
                array('name' => 'type', 'id' => 'type', 'class' => 'form-control'),
                types_of_passenger(),
                set_value('type', 2),
                lang('lbl_type')
            );
            echo co_form_number(
                array('name' => 'dni', 'id' => 'dni', 'class' => 'form-control', 'required' => 'required'),
                set_value('dni'),
                lang('lbl_dni')
            );
            echo co_form_input(
                array('name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'required' => 'required'),
                set_value('last_name'),
                lang('lbl_last_name')
            );
            echo co_form_input(
                array('name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control'),
                set_value('first_name'),
                lang('lbl_first_name')
            );

            // level
            echo co_form_dropdown(
                array('name' => 'level', 'id' => 'level', 'class' => 'form-control'),
                levelsCustomer(),
                set_value('level', ''),
                lang('lbl_level')
            );
            ?>
        </div>
        <div class="modal-footer">
            <?php
            echo form_button(
                array(
                    'name' => 'save',
                    'id' => 'btn_add',
                    'class' => 'btn btn-sm btn-primary'
                ),
                lang('save')
            );
            echo form_button(
                array(
                    'class' => 'btn btn-sm btn-default',
                    'data-dismiss' => 'modal'
                ),
                lang('close')
            )
            ?>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>