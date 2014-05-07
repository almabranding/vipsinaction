<?php

class Colaboradores extends Controller {

    private $section;

    function __construct() {
        parent::__construct();
        $this->view->js = array('colaboradores/js/custom.js');
    }

    function index() {
       header('location: '.URL.'/colaboradores/view/'. $this->lang['donantes']);
    }

    function view($name) {
        $name=  strtolower($name);
        $this->view->setBreadcrumb('<a href="/" class="capitalize">'.$this->view->lang['home'].'</a>',true);
        $this->view->setBreadcrumb('<a href="/colaboradores/view/'.$name.'" class="capitalize">'.$name.'</a>',false);
        $this->view->title=$name;
        $this->view->donantes=$this->model->getDonantesByName($name);
        foreach($this->view->donantes as $donante){
            $this->view->auctions[$donante['donantes_id']]=$this->model->getDonantesAuction($donante['donantes_id']);
        }
        $this->view->render('colaboradores/view');
    }
    function auctions($id) {
        $this->view->setBreadcrumb('<a href="/" class="capitalize">'.$this->view->lang['home'].'</a>',true);
        $this->view->donantes=$this->model->getDonantesById($id);
        foreach($this->view->donantes as $donante){
            $this->view->auctions[$donante['donantes_id']]=$this->model->getDonantesAuction($donante['donantes_id']);
        }
        $this->view->setBreadcrumb($donante['name'],true);
        $this->view->render('colaboradores/view');
    }
}
