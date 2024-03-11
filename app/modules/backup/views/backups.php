<?php

$databaseUrl = site_url(SITE_AREA . '/developer/database');
$numColumns = 4;

?>
<div class="box">
    <div class="box-content">
        <div class="row">
            <div class="col-md-12">
                <?php if (empty($backups) || ! is_array($backups)) : ?>
                <div class="alert alert-info">
                    <p><?php echo lang('database_no_backups'); ?></p>
                </div>
                <?php
                else :
                    echo form_open($this->uri->uri_string());
                ?>
                    <table cellpadding="0" cellspacing="0" border="0"
                   class="table table-condensed table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check"/>
                                </th>
                                <th><?php echo lang('bf_action_download'); ?></th>
                                <th><?php echo lang('database_restore'); ?></th>
                                <th id='db_size_column'><?php echo lang('bf_size'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="<?php echo $numColumns; ?>">
                                    <?php echo lang('bf_with_selected'); ?>
                                    <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('<?php e(js_escape(lang('database_backup_delete_confirm'))); ?>')"><?php echo lang('bf_action_delete'); ?></button>
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($backups as $file => $atts) :
                                // If the index.html file is present, don't display it.
                                if ($file == 'index.html') {
                                    continue;
                                }
                            ?>
                            <tr class="hover-toggle">
                                <td class="column-check"><input type="checkbox" value="<?php e($file); ?>" name="checked[]" /></td>
                                <td><a href='<?php echo "{$databaseUrl}/get_backup/{$file}"; ?>'><?php e(sprintf(lang('database_link_title_download'), $file)); ?></a></td>
                                <td><a href='<?php echo "{$databaseUrl}/restore/{$file}"; ?>'><?php e(sprintf(lang('database_link_title_restore'), $file)); ?></a></td>
                                <td><?php echo byte_format($atts['size']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php
                    echo form_close();
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<div class="admin-box backups">
    
</div>