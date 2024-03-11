<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-list"></i>
            <?= lang('sysinfo_installed_mods'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0"
                        class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <?php echo lang('sysinfo_mod_name'); ?>
                                </th>
                                <th>
                                    <?php echo lang('sysinfo_mod_ver'); ?>
                                </th>
                                <th>
                                    <?php echo lang('sysinfo_mod_desc'); ?>
                                </th>
                                <th>
                                    <?php echo lang('sysinfo_mod_author'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modules as $module => $config): ?>
                                <tr>
                                    <td>
                                        <?php echo $config['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $config['version']; ?>
                                    </td>
                                    <td>
                                        <?php echo $config['description']; ?>
                                    </td>
                                    <td>
                                        <?php echo $config['author']; ?>
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