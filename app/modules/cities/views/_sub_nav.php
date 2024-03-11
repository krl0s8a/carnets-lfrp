<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('cities') ?>">
                    <?php echo lang('cities'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_city') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_city') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('cities'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('cities') ?>">
                <?php echo lang('cities'); ?>
            </a>
            |
            <a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('cities/create') ?>"
                id="create_new">
                <?php echo lang('new_city'); ?>
            </a>
        </li>
    </ul>
</div>