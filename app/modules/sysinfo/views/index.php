<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-list"></i>
            <?= lang('sysinfo_system'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0"
                        class="table table-bordered table-condensed table-hover table-striped">
                        <tbody>
                            <?php foreach ($info as $key => $val): ?>
                                <tr>
                                    <th>
                                        <?php e(lang($key)); ?>
                                    </th>
                                    <td>
                                        <?php e($val); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>