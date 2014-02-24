<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->setBreadcrumb('This page cannot be found!');
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }

}