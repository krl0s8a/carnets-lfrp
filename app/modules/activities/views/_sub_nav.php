<?php

$checkSegment = $this->uri->segment(4);
$activitiesReportsUrl = site_url('activities');
$pageUser   = 'activity_user';
$pageModule = 'activity_module';
$pageDate   = 'activity_date';
?>
<div class="col-sm-12 col-md-12">
    <ul class="subnav">
        <li class="title"><?php echo $toolbar_title; ?></li>
        <li class="right_log hidden-xs">
        	<?php echo anchor($activitiesReportsUrl, lang('activities_home')); ?>
        	<?php if ($hasPermissionViewUser || $hasPermissionViewOwn) : ?>
        		<?php echo anchor("{$activitiesReportsUrl}/{$pageUser}", lang(str_replace('activity_', 'activities_', $pageUser))); ?>
        	<?php
		    endif;
		    if ($hasPermissionViewModule) :
		    ?>
		    	<?php echo anchor("{$activitiesReportsUrl}/{$pageModule}", lang(str_replace('activity_', 'activities_', $pageModule))); ?>
		    <?php
		    endif;
		    if ($hasPermissionViewDate) :
		    ?>
		    	<?php echo anchor("{$activitiesReportsUrl}/{$pageDate}", lang(str_replace('activity_', 'activities_', $pageDate))); ?>
		    <?php endif; ?>	
        </li>
    </ul>
</div>