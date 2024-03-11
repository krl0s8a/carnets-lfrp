<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('genderSelect')) {

    function genderSelect() {
        return array(
            'Hombre' => 'Hombre',
            'Mujer' => 'Mujer',
            'Otro' => 'Otro'
        );
    }

}

if (!function_exists('positionSelect')) {

    function positionSelect() {
        return array(
            'Administracion' => 'Administración',
            'Boleteria' => 'Boleteria',
            'Chofer' => 'Chofer',
            'Inspector' => 'Inspector',
            'Socio' => 'Socio',
            'Taller' => 'Taller'
        );
    }

}
