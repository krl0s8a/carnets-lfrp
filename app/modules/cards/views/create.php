<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('create_card'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib)
        ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Busque y seleccione al jugador para quien crear el carnet (puede buscar
                        por Apellido, Nombre o DNI)</div>
                    <div class="panel-body" style="padding: 5px;">
                        <div class="row">
                            <div class="col-md-4">
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
                                        <div class="input-group-addon no-print" style="padding: 2px 5px;">
                                            <a href="<?= site_url('players/create'); ?>" id="add-playerr"
                                                class="external" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-2x fa-plus-circle" id="addIcon"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                echo co_form_dropdown(
                                    array(
                                        'name' => 'season_id',
                                        'id' => 'season_id',
                                        'class' => 'form-control'
                                    ),
                                    $seasons,
                                    set_value('season_id'),
                                    'Torneo'
                                );
                                echo co_form_dropdown(
                                    array(
                                        'name' => 'team_id',
                                        'id' => 'team_id',
                                        'class' => 'form-control'
                                    ),
                                    $teams,
                                    set_value('team_id'),
                                    'Equipo'
                                );                                 
                                ?>
                                <div class="row">
                                    <div class="col-md-5">
                                    <?php
                                    
                                    echo co_form_dropdown(
                                        array(
                                            'name' => 'number',
                                            'id' => 'number',
                                            'class' => 'form-control',
                                            'required' => 'required'
                                        ),
                                        array(
                                            '00' => '00',
                                            '01' => '01',
                                            '02' => '02',
                                            '03' => '03',
                                            '04' => '04',
                                            '05' => '05',
                                            '06' => '06',
                                            '07' => '07',
                                            '08' => '08',
                                            '09' => '09',
                                            '10' => '10',
                                            '11' => '11',
                                            '12' => '12',
                                            '13' => '13',
                                            '14' => '14',
                                            '15' => '15',
                                            '16' => '16',
                                            '17' => '17',
                                            '18' => '18',
                                            '19' => '19',
                                            '20' => '20',
                                            '21' => '21',
                                            '22' => '22',
                                            '23' => '23',
                                            '24' => '24',
                                            '25' => '25'
                                        ),
                                        set_value('number'),
                                        lang('lbl_number')
                                    );
                                    ?>
                                    </div>
                                    <div class="col-md-7">
                                    <?php
                                    echo co_form_dropdown(
                                        array(
                                            'name' => 'type_player',
                                            'class' => 'form-control'
                                        ),
                                        type_player(),
                                        set_value('type_player'),
                                        lang('lbl_type_player')
                                    );
                                    ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    <?php
                                    echo co_form_input(
                                        array(
                                            'name' => 'date',
                                            'id' => 'date',
                                            'class' => 'form-control date',
                                            'required' => 'required'
                                        ),
                                        set_value('date', date('d/m/Y')),
                                        lang('lbl_date')
                                    );
                                    ?>
                                    </div>
                                    <div class="col-md-7">
                                    <?php
                                    echo co_form_dropdown(
                                            array(
                                                'name' => 'status',
                                                'class' => 'form-control'
                                            ),
                                            status_card(),
                                            set_value('status', 'Nuevo'),
                                            lang('lbl_status')
                                        );
                                    ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="obs" class="control-label"><?= lang('lbl_obs') ?></label>
                                        <div class="form-group">
                                            <textarea name="obs" id="obs" class="form-control" value="<?php echo set_value('obs') ?>"></textarea>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-8">  
                                <div class="form-group">
                                    <label for="">Seleccione camara</label>
                                    <div class="input-group">
                                        <select name="listaDeDispositivos" id="listaDeDispositivos" class="form-control"></select>
                                        <div class="input-group-addon">
                                            <a href="#" id="boton" class="external" title="Tomar foto">
                                                <i class="fa fa-camera"></i>
                                            </a>            
                                        </div>                                        
                                    </div>                               
                                </div>
                                <input type="hidden" id="location_photo" name="location_photo">
                                <p id="estado"></p>
                                <br>
                                <video muted="muted" id="video"></video>
                                <canvas id="canvas" style="display: none;"></canvas>
                            </div>      
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="box-footer ">
        <?php 
        // echo form_button(
        //     array(
        //         'name' => 'save',
        //         'id' => 'save',
        //         'type' => 'submit',
        //         'class' => 'btn btn-primary',
        //         'content' => '<i class="fa fa-print"></i> Guardar e imprimir'
        //     )
        // );
        echo form_button(
            array(
                'name' => 'saveandclose',
                'id' => 'saveandclose',
                'type' => 'submit',
                'class' => 'btn btn-primary',
                'content' => '<i class="fa fa-print"></i> '.lang('saveandclose')
            )
        );
        echo form_button(
            array(
                'name' => 'saveandnew',
                'id' => 'saveandnew',
                'type' => 'submit',
                'class' => 'btn btn-default',
                'content' => '<i class="fa fa-plus"></i> '.$this->lang->line('saveandnew')
            )
        ); 
        echo anchor(site_url('cards'), '<i class="fa fa-remove"></i> '.lang('close'), array('class' => 'btn btn-default')); 
        ?>
    </div>    
    <?= form_close(); ?>
</div>