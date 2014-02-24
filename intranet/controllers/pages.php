<?php

class Pages extends Controller {

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
        $this->view->list=$this->model->toTable($this->model->getPagesList());
        $this->view->render('pages/list');  
    }
    public function create() 
    {
        $id=$this->model->create();
        header('location: '.URL.'pages/lista');  
    } 
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: '.URL.'pages/lista'); 
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: '.URL.'pages/lista');  
    }
    public function view($id=null) 
    {
        $type=(!$id)?'add':'edit';
        $this->view->form=$this->model->homeForm($type,$id);
        $this->view->render('pages/edithome'); 
    }
    public function sort() 
    {
        $this->model->sort();
    }
    
}