<?php
$roleCount = array();
foreach ($role_counts as $r) {
    $roleCount[$r->role_name] = $r->count;
}
?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-list"></i><?= lang('role_list'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-md-12">
                <p class="introtext"><?php echo lang('role_intro'); ?></p>
                <div class="table-responsive">
                    <?php if (isset($role_counts) && is_array($role_counts) && count($role_counts)) : ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class='type'><?php echo lang('role_account_type'); ?></th>
                                    <th class="text-center users"># <?php echo lang('bf_users'); ?></th>
                                    <th><?php echo lang('role_description'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $role) : ?>
                                    <tr>
                                        <td><?php echo anchor(SITE_AREA . "roles/edit/{$role->role_id}", $role->role_name); ?></td>
                                        <td class='text-center'><?php echo isset($roleCount[$role->role_name]) ? $roleCount[$role->role_name] : 0; ?></td>
                                        <td><?php echo html_entity_decode($role->description); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p><?php echo lang('role_no_roles'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>