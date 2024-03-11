<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('scrolls') ?>">
                    <?php echo lang('scrolls'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_scroll') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_scroll') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('scrolls'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('scrolls') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('list_scrolls'); ?>
            </a>
            <a href="<?php echo site_url('scrolls/load') ?>" id="create_new">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_scroll'); ?>
            </a>
        </li>
    </ul>
</div>