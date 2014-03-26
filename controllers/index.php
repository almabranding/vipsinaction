<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }
    
   function index() {
       $this->view->css = array('index/css/royalslider.css');
       $this->view->js = array('index/js/jquery.royalslider.min.js','index/js/masonry.pkgd.min.js','index/js/home.js');
       $this->view->auctions=$this->model->getAuctions();
       $this->view->banner=$this->model->getBanner();
       $this->view->render('index/home');
    }
    
}