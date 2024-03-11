<?php if (has_permission('Bonfire.Users.Manage')): ?>
    <div class="col-sm-12 col-md-12">
        <ul class="breadcrumb">
            <li><a href="welcome">Inicio</a></li>
            <?php
            if (!empty($this->uri->segment(2))) {
                ?>
                <li><a href="<?php echo site_url('type_tickets') ?>">
                        <?php echo lang('type_tickets'); ?>
                    </a></li>
                <?php
                if ($this->uri->segment(2) == 'create') {
                    ?>
                    <li class="active">
                        <?= lang('title_new_point') ?>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="active">
                        <?= lang('title_edit_point') ?>
                    </li>
                    <?php
                }
            } else {
                ?>
                <li class="active">
                    <?php echo lang('type_tickets'); ?>
                </li>
                <?php
            }
            ?>
            <li class="right_log hidden-xs">
                <a href="<?php echo site_url('tickets') ?>">
                    <i class="fa fa-list"></i>
                    <?php echo lang('type_tickets'); ?>
                </a>
                <a href="<?php echo site_url('tickets/create') ?>" id="create_new" data-toggle="modal"
                    data-target="#myModal">
                    <i class="fa fa-plus-circle"></i>
                    <?php echo lang('new_ticket'); ?>
                </a>
            </li>
        </ul>
    </div>
<?php endif; ?>