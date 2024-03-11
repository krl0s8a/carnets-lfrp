<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box" style="margin-bottom: 15px;">
    <?php echo form_open($this->uri->uri_string()); ?>
    <?php echo form_hidden('backup', '1'); ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-12">
                <p><?= lang('database_info_backup'); ?></p>
                <div class="table-responsive">
                    <table id="tables" cellpadding="0" cellspacing="0" border="0"
                   class="table table-condensed table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check"/></th>
                                <th><?php echo lang('database_table_name'); ?></th>
                                <th class='records'><?php echo lang('database_num_records'); ?></th>
                                <th><?php echo lang('database_data_size'); ?></th>
                                <th><?php echo lang('database_index_size'); ?></th>
                                <th><?php echo lang('database_data_free'); ?></th>
                                <th><?php echo lang('database_engine'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <label for='database-action'><?php echo lang('bf_with_selected'); ?>:</label>
                                    <select name="action" id='database-action' class="span2">
                                        <option value="backup"><?php echo lang('database_backup'); ?></option>
                                        <option value="repair"><?php echo lang('database_repair'); ?></option>
                                        <option value="optimize"><?php echo lang('database_optimize'); ?></option>
                                        <option>------</option>
                                        <option value="drop"><?php echo lang('database_drop'); ?></option>
                                    </select>
                                    <input type="submit" value="<?php echo lang('database_apply')?>" class="btn btn-primary" />
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($tables as $table) : ?>
                            <tr>
                                <td class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace" name='checked[]' value='<?php e($table->Name); ?>' checked="checked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </td> 
                                <td><a href="<?php e(site_url("backup/browse/{$table->Name}")); ?>"><?php e($table->Name); ?></a></td>
                                <td class='records'><?php echo $table->Rows; ?></td>
                                <td><?php e(is_numeric($table->Data_length) ? byte_format($table->Data_length) : $table->Data_length); ?></td>
                                <td><?php e(is_numeric($table->Index_length) ? byte_format($table->Index_length) : $table->Index_length); ?></td>
                                <td><?php e(is_numeric($table->Data_free) ? byte_format($table->Data_free) : $table->Data_free); ?></td>
                                <td><?php e($table->Engine); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>