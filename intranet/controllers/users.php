<?php

class Users extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('users/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    public function lista($pag=1,$order='id') 
    {
        $maxpp=35;
        if(Session::get('role')==4) header('location: ' . URL . LANG . '/models/lista/');
        $this->model->pag=$pag;
        $this->view->list=$this->model->usersToTable($this->model->getUsersList($pag,$maxpp,$order),$order);
        $this->view->render('users/list');  
    }
    public function editCreateUser($id=null) 
    {
        if(Session::get('role')==4) header('location: ' . URL . LANG . '/models/lista/');
        $type=(!$id)?'add':'edit';
        $this->view->form=$this->model->usersForm($type,$id);
        $this->view->render('users/editUsers');  
    }
   
    public function create() 
    {
        $id=$this->model->create();
        header('location: ' . URL . LANG . '/users/lista/');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/users/lista/');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/users/lista/');
    }
    public function sort() 
    {
        $this->model->sort();
    }
    
}