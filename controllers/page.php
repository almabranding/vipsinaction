<?php

class Page extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('page/js/custom.js');
    }

    function view($page) {
        $this->view->setBreadcrumb('<a href="/" class="capitalize">'.$this->view->lang['home'].'</a>',true);
        $this->view->article = $this->model->getArticle($page);
        $this->view->setBreadcrumb('<span class="capitalize">'.$this->view->lang[$page].'</span>',false);
        switch ($page) {
            case 'about':
                $this->view->reviews = $this->model->getReviews();
                $this->view->render('page/about');
                break;
            case 'gift':
                $this->view->title = $this->model->lang['gift_title_1'] . '<span class="orange">' . $this->model->lang['gift_title_2'] . '</span>' . $this->model->lang['gift_title_3'] . '<span class="orange">' . $this->model->lang['gift_title_4'] . '</span>';
                $this->view->subtitle=$this->model->lang['gift_subtitle'];
                $this->view->formName='gift-template';
                $this->view->form = $this->model->giftForm();
                $this->view->render('page/form');
                break;
            case 'crowdfunding':
                $this->view->title = $this->model->lang['donation_title_1'] . '<span class="orange">' . $this->model->lang['donation_title_2'] . '</span>';
                $this->view->subtitle=$this->model->lang['donation_subtitle'];
                $this->view->formName='donation-template';
                $this->view->form = $this->model->donationForm();
                $this->view->render('page/form');
                break;
            case 'contact':
                $this->view->article = $this->model->getArticle($page);
                $this->view->contactForm = $this->model->contactForm();
                $this->view->render('page/contact');
                break;
            default:
                $this->view->render('page/article');
                break;
        }
    }

    function contact() {
        
    }

}
