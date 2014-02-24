<?php

class Log extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('log/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    public function lista($pag=1,$order='updated_at DESC') 
    {
        $maxpp=35;
        if(!Session::get('role')==1 && !Session::get('role')==6) header('location: ' . URL . LANG . '/models/lista/');
        $this->model->pag=$pag;
        $this->view->list=$this->model->logToTable($this->model->getLogList($pag,$maxpp,$order),$order);           
        $this->view->pagination=$this->model->getPagination($pag,$maxpp,'log','log/lista');
        $this->view->render('log/list');  
    }
    public function deleteLog() 
    {
        if(!Session::get('role')==1 && !Session::get('role')==6) header('location: ' . URL . LANG . '/models/lista/');          
        $this->model->deleteLog();
        $this->view->render('log/list');  
    }
   
    
}