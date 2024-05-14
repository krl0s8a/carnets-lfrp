<?php echo form_open('matchday/actions', array('id' => 'action-form')); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-list"></i>
            Lista de jornadas            
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip"
                        data-placement="left" title="<?= lang('actions') ?>"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li>
                                <a href="<?= site_url('matchday/create'); ?>"><i class="fa fa-plus-circle"></i>
                                    <?= lang('op_create_player'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i>
                                    <?= lang('export_to_excel') ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" class="bpo" title="<?= $this->lang->line('op_delete_player') ?>"
                                    data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>"
                                    data-html="true" data-placement="left"><i class="fa fa-trash-o"></i>
                                    <?= lang('op_delete_player') ?>
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
                        <?php echo lang('info_players'); ?>
                    </p>
                    <div class="table-responsive">
                        <table id="player_table" cellpadding="0" cellspacing="0" border="0"
                        class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="max-width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check" />
                                </th>
                                <th style="text-align: left; width: 5%;">Ref.</th>
                                <th style="text-align: left; width: 30%;">Jornada</th>
                                <th style="width: 8%;">PlayOff?</th>
                                <th style="width: 8%;">Orden</th>
                                <th style="text-align: left; width: 20%;">Torneo</th>
                                <th style="text-align: left; width: 20%;">Categoria</th>
                                <th><?php echo lang('actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="dataTables_empty">
                                    <?= lang('loading_data_from_server') ?>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                            <tr class="active">
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkft" type="checkbox" name="check"/>
                                </th>
                                <th></th><th></th><th></th><th></th><th></th><th></th>                          
                                <th style="width:80px; text-align:center;"><?= lang('actions'); ?></th>
                            </tr>
                        </tfoot>
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