<?php

class Test extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('packages/js/custom.js');
    }
    public function view($id) 
    {
        $this->view->id=$id;
        $this->view->package=$this->model->getPackage($id);
        $this->view->package=$this->view->package[0];
        $this->view->modelsPackage=$this->model->modelsPackage($id);
        $this->view->render('packages/view');  
    }
    public function lista($pag=1,$order='updated_at DESC') 
    {
        $this->view->js = array('packages/js/zebra_form.js','packages/js/custom.js');
        $this->model->pag=$pag;
        $this->view->searchModel=$this->model->searchForm();
        $this->view->list=$this->model->packageToTable($this->model->getPackagesList($pag,NUMPP,$order),$order);
        $this->view->pagination=$this->model->getPaginationCond($pag,NUMPP,'packages',$this->model->wherepag,'packages/lista',$order);
        $this->view->render('packages/list');  
    }
    public function searchResult() 
    {
        $this->view->searchModel=$this->model->searchForm();
        $this->view->list=$this->model->packageToTable($this->model->getResultSearch());
        $this->view->render('packages/list');  
    }
    public function archived($pag=1,$order='name') 
    {
        $this->model->pag=$pag;
        $this->view->list=$this->model->packageToTable($this->model->getPackagesArchived($pag,NUMPP,$order));
        $this->view->pagination=$this->model->getPaginationCond($pag,NUMPP,'packages','WHERE archived=1','packages/archived',$order);
        $this->view->render('packages/list');  
    }public function selected($pag=1,$order='name') 
    {
        $this->model->pag=$pag;
        $this->view->list=$this->model->packageToTable($this->model->getPackagesSelected($pag,NUMPP,$order));
        $this->view->pagination=$this->model->getPaginationCond($pag,NUMPP,'packages','WHERE selected=1','packages/selected',$order);
        $this->view->render('packages/list');  
    }
    public function editCreatePackage($id=null) 
    {
        $type=(!$id)?'add':'edit';
        $this->view->form=$this->model->packageForm($type,$id);
        $this->view->render('packages/editpackage');  
    }
    public function delivers($pag=1,$order='created_at DESC'){
        $this->model->pag=$pag;
        $this->view->list=$this->model->deliversToTable($this->model->getDelivers($pag,NUMPP,$order),$order);
        $this->view->pagination=$this->model->getPaginationCond($pag,NUMPP,'package_deliveries',$this->model->wherepag,'packages/delivers',$order);
        $this->view->render('packages/delivers');
    }
    public function addModel($package=null,$pag=1) 
    {
        $this->view->package=$package;
        $models=$this->loadSingleModel('models');
        $this->view->models=$models->getModels($pag,NUMPP);
        $this->view->searchModel=$models->searchForm('/packages/searchModel/'.$package);
        $this->view->pagination=$this->model->getPagination($pag,NUMPP,'models','packages/addModel/'.$package);
        $this->view->categories=$models->getModelsCategories();
        $this->view->modelsPackage=$this->model->modelsPackage($package);
        $this->view->render('packages/listModels');
    }
    public function searchModel($package) 
    {
        $this->view->package=$package;
        $models=$this->loadSingleModel('models');
        $this->view->searchModel=$models->searchForm('/packages/searchModel/'.$package);
        $this->view->models=$models->getModelSearch();
        $this->view->categories=$models->getModelsCategories();
        $this->view->modelsPackage=$this->model->modelsPackage($package);
        $this->view->render('packages/listModels');  
    }
     public function duplicate($idpackage){
        $this->model->duplicate($idpackage);
        header('location: ' . URL . LANG . '/packages/lista');   
    }
    public function deliver($idpackage){
        $this->view->id=$idpackage;
        $this->view->form=$this->model->deliverForm($idpackage);
        $this->view->render('packages/deliver');  
    }
    public function sendPackage(){
        $this->model->sendPackage($idpackage);
        header('location: ' . URL . LANG . '/test/deliver/28773');
    }
    public function deleteModel($package,$model){
        $id=$this->model->deleteModel($package,$model);
        header('location: ' . URL . LANG . '/packages/view/'.$package);
    }
    public function deleteModels(){
        $id=$this->model->deleteModels();
        header('location: ' . URL . LANG . '/packages/view/'.$id);   
    }
    public function addToPackage($package=null) 
    {
        $id=$this->model->addToPackage($package);
        
    }
    public function create() 
    {
        $id=$this->model->create();
        header('location: ' . URL . LANG . '/packages/view/'.$id);
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/packages/view/'.$id);
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . LANG .  '/packages/lista/');
    }
    public function sort() 
    {
        $this->model->sort();
    }
    public function sortByname($id) 
    {
        $this->model->sortByname($id);
        header('location: ' . URL . LANG . '/packages/view/'.$id); 
    }
    
}