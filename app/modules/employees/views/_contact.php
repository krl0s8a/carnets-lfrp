<div class="form-group">
    <?php echo lang('address', 'address'); ?>
    <textarea name="address" id="address" rows="2" class="form-control"><?php echo $employee->address; ?></textarea>
</div>
<?php
// Provincia
echo co_form_dropdown(
    array(
        'name'  => 'state_id',
        'class' => 'form-control'
    ),
    $states,
    set_value('state_id', $employee->state_id),
    lang('state')
);
// Localidad
echo co_form_dropdown(
    array(
        'name'  => 'city_id',
        'class' => 'form-control'
    ),
    $cities,
    set_value('city_id', $employee->city_id),
    lang('city')
);
// Telegono movil
echo co_form_telephone(array(
    'name'  => 'movil_phone',
    'id'    => 'movil_phone',
    'class' => 'form-control'
), set_value('movil_phone', $employee->movil_phone), lang('movil_phone'));
// email
echo co_form_email(array(
    'name'  => 'email',
    'id'    => 'email',
    'class' => 'form-control'
), set_value('email', $employee->email), lang('email'));

// Submit
echo form_button(
    array(
        'type'  => 'submit',
        'name'  => 'update_contact',
        'class' => 'btn btn-primary'
    ),
    '<i class="fa fa-save"></i> ' . lang('save')
);
echo anchor(
    site_url('employees'),
    lang('cancel'),
    array('class' => 'btn btn-link')
);
?>