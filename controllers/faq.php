<?php

class Faq extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('page/js/faq.js');
    }

    function index() {
        $this->view->setBreadcrumb('<a href="/" class="capitalize">'.$this->view->lang['home'].'</a>',true);
        $this->view->faq = $this->model->getFAQ();
        $this->view->setBreadcrumb('<span class="capitalize">FAQ</span>',false);
        $this->view->render('page/faq');
    }

    function contact() {
        
    }

}
