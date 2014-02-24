<?php

class Banner extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('banner/js/custom.js');
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function index() { 
        header('location: '.URL.LANG.'/banner/lista');  
    }
    public function view($id) 
    {
        $this->view->group=$this->model->getBannerGroups($id);
        $this->view->Gallery=$this->model->getBannerByGroup($id);
        $this->view->render('banner/view');  
    }
    public function lista($pag=1) 
    {
        $this->view->list=$this->model->toTable($this->model->getBannerGroups());
        $this->view->render('banner/list');  
    }
     function viewGroup($id=null) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->formGroup($id);
        $this->view->render('banner/editbanner');  
    }
    
   public function addGroup() 
    {
       $group=$this->model->addGroup();
       header('location: ' . URL  . 'banner/view/'.$group);
    }
    public function editGroup($group) 
    {
        $this->model->editGroup($group);
        header('location: ' . URL  . 'banner/view/'.$group);
    }
    public function deleteGroup($group) 
    {
        $this->model->deleteGroup($group);
        header('location: '.URL.'banner/lista'); 
    }
    
    public function add($group) 
    {
       $img=new upload;
       $this->model->add($group,$img->getImg());
    }
    public function edit($id,$group) 
    {
        $this->model->edit($id,$group);
        header('location: ' . URL  . 'banner/view/'.$group);
    }
    public function delete($id,$group) 
    {
        $this->model->delete($id);
        header('location: ' . URL  .  'banner/view/'.$group);
    }
    public function deleteAll($group) 
    {
        $this->model->deleteAll($group);
        header('location: ' . URL  .  'banner/lista/');
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
        $this->view->render('banner/viewimage');  
    }
    
}