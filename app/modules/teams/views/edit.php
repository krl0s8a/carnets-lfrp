<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i> <?= lang('edit_team') ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frm-team'];
    echo form_open_multipart($this->uri->uri_string(), $attrib);
    echo form_hidden('id', isset($team) ? $team->id : '');
    ?>    
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_edit'); ?>
                </p>
                <div role="tabpanel">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab"><?= lang('tab-1') ?></a>
                        </li>
                        <li role="presentation">
                            <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab"><?= lang('tab-2') ?></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php
                                    $url = empty($team->t_emblem) ? base_url('assets/images/no-image.png') :
                                    base_url('assets/photos/shields/').$team->t_emblem 
                                    ?>
                                    <img width="100%" src="<?= $url ?>" alt="<?= $team->t_name ?>" class="img-rounded">
                                </div>
                                <div class="col-md-3">
                                    <?php 
                                    echo co_form_input(
                                        array(
                                            'name' => 't_name',
                                            'id' => 't_name',
                                            'class' => 'form-control'
                                        ),
                                        set_value('t_name', $team->t_name),
                                        lang('lbl_t_name')
                                    );

                                    echo co_form_input(
                                        array(
                                            'name' => 'short_name',
                                            'id' => 'short_name',
                                            'class' => 'form-control'
                                        ),
                                        set_value('short_name',$team->short_name),
                                        lang('lbl_short_name')
                                    );
                                    echo co_form_input(
                                        array(
                                            'name' => 't_city',
                                            'id' => 't_city',
                                            'class' => 'form-control'
                                        ),
                                        set_value('t_city', $team->t_city),
                                        lang('lbl_t_city')
                                    );
                                    // echo co_form_input(array(
                                    //     'name'     => 't_emblem',
                                    //     'id'       => 't_emblem',
                                    //     'type' => 'file',
                                    //     'class'    => 'form-control file',
                                    //     'data-browse-label' => 'Adjuntar',
                                    //     'data-show-upload' => false,
                                    //     'data-show-preview' => false
                                    // ), '', lang('lbl_t_emblem_change'));
                                    ?>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="t_descr"><?= lang('lbl_t_descr') ?></label>
                                        <textarea class="form-control" name="t_descr" id="t_descr"><?= set_value('t_descr',$team->t_descr) ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php 
                                    echo co_form_dropdown(
                                        array(
                                            'name' => 'season_id',
                                            'id' => 'season_id',
                                            'class' => 'form-control'
                                        ),
                                        $seasons,
                                        set_value('season_id'),
                                        'Seleccione el torneo'
                                    );
                                    ?>                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">Jugadores</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12" id="players"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">Agregar jugador</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
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
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
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
                                                <div class="col-md-2">
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
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <button class="btn btn-default" id="btn-add-player">
                                                        <i class="fa fa-plus"></i> Agregar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php 
        echo form_button(
            array(
                'name' => 'save',
                'id' => 'save',
                'type' => 'submit',
                'class' => 'btn btn-primary',
                'content' => '<i class="fa fa-edit"></i> '.$this->lang->line('save')
            )
        );
        echo form_button(
            array(
                'name' => 'saveandclose',
                'id' => 'saveandclose',
                'type' => 'submit',
                'class' => 'btn btn-default',
                'content' => '<i class="fa fa-chevron-down"></i> '.$this->lang->line('saveandclose')
            )
        ); 
        echo anchor(site_url('teams'), '<i class="fa fa-remove"></i> '.lang('close'), array('class' => 'btn btn-default')); 
        ?>
    </div>
    <?= form_close(); ?>
</div>