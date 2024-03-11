<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Nueva escuela</h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo form_open('passengers/addSchool', $attrib);
        ?>
        <div class="modal-body">        
            <div class="form-group">
                <?php
                echo lang('field_school', 'school');
                echo form_dropdown('school_id', $schools, '', array('class' => 'form-control select'));
                ?>
            </div>
        </div>
        <div class="modal-footer">

        </div>
    </div>
<?php echo form_close(); ?>
</div>

