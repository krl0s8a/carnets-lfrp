<?php
$testSegment = $this->uri->segment(2);
$routesUrl = site_url(SITE_AREA . '/routes');
?>
<div class="col-sm-12 col-md-12">
    <ul class="breadcrumb">
        <li><a href="welcome">Inicio</a></li>
        <?php
        if (!empty($this->uri->segment(2))) {
            ?>
            <li><a href="<?php echo site_url('routes') ?>">
                    <?php echo lang('routes'); ?>
                </a></li>
            <?php
            if ($this->uri->segment(2) == 'create') {
                ?>
                <li class="active">
                    <?= lang('title_new_route') ?>
                </li>
                <?php
            } else {
                ?>
                <li class="active">
                    <?= lang('title_edit_route') ?>
                </li>
                <?php
            }
        } else {
            ?>
            <li class="active">
                <?php echo lang('routes'); ?>
            </li>
            <?php
        }
        ?>
        <li class="right_log hidden-xs">
            <?php if (has_permission('System.Route.Add')): ?>
                <a href='<?php echo "{$routesUrl}/create"; ?>' id='create_new'>
                    <i class="fa fa-plus-circle"></i>
                    <?php echo lang('new_route'); ?>
                </a>
            <?php endif; ?>
        </li>
    </ul>
</div>