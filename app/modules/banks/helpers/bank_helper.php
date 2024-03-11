<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('types_of_payment')) {
    function types_of_payment() {
        return array(
            1 => 'Efectivo',
            2 => 'Cheque',
            3 => 'Orden de debito',
            4 => 'Tarjeta de crédito',
            5 => 'Transferencia bancaria'
        );
    }
}