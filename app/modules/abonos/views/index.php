<?php echo form_open('abonos/abonoActions', array('id' => 'action-form')); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= lang('list_abonos'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?= site_url('abonos/createMultiple'); ?>"><i class="fa fa-plus-circle"></i> <?= lang('op_create_abono_multiple'); ?></a></li>
                        <li><a href="<?= site_url('abonos/search'); ?>"><i class="fa fa-search"></i> <?= lang('op_search'); ?></a></li>
                        <li style="display: none;"><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?></a></li> 
                        <li><a href="#" id="print" data-action="print_tickets"><i class="fa fa-print"></i> <?= lang('op_print_abonos'); ?></a></li>   
                        <li><a href="#"><i class="fa fa-file"></i> <?= lang('reports') . ' mensuales' ?></a></li>
                        <li class="divider"></li>      
                        <li><a href="#" class="bpo" title="<b><?= $this->lang->line('op_delete_abonos') ?></b>" data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left"><i class="fa fa-trash-o"></i> <?= lang('op_delete_abonos') ?></a></li>                   
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">Use el icono de la derecha de <b>Listado de Abonos</b> para realizar diferentes acciones.</p>
                <div class="table-responsive">
                    <table id="AbonoTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-condensed table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; max-width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check"/>
                                </th>
                                <th style="width: 5%" class='id'><?php echo lang('lbl_number_abono'); ?></th>
                                <th style="width: 20%; text-align:left"><?php echo lang('lbl_passenger'); ?></th>
                                <th style="width: 10%"><?php echo lang('lbl_period'); ?></th>
                                <th style="width: 10%; text-align: left;"><?php echo lang('lbl_line'); ?></th>
                                <th style="width: 15%; text-align: left;"><?php echo lang('lbl_from'); ?></th>
                                <th style="width: 15%; text-align: left;"><?php echo lang('lbl_to') ?></th>
                                <th style="width: 5%"><?php echo lang('lbl_ida') ?></th>
                                <th style="width: 5%"><?php echo lang('lbl_vta') ?></th>
                                <th style="width: 5%" class='status'><?php echo lang('status'); ?></th>
                                <th style="width: 5%"><?php echo lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="10" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
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