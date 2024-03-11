<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('genderSelect')) {
    function genderSelect() {
        return array(
            'Hombre' => 'Hombre',
            'Mujer'  => 'Mujer',
            'Otro'   => 'Otro'
        );
    }
}

if (!function_exists('positionSelect')) {
    function positionSelect() {
        return array(
            ''               => '--ninguno--',
            'Administracion' => 'Administración',
            'Boleteria'      => 'Boleteria',
            'Chofer'         => 'Chofer',
            'Inspector'      => 'Inspector',
            'Socio'          => 'Socio',
            'Taller'         => 'Taller'
        );
    }
}

if (!function_exists('generatePassword')) {
    function generatePassword($length) {
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHYJKLMNOPQRSTUVWXYZ";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $length; $i++) {
            $key .= substr($pattern, mt_rand(0, $max), 1);
        }
        return $key;
    }
}