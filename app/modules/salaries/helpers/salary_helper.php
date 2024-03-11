<?php
defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('status_payment')) {
    function status_payment() {
        return array(
            0 => 'Pendiente de pago',
            1 => 'Pagado',
            2 => 'Pagado parcialmente'
        );
    }
}