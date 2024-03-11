<?php if (has_permission('Bonfire.Users.Manage')): ?>
    <div class="col-sm-12 col-md-12">
        <ul class="breadcrumb">
            <li><a href="welcome">Inicio</a></li>
            <?php
            if (!empty($this->uri->segment(2))) {
                ?>
                <li><a href="<?php echo site_url('users') ?>">
                        <?php echo lang('users'); ?>
                    </a></li>
                <?php
                if ($this->uri->segment(2) == 'create') {
                    ?>
                    <li class="active">
                        <?= lang('title_new_user') ?>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="active">
                        <?= lang('title_edit_user') ?>
                    </li>
                    <?php
                }
            } else {
                ?>
                <li class="active">
                    <?php echo lang('users'); ?>
                </li>
                <?php
            }
            ?>
            <li class="right_log hidden-xs">
                <?php if (has_permission('Core.User.Add')): ?>
                    <a href="<?php echo site_url('users/create') ?>" id="create_new">
                        <i class="fa fa-plus-circle"></i>
                        <?php echo lang('bf_new') . ' ' . lang('bf_user'); ?>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
<?php endif; ?>