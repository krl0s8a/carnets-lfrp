<?php
$num_columns = 9;
?>
<?php echo form_open('trips/tripsActions', array('id' => 'action-form')); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-bus"></i><?= lang('list_trips'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?= site_url('trips/create'); ?>"><i class="fa fa-plus-circle"></i> <?= lang('op_create_trip'); ?></a></li>
                        <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?></a></li>
                        <li class="divider"></li>     
                        <li><a href="#" class="bpo" title="<?= $this->lang->line('op_delete_trip') ?>" data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left"><i class="fa fa-trash-o"></i> <?= lang('op_delete_trip') ?></a></li>                   
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
                    <table id="TripTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>  
                                <th style="min-width:30px; width: 30px; text-align: center;"><input class="checkbox checkth" type="checkbox" name="check"/>
                                </th>   
                                <th style="width: 5%"><?php echo lang('bf_id'); ?></th> 
                                <th style="width: 10%"><?php echo lang('field_date'); ?></th> 
                                <th style="width: 8%"><?php echo lang('lbl_bus') ?></th>
                                <th style="width: 20%; text-align:left"><?php echo lang('lbl_drive'); ?></th>
                                <th style="width: 10%; text-align: left;"><?php echo lang('field_line'); ?></th>    
                                <th style="width: 13%; text-align:left;"><?php echo lang('field_route') ?></th> 
                                <th style="width: 10%; text-align:left"><?php echo lang('field_service') ?></th> 
                                <th style="width: 7%"><?php echo lang('field_departure'); ?></th>
                                <th style="width: 7%"><?php echo lang('field_arrival'); ?></th>                                
                                <th style="width: 7%" class='status'><?php echo lang('status'); ?></th>
                                <th><?php echo lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="12" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                            </tr>
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