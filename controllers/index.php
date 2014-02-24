<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }
    
   function index() {
       $this->view->css = array('page/css/royalslider.css');
       $this->view->js[] = 'page/js/jquery.royalslider.min.js';
       $this->view->js[] = 'page/js/home.js';
       $this->view->auctions=$this->model->getAuctions();
       $this->view->banner=$this->model->getBanner();
       $this->view->render('page/home');
    }
    
}