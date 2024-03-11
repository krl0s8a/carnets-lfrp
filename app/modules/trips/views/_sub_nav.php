<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('trips') ?>">
                    <?php echo lang('trips'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('new_trip') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('edit_trip') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('trips'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('trips') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('trips'); ?>
            </a>
            <a href="<?php echo site_url('trips/create') ?>" id="create_new">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_trip'); ?>
            </a>
        </li>
    </ul>
</div>