<?php

class Accommodation extends Booking_controler_bridge {

    public $section;

    function __construct() {
        parent::__construct(0);
        $this->view->type = 0;
        $this->view->js = array('page/js/custom.js');
        $this->view->css = array('page/css/custom.css', 'page/css/royalslider.css');
        $this->view->setBreadcrumb('<a href="/accommodation">Accommodation</a>');
    }

    function index() {
        header('location: ' . URL . 'accommodation/home');
    }

    

}
