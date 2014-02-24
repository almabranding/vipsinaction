<?php

class Temp extends Controller {

    function __construct() {
        parent::__construct();
    }
    
   function index() {
        $this->view->render('pages/splash');
    }
    
}