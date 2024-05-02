<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i> <?= lang('create_team') ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open_multipart($this->uri->uri_string(), $attrib);
    ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_create'); ?>
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
                                <div class="col-md-3">
                                    <?php 
                                    echo co_form_input(
                                        array(
                                            'name' => 't_name',
                                            'id' => 't_name',
                                            'class' => 'form-control'
                                        ),
                                        set_value('t_name'),
                                        lang('lbl_t_name')
                                    );

                                    echo co_form_input(
                                        array(
                                            'name' => 'short_name',
                                            'id' => 'short_name',
                                            'class' => 'form-control'
                                        ),
                                        set_value('short_name'),
                                        lang('lbl_short_name')
                                    );
                                    echo co_form_input(
                                        array(
                                            'name' => 't_city',
                                            'id' => 't_city',
                                            'class' => 'form-control'
                                        ),
                                        set_value('t_city'),
                                        lang('lbl_t_city')
                                    );
                                    echo co_form_input(array(
                                        'name'     => 't_emblem',
                                        'id'       => 't_emblem',
                                        'type' => 'file',
                                        'class'    => 'form-control file',
                                        'data-browse-label' => 'Adjuntar',
                                        'data-show-upload' => false,
                                        'data-show-preview' => false
                                    ), '', lang('lbl_t_emblem'));
                                    ?>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="t_descr"><?= lang('lbl_t_descr') ?></label>
                                        <textarea class="form-control" name="t_descr" id="t_descr"><?= set_value('t_descr') ?></textarea>
                                    </div>
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
                                        array(),
                                        set_value('season_id'),
                                        'Seleccione el torneo'
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
                'name' => 'saveandnew',
                'id' => 'saveandnew',
                'type' => 'submit',
                'class' => 'btn btn-default',
                'content' => '<i class="fa fa-chevron-down"></i> '.$this->lang->line('saveandnew')
            )
        ); 
        echo anchor(site_url('teams'), '<i class="fa fa-remove"></i> '.lang('close'), array('class' => 'btn btn-default')); 
        ?>
    </div>
    <?= form_close(); ?>
</div>