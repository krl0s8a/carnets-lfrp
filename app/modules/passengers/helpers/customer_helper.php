<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('typesCustomer')) {
    function types_of_passenger() {
        return array(
            2 => 'Alumno',
            1 => 'Docente',
            4 => 'Institucion',
            3 => 'Particular'
        );
    }
}

if (!function_exists('levelsCustomer')) {
    function levelsCustomer() {
        return array(
            '' => '---',
            'I' => 'Inicial',
            'P' => 'Primario',
            'S' => 'Secundario',
            'T' => 'Terciario',
            'U' => 'Universitario'
        );
    }
}