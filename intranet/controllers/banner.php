<?php

class Banner extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('banner/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.'/banner/lista');  
    }
    public function view($id=null) 
    {
        $this->view->form=$this->model->formBanner($id);
        $this->view->render('banner/view');  
    }
    public function lista($pag=1) 
    {
        $this->view->list=$this->model->toTable($this->model->getBanner());
        $this->view->render('banner/list');  
    }
   
    
    
    public function add() 
    {
       $this->model->add();
        header('location: ' . URL  . 'banner/lista/');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL  . 'banner/lista/');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL  .  'banner/lista/');
    }
    
    public function sort() 
    {
        $this->model->sort();
    }
   
    
}