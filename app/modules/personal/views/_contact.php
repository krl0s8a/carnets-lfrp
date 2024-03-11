<div class="form-group">
    <?php echo lang('address', 'address'); ?>
    <textarea name="address" id="address" rows="2" class="form-control"><?php echo $personal->address; ?></textarea>
</div>
<?php
// Provincia
echo co_form_dropdown(
    array(
        'name'  => 'state_id',
        'class' => 'form-control'
    ),
    $states,
    set_value('state_id', $personal->state_id),
    lang('state')
);
// Localidad
echo co_form_dropdown(
    array(
        'name'  => 'city_id',
        'class' => 'form-control'
    ),
    $cities,
    set_value('city_id', $personal->city_id),
    lang('city')
);
// Telegono movil
echo co_form_telephone(array(
    'name'  => 'movil_phone',
    'id'    => 'movil_phone',
    'class' => 'form-control'
), set_value('movil_phone', $personal->movil_phone), lang('movil_phone'));
// email
echo co_form_telephone(array(
    'name'  => 'email',
    'id'    => 'email',
    'class' => 'form-control'
), set_value('email', $personal->email), lang('email'));

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
    site_url('personal'),
    lang('cancel'),
    array('class' => 'btn btn-link')
);
?>