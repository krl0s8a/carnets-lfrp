<?php if (has_permission('Bonfire.Users.Manage')): ?>
    <div class="col-sm-12 col-md-12">
        <ul class="breadcrumb">
            <li><a href="welcome">Inicio</a></li>
            <?php
            if (!empty($this->uri->segment(2))) {
                ?>
                <li><a href="<?php echo site_url('abonos') ?>">
                        <?php echo lang('abonos'); ?>
                    </a></li>
                <?php
                if ($this->uri->segment(2) == 'create') {
                    ?>
                    <li class="active">
                        <?= lang('title_new_abono') ?>
                    </li>
                    <?php
                } else if($this->uri->segment(2) == 'edit') {
                    ?>
                    <li class="active">
                        <?= lang('title_edit_abono') ?>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="active">
                        <?= lang('title_new_abono_multiple') ?>
                    </li>
                    <?php
                }
            } else {
                ?>
                <li class="active">
                    <?php echo lang('abonos'); ?>
                </li>
                <?php
            }
            ?>
            <li class="right_log hidden-xs">
                <a href="<?php echo site_url('abonos') ?>">
                    <i class="fa fa-list"></i>
                    <?php echo lang('abonos'); ?>
                </a>
                <a href="<?php echo site_url('abonos/create') ?>" id="create_new">
                    <i class="fa fa-plus-circle"></i>
                    <?php echo lang('new_abono'); ?>
                </a>
                <a href="<?php echo site_url('abonos/createMultiple') ?>" id="create_new">
                    <i class="fa fa-th-list"></i>
                    <?php echo lang('new_abono_lote'); ?>
                </a>
            </li>
        </ul>
    </div>
<?php endif; ?>