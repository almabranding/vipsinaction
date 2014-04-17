<?php

class Page extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('page/js/custom.js');
    }

    function view($page) {
        $this->view->setBreadcrumb('<a href="/" class="capitalize">' . $this->view->lang['home'] . '</a>', true);
        $this->view->article = $this->model->getArticle($page);
        $this->view->setBreadcrumb('<span class="capitalize">' . $this->view->lang[$page] . '</span>', false);
        switch ($page) {
            case 'about':
                $this->view->render('page/about');
                break;
            case 'testimonios':
                $this->view->reviews = $this->model->getReviews();
                $this->view->render('page/testimonios');
                break;
            case 'gift':
                $this->view->title = $this->model->lang['gift_title_1'] . '<span class="orange">' . $this->model->lang['gift_title_2'] . '</span>' . $this->model->lang['gift_title_3'] . '<span class="orange">' . $this->model->lang['gift_title_4'] . '</span>';
                $this->view->subtitle = $this->model->lang['gift_subtitle'];
                $this->view->formName = 'gift-template';
                $this->view->form = $this->model->giftForm();
                $this->view->render('page/form');
                break;
            case 'dogift':
                try {
                    $this->model->sendGift();
                } catch (Exception $e) {
                    $this->view->message = array(
                        'content' => $this->view->lang['algun_error']
                    );
                    $this->view->render('error/message');
                    break;
                }
                $this->view->message = array(
                    // 'title'=>$this->view->lang['gift_delivered'],
                    'content' => $this->view->lang['gift_enviado']
                );
                $this->view->render('error/message');
                break;
            case 'crowdfunding':
                $this->view->title = $this->model->lang['donation_title_1'] . '<br><span class="orange">' . $this->model->lang['donation_title_2'] . '</span>';
                $this->view->subtitle = $this->model->lang['donation_subtitle'];
                $this->view->formName = 'donation-template';
                $this->view->form = $this->model->donationForm();
                $this->view->render('page/form');
                break;
            case 'contact':
                $this->view->article = $this->model->getArticle($page);
                $this->view->contactForm = $this->model->contactForm();
                $this->view->render('page/contact');
                break;
            case 'sendcontact':
                try {
                    $this->model->sendContact();
                } catch (Exception $e) {
                    $this->view->message = array(
                        'content' => $this->view->lang['algun_error']
                    );
                    $this->view->render('error/message');
                    break;
                }
                $this->view->message = array(
                    'content' => $this->view->lang['contact_enviado']
                );
                $this->view->render('error/message');
                break;
            default:
                $this->view->render('page/article');
                break;
        }
    }

    function preparecrowdfunding() {
        $this->view->setBreadcrumb('<a href="/" class="capitalize">' . $this->view->lang['home'] . '</a>');
        $this->view->setBreadcrumb('<a href="' . URL . 'page/view/crowdfunding" class="capitalize">' . $this->view->lang['crowdfunding'] . '</a>');
        $this->view->setBreadcrumb($_GET['ong'], false);
        $this->view->js[] = 'auction/js/jquery.creditCardValidator.js';
        $this->view->crowdfundingForm = $this->model->crowdfundingForm();
        $this->view->render('page/payment');
    }

    function docrowdfunding() {
        try {
            if ($_POST['card'])
                $this->model->saveCard();
        } catch (Exception $e) {
            
        }
        try {
            $this->model->sendCrowdfounding();
        } catch (Exception $e) {
            $this->view->message = array(
                'content' => $this->view->lang['algun_error']
            );
            $this->view->render('error/message');
        }
        $this->view->message = array(
            'content' => $this->view->lang['crowd_enviado']
        );
        $this->view->render('error/message');
    }

}
