<?php
$testSegment = $this->uri->segment(2);
$rolesUrl = site_url(SITE_AREA . '/roles');
?>
<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('roles') ?>">
                    <?php echo lang('role_roles'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('role_create') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('role_edit') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('role_roles'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo $rolesUrl; ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('role_roles'); ?>
            </a>
            <?php if (has_permission('Bonfire.Roles.Add')): ?>
                <a href='<?php echo "{$rolesUrl}/create"; ?>' id='create_new'>
                    <i class="fa fa-plus-circle"></i>
                    <?php echo lang('role_new_role'); ?>
                </a>
            <?php endif; ?>
            <a href='<?php echo "{$rolesUrl}/permission_matrix"; ?>'>
                <i class="fa fa-grid"></i>
                <?php echo lang('matrix_header'); ?>
            </a>
        </li>
    </ul>
</div>