<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('assignments') ?>">
                    <?php echo lang('assignments'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('new_assignment') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('edit_assignment') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('assignments'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('assignments') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('assignments'); ?>
            </a>
            <a href="<?php echo site_url('assignments/create') ?>" id="create_new" data-toggle="modal"
                data-target="#myModal">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_assignment'); ?>
            </a>
        </li>
    </ul>
</div>