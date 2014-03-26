<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        if(Session::get('loggedIn')) header('location: '.URL.'pages');
    }
    
    function index() {
        $this->view->render('login/index',true);
    }
    
    function details() {
        $this->view->render('index/index');
    }
    
}