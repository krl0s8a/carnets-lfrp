<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Agregar tramo</h4>
        </div>
        <?php
        $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmTramo'];
        echo form_open('abonos/assignTramo', $attrib);
        ?>
        <?php
        echo form_hidden('school_id', $school->id);
        echo form_hidden('passenger_id', $passenger_id);
        ?>
        <div class="modal-body">
            <p>Nuevo tramo para llegar a la escuela : <?php echo $school->name; ?></p>
            <div class="alert" id="message" style="display: none;"></div>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Origen y destino</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                            echo lang('field_from', 'ffrom');
                            echo form_dropdown('ffrom', $cities, '', array('class' => 'form-control'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                            echo lang('field_to', 'tto');
                            echo form_dropdown('tto', $cities, '', array('class' => 'form-control'));
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="modal-footer">
            <span class="btn btn-primary add-tramo">Agregar</span>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>