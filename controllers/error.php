<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->setBreadcrumb($this->view->lang['pagina_no_encontrada']);
    }
    
    function index() {
        $this->view->msg = $this->view->lang['pagina_no_encontrada'];
        $this->view->render('error/index');
    }

}