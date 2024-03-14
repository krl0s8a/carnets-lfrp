<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?= $player->last_name ? $player->last_name . ' ' . $player->first_name : $player->last_name; ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frm-player'] ?>
        <?php echo form_open('#', $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <input type="hidden" name="id" id="id" value="<?= $player->id; ?>">
            <?php 
            echo co_form_input(
                array(
                    'name' => 'first_name',
                    'id' => 'last_name',
                    'class' => 'form-control'
                ),
                set_value('first_name', $player->first_name),
                lang('lbl_first_name')
            );

            echo co_form_input(
                array(
                    'name' => 'last_name',
                    'id' => 'las_name',
                    'class' => 'form-control'
                ),
                set_value('last_name', $player->last_name),
                lang('lbl_last_name')
            );
            echo co_form_input(
                array(
                    'name' => 'dni',
                    'id' => 'dni',
                    'class' => 'form-control'
                ),
                set_value('dni', $player->dni),
                lang('lbl_dni')
            );
            echo co_form_input(
                array(
                    'name' => 'birth',
                    'id' => 'birth',
                    'class' => 'form-control date'
                ),
                set_value('birth', formatDate($player->birth,'Y-m-d','d/m/Y')),
                lang('lbl_birth')
            )
            ?>                    
        </div>
        <div class="modal-footer">              
                <span class="btn btn-sm btn-primary" id="save_player">
                    <?php echo lang('save') ?>
                </span>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                    <?= lang('close'); ?>
                </button>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>