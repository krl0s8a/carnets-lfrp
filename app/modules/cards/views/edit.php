<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>
                JUGADOR/A: <?= $card->last_name.' '.$card->first_name ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmEdit'] ?>
        <?php echo form_open('#', $attrib); 
        echo form_hidden('player_id', $card->player_id);
        ?>        
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        if (!empty($card->photo) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/photos/'.$card->photo)) {
                            $url = base_url('assets/uploads/photos/'.$card->photo);
                        } else if(!empty($card->photo_player) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/'.$card->photo_player)){
                            $url = base_url('assets/photos/players/'.$card->photo_player);
                        } else {
                            $url = base_url('assets/images/no-image.png');
                            $no_photo = '<p>Jugador/a sin foto. Agregue la foto desde <a href="'.base_url('players/edit/'.$card->player_id).'">aqui</a> para que salga en el carnet.</p>';
                        }
                        ?>
                        <img width="50%" src="<?= $url ?>"  class="img-round"> 
                        <?php if (isset($no_photo)): ?>
                            <?php echo $no_photo; ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-md-6">
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
                        'Torneo'
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
                        'Equipo'
                    );
                    echo co_form_dropdown(
                        array(
                            'name' => 'category',
                            'class' => 'form-control'
                        ),
                        array(
                            1 => 'Masculino Libre',
                            2 => 'Femenino Libre',
                            3 => 'Masculino Estandar',
                            4 => 'Femenino Estandar'
                        ),
                        set_value('category', $card->category),
                        lang('lbl_category')
                    );
                    ?>
                </div>
            </div>           
            <div class="row">
                <div class="col-md-3">
                    <?php 
                    echo co_form_input(
                        array(
                            'name' => 'number',
                            'id' => 'number',
                            'class' => 'form-control required'
                        ),
                        set_value('number', $card->number),
                        lang('lbl_number')
                    );
                    ?>
                </div>
                <div class="col-md-3">
                    <?php 
                    echo co_form_dropdown(
                        array(
                            'name' => 'type_player',
                            'class' => 'form-control'
                        ),
                        type_player(),
                        set_value('type_player', $card->type_player),
                        lang('lbl_type_player')
                    );
                    ?>
                </div>
                <div class="col-md-3">
                    <?php 
                    echo co_form_input(
                        array(
                            'name' => 'datetime',
                            'id' => 'datetime',
                            'class' => 'form-control date'
                        ),
                        set_value('datetime', date('d/m/Y', strtotime($card->datetime))),
                        lang('lbl_date')
                    );
                    ?>
                </div>
                <div class="col-md-3">
                    <?php 
                    echo co_form_dropdown(
                        array(
                            'name' => 'status',
                            'class' => 'form-control'
                        ),
                        array(
                            'T' => 'Habilitado',
                            'F' => 'Pendiente'
                        ),
                        set_value('status', $card->status),
                        lang('lbl_status')
                    );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="obs" class="control-label">Observacion</label>
                    <div class="form-group">
                        <textarea name="obs" id="obs" class="form-control"><?php echo $card->obs ?></textarea>
                    </div>
                </div>
            </div>
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