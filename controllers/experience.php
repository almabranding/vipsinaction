<?php

class Experience extends Booking_controler_bridge {

    public $section;

    function __construct() {
        parent::__construct(1);
        $this->view->type = 1;
        $this->view->js = array('page/js/custom.js');
        $this->view->css = array('page/css/custom.css', 'page/css/royalslider.css');
        $this->view->setBreadcrumb('<a href="/experience">Experience</a>');
    }

    function index() {
        header('location: ' . URL . 'experience/home');
    }
}
