<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Editar asignacion de jugador a torneo.</h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form','id' => 'frm-edit-player-team'];
        echo form_open('#', $attrib); ?>
        <div class="modal-body">      
            <input type="hidden" name="player_id" value="<?php echo $player->player_id ?>">
            <div class="row">
                <div class="col-md-5">
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
                    ?>
                </div>
                <div class="col-md-4">
                    <?php
                    echo co_form_input(
                        array(
                            'name' => 'last_name',
                            'id' => 'las_name',
                            'class' => 'form-control'
                        ),
                        set_value('last_name', $player->last_name),
                        lang('lbl_last_name')
                    ); 
                    ?>
                </div>
                <div class="col-md-3">
                    <?php
                    echo co_form_input(
                        array(
                            'name' => 'dni',
                            'id' => 'las_name',
                            'maxlength' => 8,
                            'class' => 'form-control'
                        ),
                        set_value('dni', $player->dni),
                        lang('lbl_dni')
                    ); 
                    ?>
                </div>
            </div>
            <div class="row">                
                <div class="col-md-5">
                    <?php
                    echo co_form_dropdown(
                        array(
                            'name' => 'type_player',
                            'class' => 'form-control'
                        ),
                        $type_player,
                        set_value('type_player', $player->type_player),
                        lang('lbl_type_player')
                    );
                    ?>
                </div>
                <div class="col-md-2">
                    <?php 
                    echo co_form_input(
                        array(
                            'name' => 'number',
                            'class' => 'form-control',
                            'maxlength' => 2
                        ),
                        set_value('number', $player->number),
                        lang('lbl_number')
                    ); 
                    ?>
                </div>
            </div> 
        </div>
        <div class="modal-footer">
            <?php
            echo form_button(
                array(
                    'name' => 'save',
                    'id' => 'btn-edit-player-team',
                    'class' => 'btn btn-sm btn-primary'
                ),
                lang('modify')
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
        <?php echo form_close(); ?>
    </div>
</div>