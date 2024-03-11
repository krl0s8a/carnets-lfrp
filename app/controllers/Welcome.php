<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author carlos
 */
class Welcome extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        Template::set('toolbar_title', 'Inicio');
        Template::set_view('welcome/index');
        Template::render();
    }

}
