<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('societe') ?>">
                    <?php echo lang('societe'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_societe') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_societe') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('societe'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('societe') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('societe'); ?>
            </a>
            <a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('societe/create') ?>"
                id="create_new">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_societe'); ?>
            </a>
        </li>
    </ul>
</div>