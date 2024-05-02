<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Agregar jugador a torneo</h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo form_open('passengers/addSchool', $attrib);
        ?>
        <div class="modal-body">      
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?= lang('lbl_player', 'posplayer'); ?>
                        <div class="input-group">
                            <input type="hidden" name="player" value="" id="posplayer"
                                class="form-control" style="width:100%;" placeholder="Seleccione jugador">
                            <input type="hidden" name="player_id" value="" id="player_id"
                                class="form-control">

                            <div class="input-group-addon no-print" style="padding: 2px 5px; border-left: 0;">
                                <a href="#" id="view-player" class="external" data-toggle="modal"
                                    data-target="#myModal">
                                    <i class="fa fa-2x fa-user" id="addIcon"></i>
                                </a>
                            </div>
                            <!-- <div class="input-group-addon no-print" style="padding: 2px 5px;">
                                <a href="<?= site_url('passengers/create'); ?>" id="add-passenger"
                                    class="external" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-2x fa-plus-circle" id="addIcon"></i>
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php 
                    echo co_form_input(
                        array(
                            'name' => 'number',
                            'class' => 'form-control'
                        ),
                        set_value('number'),
                        'Carnet'
                    ); 
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    echo co_form_dropdown(
                        array(
                            'name' => 'type_player',
                            'class' => 'form-control'
                        ),
                        $type_player,
                        set_value('type_player'),
                        'Tipo jugador'
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
                    'id' => 'btn_add',
                    'class' => 'btn btn-sm btn-primary'
                ),
                lang('add')
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
    </div>
<?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/select2.min.js') ?>"></script>