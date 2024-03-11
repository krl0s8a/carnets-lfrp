<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('status_bus')) {
    function status_bus() {
        return array(
            'T' => 'Habilitado',
            'F' => 'Deshabilitado'
        );
    }
}