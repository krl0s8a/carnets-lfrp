<?php

defined('BASEPATH') || exit('No direct script access allowed');

if (!function_exists('complete_digits')) {

    function complete_digits($n, $l) {
        $length = strlen($n);
        if ($length < $l) {
            $r = $n;
            for ($i = 0; $i < ($l - $length); $i++) {
                $n = '0' . $n;
            }
        }
        return $n;
    }

}
/* End /helpers/BF_file_helper.php */