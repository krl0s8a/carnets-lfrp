<?php echo form_open('cards/actions', array('id' => 'action-form')); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            Confeccion de carnets
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip"
                            data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= site_url('cards/create'); ?>">
                                <i class="fa fa-plus-circle"></i> <?= lang('op_create_card'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="print" data-action="print_cards"><i class="fa fa-print"></i>
                                <?= lang('op_print_cards') ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo" title="<?= $this->lang->line('op_delete_cards') ?>"
                                data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>"
                                data-html="true" data-placement="left"><i class="fa fa-trash-o"></i>
                                <?= lang('op_delete_cards') ?>
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
                <div class="table-responsive">
                    <table id="cards_table" cellpadding="0" cellspacing="0" border="0"
                        class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check" />
                                </th>
                                <th style="width: 23%; text-align: left;">
                                    <?php echo lang('lbl_player'); ?>
                                </th>
                                <th style="width: 23%; text-align: left;">
                                    <?php echo lang('lbl_team'); ?>
                                </th>
                                <th style="width: 23%; text-align: left;">
                                    <?php echo lang('lbl_season'); ?>
                                </th>
                                <th style="width: 10%; text-align: left;">
                                    <?php echo lang('lbl_number'); ?>
                                </th>
                                <th style="width: 16%; text-align: left;">
                                    <?php echo lang('lbl_type_player'); ?>
                                </th>
                                <th>
                                    <?php echo lang('actions'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="dataTables_empty">
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
<script type="text/javascript">
    var arr_type_player = <?php echo json_encode(type_player()); ?>      
</script>