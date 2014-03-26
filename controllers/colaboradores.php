<?php

class Colaboradores extends Controller {

    private $section;

    function __construct() {
        parent::__construct();
    }

    function index() {
       header('location: '.URL.'/colaboradores/view/'. $this->lang['donantes']);
    }

    function view($name) {
        $this->view->setBreadcrumb('<a href="/" class="capitalize">'.$this->view->lang['home'].'</a>',true);
        $this->view->setBreadcrumb('<a href="/colaboradores/view/'.$name.'" class="capitalize">'.$name.'</a>',false);
        $this->view->title=$name;
        $this->view->donantes=$this->model->getDonantesByName($name);
        $this->view->render('colaboradores/view');
    }
    function auctions($id,$name=null) {
        $donanteInfo=$this->model->getDonantesById($id);
        $this->view->setBreadcrumb('<a href="/" class="capitalize">'.$this->view->lang['home'].'</a>',true);
        $this->view->setBreadcrumb('<a href="/colaboradores/view/'.$donanteInfo['type_name'].'" class="capitalize">'.$this->view->lang[$donanteInfo['type_name']].'</a>',true);
        $this->view->setBreadcrumb('<span class="capitalize">'. urldecode($donanteInfo['name']).'</span>',false);
        $this->view->bids=$this->model->getDonantesAuction($id);
        $this->view->render('auction/lista');
    }
}
