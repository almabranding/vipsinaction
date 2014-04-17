<?php

class Faq extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.'/faq/lista');  
    }
    public function view($id=null) 
    {
        $this->view->form=$this->model->formFaq($id);
        $this->view->render('faq/view');  
    }
    public function lista($pag=1) 
    {
        $this->view->list=$this->model->toTable($this->model->getFaq());
        $this->view->render('faq/list');  
    }
    public function add() 
    {
       $this->model->add();
        header('location: ' . URL  . 'faq/lista/');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL  . 'faq/lista/');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL  .  'faq/lista/');
    }
    public function sort() 
    {
        $this->model->sort();
    }
   
    
}