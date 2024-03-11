<!--Name system-->
<div class="col-md-3">
    <div class="form-group">
        <?php echo form_label(lang('bf_site_name'), 'title'); ?>
        <?php
        echo form_input(array(
            'id'    => 'title',
            'name'  => 'title',
            'value' => set_value('site.title', isset($settings['site.title']) ? $settings['site.title'] : ''),
            'class' => 'form-control'
        ));
        ?>
    </div>
</div>
<!--Email system-->
<div class="col-md-3">
    <div class="form-group">
        <?php echo form_label(lang('bf_site_email'), 'system_email'); ?>
        <?php
        echo form_input(array(
            'id'    => 'system_email',
            'name'  => 'system_email',
            'value' => set_value('site.system_email', isset($settings['site.system_email']) ? $settings['site.system_email'] : ''),
            'class' => 'form-control'
        ));
        ?>
    </div>
</div>
<!--items for page-->
<div class="col-md-2">
    <div class="form-group">
        <?php echo form_label(lang('bf_top_number'), 'list_limit'); ?>
        <?php
        $options = array(
            '10'  => '10',
            '15'  => '15',
            '25'  => '25',
            '50'  => '50',
            '100' => '100'
        );
        echo form_dropdown('list_limit', $options, set_value('site.list_limit', isset($settings['site.list_limit']) ? $settings['site.list_limit'] : ''), array('class' => 'form-control', 'id' => 'list_limit'));
        ?>
        <small>
            <?php echo (form_error('list_limit') ? form_error('list_limit') . '<br />' : '') . lang('bf_top_number_help'); ?>
        </small>
    </div>
</div>
<!--Language--->
<div class="col-md-3" style="display: none;">
    <div class="item form-group">
        <?php echo form_label(lang('bf_language'), 'languages'); ?>
        <select name="languages[]" id="languages" multiple="multiple" class="form-control">
            <?php
            if (!empty($languages) && is_array($languages)):
                foreach ($languages as $language):
                    $selected = in_array($language, $selected_languages);
                    ?>
                    <option value="<?php e($language); ?>" <?php echo set_select('languages', $language, $selected); ?>>
                        <?php e(ucfirst($language)); ?>
                    </option>
                <?php
                endforeach;
            endif;
            ?>
        </select>
        <small>
            <?php echo (form_error('languages') ? form_error('languages') . '<br />' : '') . lang('bf_language_help'); ?>
        </small>
    </div>
</div>