<?php
$hasPermissionDeleteDate = isset($hasPermissionDeleteDate) ? $hasPermissionDeleteDate : false;
$hasPermissionDeleteModule = isset($hasPermissionDeleteModule) ? $hasPermissionDeleteModule : false;
$hasPermissionDeleteUser = isset($hasPermissionDeleteUser) ? $hasPermissionDeleteUser : false;
?>
<div class="box">
    <div class="box-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open("activities/{$vars['which']}", array('class' => 'form-inline')); ?>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">
                        <?php echo lang('activities_filter_head'); ?>
                    </legend>
                    <div class="form-group">
                        <?php
                        echo form_dropdown(
                            array(
                                'name' => "{$vars['which']}_select",
                                'id' => "{$vars['which']}_select",
                                'class' => 'form-control',
                            ),
                            $select_options,
                            $filter,
                            lang('activities_filter_head'),
                        );
                        ?>
                    </div>
                    <?php
                    echo form_submit('filter', lang('activities_filter'), 'class="btn btn-primary"');
                    if ($vars['which'] == 'activity_own' && $hasPermissionDeleteOwn):
                        ?>
                        <button type="submit" name="delete" class="btn btn-danger" id="delete-activity_own"><span
                                class="icon-trash icon-white"></span>&nbsp;
                            <?php echo lang('activities_own_delete'); ?>
                        </button>
                    <?php elseif ($vars['which'] == 'activity_user' && $hasPermissionDeleteUser): ?>
                        <button type="submit" name="delete" class="btn btn-danger" id="delete-activity_user"><span
                                class="icon-trash icon-white"></span>&nbsp;
                            <?php echo lang('activities_user_delete'); ?>
                        </button>
                    <?php elseif ($vars['which'] == 'activity_module' && $hasPermissionDeleteModule): ?>
                        <button type="submit" name="delete" class="btn btn-danger" id="delete-activity_module"><span
                                class="icon-trash icon-white"></span>&nbsp;
                            <?php echo lang('activities_module_delete'); ?>
                        </button>
                    <?php elseif ($vars['which'] == 'activity_date' && $hasPermissionDeleteDate): ?>
                        <button type="submit" name="delete" class="btn btn-danger" id="delete-activity_date"><span
                                class="icon-trash icon-white"></span>&nbsp;
                            <?php echo lang('activities_date_delete'); ?>
                        </button>
                    <?php endif; ?>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>
                    <?php
                    echo sprintf(
                        lang('activities_view'),
                        $vars['view_which'] == ucwords(lang('activities_date')) ? sprintf(lang('activities_view_before'), $vars['view_which']) : $vars['view_which'],
                        $vars['name']
                    );
                    ?>
                </h2>
                <?php if (empty($activity_content)): ?>
                    <div class="alert alert-error fade in">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <h4 class="alert-heading">
                            <?php echo lang('activities_not_found'); ?>
                        </h4>
                    </div>
                <?php else: ?>
                    <div id="user_activities">
                        <table class="table table-condensed table-striped table-bordered" id="flex_table">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo lang('activities_user'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('activities_activity'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('activities_module'); ?>
                                    </th>
                                    <th>
                                        <?php echo lang('activities_when'); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($activity_content as $activity): ?>
                                    <tr>
                                        <td><span class="icon-user"></span>&nbsp;
                                            <?php e($activity->username); ?>
                                        </td>
                                        <td>
                                            <?php echo $activity->activity; ?>
                                        </td>
                                        <td>
                                            <?php echo $activity->module; ?>
                                        </td>
                                        <td>
                                            <?php echo user_time(strtotime($activity->created), null, 'M j, Y g:i A'); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    echo $this->pagination->create_links();
                endif; ?>
            </div>
        </div>
    </div>
</div>