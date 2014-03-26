<?php

class Donantes extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.'donantes/lista');  
    }
    public function lista($type=1) 
    {
        $this->view->list=$this->model->toTable($this->model->getColaborators($type));
        $this->view->render('donantes/list');  
    }
    public function view($id=null) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->donantesForm($id);
        $this->view->render('donantes/edit'); 
    }
    public function create() 
    {
        $id=$this->model->create();
        header('location: '.URL.'donantes/lista');  
    } 
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: '.URL.'donantes/lista'); 
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: '.URL.'donantes/lista');  
    }
    public function sort() 
    {
        $this->model->sort();
    }
    
   
}