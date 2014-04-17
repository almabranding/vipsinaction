<?php

class Terms extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('page/js/faq.js');
    }

    function index() {
        $this->view->setBreadcrumb('<a href="/" class="capitalize">'.$this->view->lang['home'].'</a>',true);
        $this->view->terms = $this->model->getTerms();
        $this->view->setBreadcrumb('<span class="capitalize">'.$this->view->lang['TERMS_CONDS'].'</span>',false);
        $this->view->render('page/terms');
    }

    function contact() {
        
    }

}
