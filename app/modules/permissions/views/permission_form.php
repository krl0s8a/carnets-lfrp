<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('perm_details'); ?></h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo form_open($this->uri->uri_string(), $attrib);
    ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo lang('field_name', 'name') ?>
                    <?php
                    echo form_input(array(
                        'id' => 'name',
                        'name' => 'name',
                        'value' => set_value('name', isset($permissions) ? $permissions->name : ''),
                        'class' => 'form-control',
                        'maxlength' => 30,
                        'required' => 'required'
                    ));
                    ?>
                </div>                
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo lang('perm_description', 'description') ?>
                    <?php
                    echo form_input(array(
                        'id' => 'description',
                        'name' => 'description',
                        'value' => set_value('description', isset($permissions) ? $permissions->description : ''),
                        'class' => 'form-control',
                        'maxlength' => 100
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo lang('status', 'status') ?>
                    <?php
                    $options = array(
                        'active' => lang('active'),
                        'inactive' => lang('inactive'),
                        'deleted' => lang('deleted')
                    );
                    echo form_dropdown(array('name' => 'status', 'id' => 'status', 'class' => 'form-control'), $options, isset($permissions) ? $permissions->status : '');
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo form_submit(
                            array(
                                'name' => 'save',
                                'class' => 'btn btn-primary',
                                'value' => lang('perm_save')
                            )
                    );
                    echo anchor(site_url('permissions'), lang('bf_action_cancel'), array('class' => 'btn btn-warning'));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>