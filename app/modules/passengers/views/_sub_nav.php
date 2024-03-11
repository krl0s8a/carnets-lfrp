<?php
$testSegment = $this->uri->segment(2);
$settingsUrl = site_url(SITE_AREA);
?>
<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('passengers') ?>">
                    <?php echo lang('passengers'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_passenger') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_passenger') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('passengers'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('passengers') ?>">
                <i class="fa fa-list"></i>
                <?php echo lang('passengers'); ?>
            </a>
            |
            <a href="<?php echo site_url('passengers/create') ?>" data-toggle="modal" data-target="#myModal"
                id="create_new">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('new_customer'); ?>
            </a>
        </li>
    </ul>
</div>