<?php

class Contacts extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('contacts/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    public function view($id) 
    {
        $this->view->id=$id;
        $this->view->modelsPackage=$this->model->modelsPackage($id);
        $this->view->render('contacts/view');  
    }
    public function lista($pag=1,$order='updated_at DESC') 
    {
        $this->model->pag=$pag;
        $this->view->list=$this->model->contactsToTable($this->model->getContactsList($pag,NUMPP,$order),$order);
        $this->view->pagination=$this->model->getPaginationCond($pag,NUMPP,'contacts',$this->model->wherepag,'contacts/lista',$order);
        $this->view->search=$this->model->searchForm();
        $this->view->render('contacts/list');  
    }
    public function editCreateContact($id=null) 
    {
        $type=(!$id)?'add':'edit';
        $this->view->form=$this->model->contactForm($type,$id);
        $this->view->render('contacts/editContacts');  
    }
   
    public function create() 
    {
        $id=$this->model->create();
        header('location: ' . URL . LANG . '/contacts/lista/');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/contacts/lista/');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/contacts/lista/');
    }
    public function sort() 
    {
        $this->model->sort();
    }
    public function searchResult() 
    {
        $this->view->search=$this->model->searchForm();
        $this->view->list=$this->model->contactsToTable($this->model->getResultSearch());
        $this->view->render('contacts/list');  
    }
    
}