<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i><?= lang('edit_line'); ?></h2>
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
                    <div class="col-md-4">
                        <!-- Nombre -->
                        <div class="form-group">
                            <?php
                            echo lang('field_name', 'name');
                            echo form_input(array(
                                'name' => 'name',
                                'id' => 'name',
                                'class' => 'form-control',
                                'required' => 'required',
                                'value' => isset($line) ? $line->name : ''
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <!-- CUIL -->
                        <div class="form-group">
                            <?php
                            echo lang('status', 'status');
                            echo form_dropdown('status', array('T' => lang('active'), 'F' => lang('inactive')), isset($line) ? $line->status : '', array('class' => 'form-control'));
                            ?>
                        </div>
                    </div>
                </div>                
                <div class="form-group">
                    <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('lines'), '<i class="fa fa-close"></i> ' . lang('cancel'), array('class' => 'btn btn-warning')); ?>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>