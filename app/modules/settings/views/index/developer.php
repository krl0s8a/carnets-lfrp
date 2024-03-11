<h2 class="card-inside-title"><?php echo lang('set_option_developer'); ?></h2>
<div class="item form-group">
    <?php echo form_label(lang('bf_show_profiler'), 'show_profiler', array('class' => 'col-form-label col-md-3 col-sm-3 label-align')); ?>
    <div class="col-md-1 col-sm-1">
        <?php
        echo form_checkbox(array('name' => 'show_profiler','id' => 'show_profiler'), 1, isset($settings['site.show_profiler']) && $settings['site.show_profiler'] == 1 ? TRUE : FALSE);
        ?>
        <label for="show_profiler" class="filled-in"></label>
    </div>
</div>
<div class="item form-group">
    <?php echo form_label(lang('bf_show_front_profiler'), 'show_front_profiler', array('class' => 'col-form-label col-md-3 col-sm-3 label-align')); ?>
    <div class="col-md-1 col-sm-1">
        <div class="checkbox">
            <label for="show_front_profiler" class="">
                <?php
                echo form_checkbox(array('name' => 'show_front_profiler','id' => 'show_front_profiler','class' => 'flat'), 1, isset($settings['site.show_front_profiler']) && $settings['site.show_front_profiler'] == 1 ? TRUE : FALSE);
                ?>
            </label>
        </div>  
    </div>
</div>