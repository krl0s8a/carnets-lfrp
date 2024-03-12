<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('type_player')) {
    function type_player() {
        return array(
            1 => 'Residente',
            2 => 'Residente hijo',
            3 => 'Residente hija',
            4 => 'Residente nieto',
            5 => 'Residente nieta',
            6 => 'Residente esposo',
            7 => 'Residente esposa',
            8 => 'Residente federado',
            9 => 'Residente federada',
            10 => 'Residente vitalicio',
            11 => 'Libre',
            12 => 'Libre federada',
            13 => 'Libre residente'
        );
    }
}

if(!function_exists('edad')){
    function edad($birth){
        $nacimiento = new DateTime($birth);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }
}