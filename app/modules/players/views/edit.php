<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i>
            Jugador: <?= $player->last_name.' '.$player->first_name ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open_multipart($this->uri->uri_string(), $attrib);
    echo form_hidden('id', isset($player) ? $player->id : '');
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
                                    if (!empty($player->photo) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/'.$player->photo)) {
                                        $url = base_url('assets/photos/players/').$player->photo;
                                    } else {
                                        $url = base_url('assets/images/no-image.png');
                                    }
                                    // }
                                    // $url = empty($player->photo) ? base_url('assets/images/no-image.png') :
                                    // base_url('assets/photos/players/').$player->photo;
                                    ?>
                                    <img width="100%" src="<?= $url ?>" alt="Foto <?= $player->last_name ?>" class="img-circle"> 
                                </div>
                                <div class="col-md-3">
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
                                            'id' => 'las_name',
                                            'class' => 'form-control'
                                        ),
                                        set_value('dni', $player->dni),
                                        lang('lbl_dni')
                                    );
                                    echo co_form_input(
                                        array(
                                            'name' => 'birth',
                                            'id' => 'las_name',
                                            'class' => 'form-control date'
                                        ),
                                        set_value('birth', formatDate($player->birth,'Y-m-d','d/m/Y')),
                                        lang('lbl_birth')
                                    );
                                    echo co_form_input(array(
                                        'name'     => 'photo',
                                        'id'       => 'photo',
                                        'type' => 'file',
                                        'class'    => 'form-control file',
                                        'data-browse-label' => 'Adjuntar',
                                        'data-show-upload' => false,
                                        'data-show-preview' => false
                                    ), '', lang('lbl_photo'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <?php 
                                    echo co_form_dropdown(
                                        array(
                                            'name' => 'season_id',
                                            'id' => 'season_id',
                                            'class' => 'form-control'
                                        ),
                                        $seasons,
                                        set_value('season_id'),
                                        'Seleccione la temporada'
                                    );
                                    ?>
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
        echo anchor(site_url('players'), '<i class="fa fa-remove"></i> '.lang('close'), array('class' => 'btn btn-default')); 
        ?>
    </div>
    <?= form_close(); ?>
</div>