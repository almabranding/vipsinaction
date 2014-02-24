<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('index/js/custom.js');
        $this->view->css = array('index/css/style.css');
    }
    
   function index() {
       $this->view->js[] = 'page/js/home.js';
       $this->view->auctions=$this->model->getAuctions();
       $this->view->banner=$this->model->getBanner();
       $this->view->render('page/home');
    }
    
}