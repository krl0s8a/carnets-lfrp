<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('salaries') ?>">
                    <?php echo lang('salaries'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('create_salary') ?>
                </li>
                <?php
            } else if($this->uri->segment(2) == 'edit') {
                ?>
                <li class="active">
                    <?= lang('edit_salary') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('payments') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('salaries'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('salaries') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('salaries'); ?>
            </a>
            <a href="<?php echo site_url('salaries/create') ?>" >
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_salary'); ?>
            </a>
            <a href="<?php echo site_url('salaries/payments') ?>" >
                <i class="fa fa-usd"></i>
                <?php echo lang('payments'); ?>
            </a>
        </li>
    </ul>
</div>