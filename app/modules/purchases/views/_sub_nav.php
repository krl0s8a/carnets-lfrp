<div class="col-sm-12 col-md-12">
    <ul class="subnav">
        <li class="title"><?php echo $toolbar_title; ?></li>
        <li class="right_log hidden-xs">
            <a href="<?php echo site_url('purchases') ?>"><?php echo lang('list_purchases'); ?></a>
            <a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('purchases/create') ?>" id="create_new"><?php echo lang('new_purchase'); ?></a>
        </li>
    </ul>
</div>