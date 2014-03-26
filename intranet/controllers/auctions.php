<?php

class Auctions extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('auctions/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.'/auctions/lista');  
    }
    public function view($id=null) 
    {
        $this->view->form=$this->model->formAuction($id);
        $this->view->render('auctions/view');  
    }
    public function lista($pag=1) 
    {
        $this->view->list=$this->model->toTable($this->model->getAuctions());
        //$this->view->pagination=$this->model->getPagination($pag,NUMPP,'models','models/lista');
        $this->view->render('auctions/list');  
    }
     
    public function add() 
    {
       $this->model->add();
        header('location: ' . URL . LANG . '/auctions/lista/');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/auctions/lista/');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/auctions/lista/');
    }
    
    public function sort() 
    {
        $this->model->sort();
    }
   
    
}