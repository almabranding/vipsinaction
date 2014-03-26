<?php

class Reviews extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('home/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.'reviews/lista');  
    }
    public function lista() 
    {
        $this->view->list=$this->model->toTable($this->model->getReviews());
        $this->view->render('reviews/list');  
    }
    public function view($id=null) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->reviewsForm($id);
        $this->view->render('reviews/edit'); 
    }
    public function create() 
    {
        $id=$this->model->create();
        header('location: '.URL.'reviews/lista');  
    } 
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: '.URL.'reviews/lista'); 
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: '.URL.'reviews/lista');  
    }
    public function sort() 
    {
        $this->model->sort();
    }
    
   
}