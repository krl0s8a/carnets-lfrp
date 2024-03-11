<?php
// Posicion
echo co_form_dropdown(
    array(
        'name'  => 'position',
        'class' => 'form-control'
    ),
    positionSelect(),
    set_value('position', $employee->position),
    lang('position')
);
// Legajo
echo co_form_number(array(
    'name'     => 'work_file',
    'id'       => 'work_file',
    'class'    => 'form-control',
    'required' => 'required'
), set_value('work_file', $employee->work_file), lang('work_file'));
// Fecha de inicio contratacion
echo co_form_input(array(
    'name'        => 'dateemployment',
    'id'          => 'dateemployment',
    'class'       => 'form-control date',
    'placeholder' => 'dd/mm/aaaa'
), set_value('dateemployment', formatDate($employee->dateemployment, 'Y-m-d', 'd/m/Y')), lang('dateemployment'));
// Fecha Finalizacion contratación
echo co_form_input(array(
    'name'        => 'dateemploymentend',
    'id'          => 'dateemploymentend',
    'class'       => 'form-control date',
    'placeholder' => 'dd/mm/aaaa'
), set_value('dateemploymentend', formatDate($employee->dateemploymentend, 'Y-m-d', 'd/m/Y')), lang('dateemploymentend'));
// Submit
echo form_button(
    array(
        'type'  => 'submit',
        'name'  => 'update_laboral',
        'class' => 'btn btn-primary'
    ),
    '<i class="fa fa-save"></i> ' . lang('save')
);
echo anchor(site_url('employees'), lang('cancel'), array('class' => 'btn btn-link'));
?>