<div class="box">
    <div class="box-content">
        <?php if (empty($tables) || ! is_array($tables)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-error">
                        <p><?php echo lang('database_backup_no_tables'); ?></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php echo form_open(site_url('backup/backup')); ?>
            <?php foreach ($tables as $table): ?>
                <input type="hidden" name="tables[]" value="<?php e($table); ?>" />
            <?php endforeach ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p><?php echo lang('database_backup_warning'); ?></p>
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <?php echo lang('database_filename','file_name'); ?>
                        <?php echo form_input(
                            array(
                                'name' => 'file_name',
                                'id' => 'file_name',
                                'value' => set_value('file_name', empty($file) ? '' : $file),
                                'class' => 'form-control'
                            )
                        ); ?>
                    </div>
                </div>
            </div>          
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group <?php echo form_error('drop_tables') ? ' error' : ''; ?>">
                        <?php 
                        $drops = array(
                            '0' => lang('bf_no'),
                            '1' => lang('bf_yes') 
                        );
                        echo lang('database_drop_question','drop_tables');
                        echo form_dropdown('drop_tables', $drops, set_select('drop_tables'), array('class' => 'form-control', 'id' => 'drop_tables'));
                        ?>
                        <span class="help-inline"><?php echo form_error('drop_tables'); ?></span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group <?php echo form_error('add_inserts') ? ' error' : ''; ?>">
                        <?php 
                        $inserts = array(
                            '0' => lang('bf_no'),
                            '1' => lang('bf_yes') 
                        );
                        echo lang('database_insert_question','add_inserts');
                        echo form_dropdown('add_inserts', $inserts, set_select('add_inserts'), array('class' => 'form-control', 'id' => 'add_inserts'));
                        ?>
                         <span class="help-inline"><?php echo form_error('add_inserts'); ?></span>
                    </div>                    
                </div>
                <div class="col-md-2">
                    <div class="form-group <?php echo form_error('file_type') ? ' error' : ''; ?>">
                        <?php 
                        $options = array(
                            'txt' => lang('bf_none'),
                            'gzip' => lang('database_gzip'),
                            'zip' => lang('database_zip') 
                        );
                        ?>
                        <?php echo lang('database_compress_question','file_type'); ?>
                        <?php echo form_dropdown('file_type', $options, set_select('file_type'), array('class' => 'form-control', 'id' => 'file_type')); ?>
                        <span class="help-inline"><?php echo form_error('file_type'); ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <?php echo lang('database_restore_note'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="small form-group<?php echo form_error('tables') ? ' error' : ''; ?>">
                        <?php echo lang('database_backup_tables','table_names') ?>
                        <div id='table_names' class='controls'>
                            <span class='input-block-level uneditable-input'><?php e(implode(', ', $tables)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo form_submit('backup', lang('database_backup'), array('class' => 'btn btn-primary')); ?>
                <?php echo ' ' . lang('bf_or') . ' ' . anchor('backup', lang('bf_action_cancel')); ?>
            </div>
            <?php echo form_close(); ?>
        <?php endif; ?>

    </div>
</div>