<?php
// Apellidpo
echo co_form_input(array(
    'name'     => 'last_name',
    'id'       => 'last_name',
    'class'    => 'form-control',
    'required' => 'required'
), set_value('last_name', $employee->last_name), lang('last_name'));
// Nombre
echo co_form_input(array(
    'name'     => 'first_name',
    'id'       => 'first_name',
    'class'    => 'form-control',
    'required' => 'required'
), set_value('first_name', $employee->first_name), lang('first_name'));
// fecha de nacimiento
echo co_form_input(array(
    'name'        => 'birth',
    'id'          => 'birth',
    'class'       => 'form-control date',
    'placeholder' => 'dd/mm/aaaa'
), set_value('birth', formatDate($employee->birth, 'Y-m-d', 'd/m/Y')), lang('birth'));
// Genero
echo co_form_dropdown(
    array(
        'name'  => 'gender',
        'class' => 'form-control'
    ),
    genderSelect(),
    set_value('gender', $employee->gender),
    lang('gender')
);
echo co_form_input(array(
    'name'       => 'dni',
    'id'         => 'dni',
    'class'      => 'form-control',
    'required'   => 'required',
    'max_length' => '8'
), set_value('dni', $employee->dni), lang('dni'));
// CUIL
echo co_form_input(array(
    'name'       => 'cuil',
    'id'         => 'cuil',
    'class'      => 'form-control',
    'required'   => 'required',
    'max_length' => '13'
), set_value('cuil', $employee->cuil), lang('cuil'));
// Submit
echo form_button(
    array(
        'type'  => 'submit',
        'name'  => 'update_personal',
        'class' => 'btn btn-primary'
    ),
    '<i class="fa fa-save"></i> ' . lang('save')
);
if ($employee->id == 0) {
    echo anchor(site_url('employees/createUser'), 'Crear usuario', array('data-toggle' => 'modal', 'class' => 'btn btn-primary', 'data-target' => '#myModal', 'title' => 'Crear un usuario para el personal', 'id' => 'new-user'));
}
echo '&nbsp;';
echo anchor(site_url('employees'), lang('cancel'), array('class' => 'btn btn-link'));
?>