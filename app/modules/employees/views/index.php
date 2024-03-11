<?php echo form_open('employees/actions', array('id' => 'action-form')); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i>
            <?= lang('title_list_employees'); ?>
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip"
                            data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= site_url('employees/create'); ?>"><i class="fa fa-plus-circle"></i>
                                <?= lang('add_employee'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i>
                                <?= lang('export_to_excel') ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_employee') ?></b>"
                                data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>"
                                data-html="true" data-placement="left"><i class="fa fa-trash-o"></i>
                                <?= lang('delete_employee') ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?= lang('list_results'); ?>
                </p>
                <div class="table-responsive">
                    <table id="table_personal" cellpadding="0" cellspacing="0" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check" />
                                </th>
                                <th style="width: 12%; text-align: left;">
                                    <?php echo lang('last_name'); ?>
                                </th>
                                <th style="width: 20%; text-align:left;">
                                    <?php echo lang('first_name'); ?>
                                </th>
                                <th style="width: 10%">
                                    <?php echo lang('cuil'); ?>
                                </th>
                                <th style="width: 7%">
                                    <?php echo lang('work_file'); ?>
                                </th>
                                <th style="width: 12%; text-align:left;">
                                    <?php echo lang('position'); ?>
                                </th>
                                <th style="width: 15%">
                                    <?php echo lang('dateemployment'); ?>
                                </th>
                                <th style="width: 15%; text-align:left;">
                                    <?php echo lang('movil_phone'); ?>
                                </th>
                                <th style="width: 7%">
                                    <?php echo lang('actions'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9" class="dataTables_empty">
                                    <?= lang('loading_data_from_server') ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display: none;">
    <input type="hidden" name="form_action" value="" id="form_action" />
    <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
</div>
<?php echo form_close(); ?>