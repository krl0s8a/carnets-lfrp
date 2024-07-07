<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('status_card')) {
    function status_card() {
        return array(
            'Nuevo' => 'Nuevo',
            'Impreso pendiente' => 'Impreso pendiente',
            'Impreso a entregar' => 'Impreso a entregar',
            'Entregado' => 'Entregado'
        );
    }
}