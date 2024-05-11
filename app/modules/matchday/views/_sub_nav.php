<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('players') ?>">
                    <?php echo lang('players'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('co_new').' '.lang('player') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('co_edit').' '.lang('player') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('players'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('players') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('co_list'); ?>
            </a>
            <a href="<?php echo site_url('players/create') ?>" id="create_new">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('co_new'); ?>
            </a>
        </li>
    </ul>
</div>