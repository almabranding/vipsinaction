<?php

class Suggestions extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('suggestions/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.LANG.'/models/lista');  
    }
    public function view($id) 
    {
        $this->view->group=$id;
        $this->view->Gallery=$this->model->getSuggestionsByGroup($id);
        $this->view->render('suggestions/view');  
    }
    public function lista($pag=1) 
    {
        $this->view->list=$this->model->toTable($this->model->getSuggestionsGroupsList());
        //$this->view->pagination=$this->model->getPagination($pag,NUMPP,'models','models/lista');
        $this->view->render('suggestions/list');  
    }
     function editGroup($type='add',$id=null) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->formGroup($type,$id);
        $this->view->render('suggestions/editsuggestion');  
    }
    public function addG() 
    {
       $id=$this->model->addG();
       header('location: ' . URL . LANG . '/suggestions/view/'.$id);
    }
    public function editG($id) 
    {
        $this->model->editG($id);
        header('location: ' . URL . LANG . '/suggestions/lista');
    }
    public function add($group) 
    {
        $img=new upload;
       $this->model->add($group,$img->getImg());
    }
    public function edit($id,$group) 
    {
        $this->model->edit($id,$group);
        header('location: ' . URL . LANG . '/suggestions/view/'.$group);
    }
    public function delete($id,$group) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/suggestions/view/'.$group);
    }
    public function deleteAll($group) 
    {
        $this->model->deleteAll($group);
        header('location: ' . URL . LANG .  '/suggestions/lista/');
    }
    public function sort() 
    {
        $this->model->sort();
    }
   public function sortGroups() 
    {
        $this->model->sortGroups();
    }
    
    public function viewImage($id,$group) 
    {
        $this->view->group=$group;
        $this->view->id=$id;
        $this->view->form=$this->model->formImage('edit',$id,$group);
        $this->view->img=$this->model->getImageInfo($id);
        $this->view->render('suggestions/viewimage');  
    }
    public function editImage($id) 
    {
        $model=$this->model->editImage($id);
        header('location: ' . URL .LANG . '/models/editportafolio/'.$model);  
    }
    
}