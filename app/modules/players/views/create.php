<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('create_bus'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib)
        ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_create'); ?>
                </p>
                <div class="row">
                    <div class="col-md-3">
                        <?php
                        echo co_form_input(
                            array(
                                'name' => 'name',
                                'class' => 'form-control',
                                'required' => 'required'
                            ),
                            set_value('name'),
                            lang('lbl_name')
                        );
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                        echo co_form_input(
                            array(
                                'name' => 'registration',
                                'class' => 'form-control',
                                'required' => 'required'
                            ),
                            set_value('registration'),
                            lang('lbl_registration')
                        );
                        ?>
                    </div>
                    <!-- Modelo -->
                    <div class="col-md-3">
                        <?php
                        echo co_form_input(
                            array(
                                'name' => 'model',
                                'class' => 'form-control',
                                'required' => 'required'
                            ),
                            set_value('model'),
                            lang('lbl_model')
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
                            status_bus(),
                            set_value('status', 'T'),
                            lang('status')
                        );
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('buses'), lang('cancel'), array('class' => 'btn btn-link')); ?>
    </div>
    <?= form_close(); ?>
</div>