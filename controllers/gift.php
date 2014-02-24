<?php

class Gift extends Controller {

    private $section;

    function __construct() {
        parent::__construct();
        $this->view->setBreadcrumb('<a href="/gift">Gift</a>');
    }

    function index() {
        header('location: ' . URL . 'gift/make-a-gift');
    }

    function makeagift() {
        $page=$this->view->section='makeagift';
        $this->view->article=$this->model->getArticle($page);
        $this->view->setBreadcrumb('Make a gift',true);
        $this->view->giftForm=$this->model->giftForm();
        $this->view->gift=$this->model->getGiftList();
        
        $this->view->render('gift/make-a-gift');
    }

    function choseagift($type='all') {
        $page=$this->view->section='choseagift';
        $this->view->article=$this->model->getArticle($page);
        $this->view->gift=$this->model->getGiftList();
        $this->view->rooms=$this->model->getGifProducts($type);
        $this->view->setBreadcrumb('Chose your gift',true);
        $this->view->type=$type;
        $this->view->render('gift/chose-your-gift');
    }
    function detail($id=null,$name = null) {
        $this->view->setBreadcrumb(urldecode($name), true);
        $this->view->hotel=$this->model->getGiftInfo($id);
        $this->view->rooms=$this->model->getGiftRooms($id);
        $this->view->type='gift';
        $this->view->js[] = 'page/js/detail.js';
        $this->view->js[] = '../public/js/zebra_datepicker.js';
        $this->view->js[] = 'page/js/results.js';
        $Booking_bridge=new Booking_bridge(0);
        $this->view->search = $Booking_bridge->searchForm();
        $this->view->searchVar['view']=$this->view;
        $this->view->render('page/detail');
    }
}
