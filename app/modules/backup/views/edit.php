<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('edit_city'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('info_edit'); ?></p>
                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo form_open($this->uri->uri_string(), $attrib)
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <!-- Codigo -->
                            <div class="form-group">
                                <?php 
                                echo lang('field_code','code');
                                echo form_input(array(
                                    'name' => 'code',
                                    'id' => 'code',
                                    'class' => 'form-control',
                                    'value' => isset($city) ? $city->code : ''
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Nombre -->
                            <div class="form-group">
                                <?php 
                                echo lang('field_name','name');
                                echo form_input(array(
                                    'name' => 'name',
                                    'id' => 'name',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'value' => isset($city) ? $city->name : ''
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                             <!-- CUIL -->
                            <div class="form-group">
                                <?php 
                                echo lang('status','status');
                                echo form_dropdown('status', array('T' => lang('active'),'F' => lang('inactive')), isset($city) ? $city->status : '', array('class' => 'form-control'));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
                        <?php echo form_submit('save_and_back', $this->lang->line('save').' y volver', 'class="btn btn-primary"'); ?>
                        <?php echo anchor(site_url('cities'), '<i class="fa fa-close"></i> '.lang('cancel'), array('class' => 'btn btn-warning')); ?>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>