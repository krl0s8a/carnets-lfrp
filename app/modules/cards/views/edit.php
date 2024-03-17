<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>
                <?= $card->last_name.' '.$card->first_name ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmEdit'] ?>
        <?php echo form_open('#', $attrib); 
        echo form_hidden('player_id', $card->player_id);
        ?>
        
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <?php 
            echo co_form_dropdown(
                array(
                    'name' => 'season_id',
                    'id' => 'season_id',
                    'class' => 'form-control',
                    'readonly' => 'readonly'
                ),
                $seasons,
                set_value('season_id', $card->season_id),
                'Seleccione el torneo'
            );
            echo co_form_dropdown(
                array(
                    'name' => 'team_id',
                    'id' => 'team_id',
                    'class' => 'form-control',
                    'readonly' => 'readonly'
                ),
                $teams,
                set_value('team_id', $card->team_id),
                'Seleccione el equipo'
            );
            echo co_form_input(
                array(
                    'name' => 'number',
                    'id' => 'number',
                    'class' => 'form-control required'
                ),
                set_value('number', $card->number),
                lang('lbl_number')
            );
            echo co_form_dropdown(
                array(
                    'name' => 'type_player',
                    'class' => 'form-control'
                ),
                type_player(),
                set_value('type_player', $card->type_player),
                lang('lbl_type_player')
            );
            echo co_form_input(
                array(
                    'name' => 'datetime',
                    'id' => 'datetime',
                    'class' => 'form-control date'
                ),
                set_value('datetime', date('d/m/Y', strtotime($card->datetime))),
                lang('lbl_date')
            );
            echo co_form_dropdown(
                array(
                    'name' => 'category',
                    'class' => 'form-control'
                ),
                array(
                    1 => 'Masculino',
                    2 => 'Femenino',
                    3 => 'Standar Masculino',
                    4 => 'Standar Femenino'
                ),
                set_value('category'. $card->category),
                lang('lbl_category')
            );
            ?>
        </div>
        <div class="modal-footer">
            <span class="btn btn-sm btn-primary" id="btn_edit">
                <?php echo lang('save') ?>
            </span>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                <?= lang('close') ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>