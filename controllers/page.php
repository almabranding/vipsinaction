<?php

class Page extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('page/js/custom.js');
        $this->view->css = array('page/css/custom.css');
    }
    
    
    function view($page) {
       $this->view->setBreadcrumb(ucfirst($page),true);
       $this->view->contactForm=$this->model->contactForm();
       $this->view->article=$this->model->getArticle($page);
       $this->view->render('page/article');
    }
    function sendcontact() {
       var_dump($_POST);
    }
    
}