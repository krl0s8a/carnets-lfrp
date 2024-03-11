<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('banks') ?>">
                    <?php echo lang('banks'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_bank') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_bank') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('banks'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('banks') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('banks'); ?>
            </a>
            |
            <a href="<?php echo site_url('banks/create') ?>" id="create_new">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_bank'); ?>
            </a>
        </li>
    </ul>
</div>