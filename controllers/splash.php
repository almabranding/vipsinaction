<?php

class Splash extends Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->render('page/splash');
    }
    
    
}