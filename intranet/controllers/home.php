<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('home/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.LANG.'/home/lista');  
    }
    public function lista() 
    {
        $this->view->list=$this->model->toTable($this->model->getSections());
        $this->view->render('home/list');  
    }
    public function create() 
    {
        $id=$this->model->create();
        header('location: '.URL.LANG.'/home/lista');  
    } 
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: '.URL.LANG.'/home/lista');  
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: '.URL.LANG.'/home/lista');  
    }
    public function view($id=null) 
    {
        $this->view->form=$this->model->homeForm($id);
        $this->view->render('home/edithome'); 
    }
    public function sort() 
    {
        $this->model->sort();
    }
    
}