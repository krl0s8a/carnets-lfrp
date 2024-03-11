<?php 
$num_columns = 6;
?>
<?php echo form_open('collections/tripsActions', array('id' => 'action-form','class' => 'form-inline')); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-bus"></i><?= lang('list_trips'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">                        
                        <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?></a></li>
                        <li class="divider"></li>                  
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('info_trips'); ?></p>
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <?php echo form_label(lang('field_date')); ?>
                            <input type="text" name="date" value="<?php echo date('d/m/Y'); ?>" class="input-xs date form-control" size="5%">
                            <span class="btn btn-default today">
                                Hoy
                            </span>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php echo form_label(lang('field_drive')); ?>
                            <?php echo form_dropdown('drive_id', $drives, ''); ?>
                        </div>
                    </div>
                    <hr>
                    <table id="CollectionTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>    
                                <th><?php echo lang('field_date'); ?></th>  
                                <th><?php echo lang('field_service') ?></th>            
                                <th><?php echo lang('field_bus') ?></th>
                                <th><?php echo lang('field_drive'); ?></th>
                                <th class='status'><?php echo lang('status'); ?></th>
                                <th><?php echo lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display: none;">
    <input type="hidden" name="form_action" value="" id="form_action"/>
    <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
</div>
<?php echo form_close(); ?>