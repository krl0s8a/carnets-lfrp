<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('tariffs') ?>">
                    <?php echo lang('tariffs'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_tariff') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_tariff') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('tariffs'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('tariffs') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('tariffs'); ?>
            </a>
            <a href="<?php echo site_url('tariffs/create') ?>" id="create_new">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_tariff'); ?>
            </a>
        </li>
    </ul>
</div>