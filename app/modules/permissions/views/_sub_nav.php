<?php
$testSegment = $this->uri->segment(2);
$permissionsUrl = site_url('permissions');
$rolesUrl = site_url('roles');
?>
<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('permissions') ?>">
                    <?php echo lang('permissions'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_permission') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_permission') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('permissions'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo $permissionsUrl; ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('permissions'); ?>
            </a>
            <a href="<?= site_url('permissions/create'); ?>" id="create_new" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus-circle"></i>
                <?= lang('perm_new_permission'); ?>
            </a>
            <a href='<?php echo "{$rolesUrl}/permission_matrix"; ?>'>
                <?php echo lang('perm_matrix'); ?>
            </a>
        </li>
    </ul>
</div>