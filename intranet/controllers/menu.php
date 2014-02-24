<?php

class Menu extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('menu/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        $this->view->list = $this->model->toTable($this->model->getMenuList());
        $this->view->render('menu/index');  
    }
    public function create() 
    {
        $id=$this->model->create();
        header('location: '.URL.'menu');  
    } 
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: '.URL.'menu'); 
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: '.URL.'menu');  
    }
    public function view($id=null) 
    {
        $type=(!$id)?'add':'edit';
        $this->view->form=$this->model->form($type,$id);
        $this->view->render('menu/edit'); 
    }
    public function sort() 
    {
        $this->model->sort();
    }
}