<?php

class Media extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    public function index() 
    {
        header('location: ' . URL  . 'media/lista/');
    }
    public function addPhoto(){
       $upload = new upload('temp/','pic',true,true);
       $this->model->addPhoto($upload->getImg());
    }
    public function editImage($id) 
    {
        $this->model->editImage($id);
        header('location: ' . URL . 'media/lista/');  
    }
    public function view($id=null) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->formImage($id);
        $this->view->img=$this->model->getImageInfo($id);
        $this->view->model_id=$this->view->img['model_id'];
        $this->view->render('media/viewimage');  
    }
    public function lista($pag=1,$order='img_date DESC') 
    {
        $this->model->pag=$pag;
        $this->view->list=$this->model->toTable($this->model->getGalleryList($pag,NUMPP,$order),$order);
        $this->view->pagination=$this->model->getPaginationCond($pag,NUMPP, DB_PREFIX.'gallery_photos',$this->model->wherepag,'media/lista',$order);
        $this->view->render('media/list');  
    }
   
    public function create() 
    {
        $id=$this->model->create();
        header('location: ' . URL  . 'media/lista/');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . 'media/lista/');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/media/lista/');
    }
    public function sort() 
    {
        $this->model->sort();
    }
    public function searchResult() 
    {
        $this->view->search=$this->model->searchForm();
        $this->view->list=$this->model->contactsToTable($this->model->getResultSearch());
        $this->view->render('media/list');  
    }
    
}