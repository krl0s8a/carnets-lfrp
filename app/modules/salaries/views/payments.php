<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-usd"></i>
            <?= lang('payments_salary'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="PaymentsTable" cellpadding="0" cellspacing="0" border="0"
                        class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; max-width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check" />
                                </th>
                                <th style="width: 3%; text-align:left;">
                                    <?php echo lang('bf_id') ?>
                                </th>
                                <th style="width: 10%; text-align:left;">
                                    <?php echo lang('lbl_salary') ?>
                                </th>
                                <th style="width: 15%; text-align:left;">
                                    <?php echo lang('lbl_employee'); ?>
                                </th>
                                <th style="width: 10%; text-align:left;">
                                    <?php echo lang('lbl_position'); ?>
                                </th>
                                <th style="width: 10%">
                                    <?php echo lang('lbl_date_start_period'); ?>
                                </th>
                                <th style="width: 10%">
                                    <?php echo lang('lbl_date_end_period'); ?>
                                </th>
                                <th style="width: 10%">
                                    <?php echo lang('lbl_type_payment'); ?>
                                </th>                                
                                <th style="width: 10%; text-align:left;">
                                    <?php echo lang('lbl_bank_account'); ?>
                                </th>
                                <th style="width: 7%; text-align:left;">
                                    <?php echo lang('lbl_date_payment'); ?>
                                </th>
                                <th style="width: 7%">
                                    <?php echo lang('lbl_amount'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="11" class="dataTables_empty">
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
<script type="text/javascript">
    var types_of_payment = <?php echo json_encode(types_of_payment()); ?>;
</script>