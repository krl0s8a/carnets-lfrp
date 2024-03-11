<!--Allow register--->
<div class="col-md-4">
    <div class="item form-group">
        <?php echo form_label(lang('allow_print_number_ticket'), 'allow_print_number_ticket'); ?>
        <?php
        echo form_checkbox(array('name' => 'allow_print_number_ticket', 'id' => 'allow_print_number_ticket'), 1, isset($settings['allow_print_number_ticket']) && $settings['allow_print_number_ticket'] == 1);
        ?>
    </div>
</div>