<?php

class User extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('page/js/custom.js');
        $this->view->css = array('page/css/custom.css');
        $this->view->setBreadcrumb('User');
    }

    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }

    function signup() {
        $this->view->error = (isset($_GET['exist'])) ? '* Este usuario ya existe' : '';
        $this->view->signupForm = $this->model->signupForm();
        $this->view->setBreadcrumb('Signup', true);
        $this->view->render('page/signup');
    }

    function remember($done = null) {
        $this->view->message['title'] = 'REMEMBER PASSWORD';
        $this->view->message['subtitle'] = '*ALL FIELDS ARE REQUIRED';
        $this->view->setBreadcrumb('Remember password', true);
        if ($done == null) {
            $this->view->form = $this->model->rememberForm();
            $this->view->formName = 'remember-template';
            $this->view->render('page/message');
        } else {
            $this->model->sendRememberMail();
            $this->view->message['title'] = 'Remember Password';
            $this->view->message['subtitle'] = 'Email has been sent';
            $this->view->message['content'] = 'Check your mail';
            $this->view->render('page/message');
        }
    }

    function resetpassword($done = null) {
        if (!$this->model->controlMail())
            header('location: ' . URL);
        $this->view->message['title'] = 'Reset Password';
        $this->view->message['subtitle'] = '';
        $this->view->message['content'] = '';
        $this->view->setBreadcrumb('Reset password', true);
        if ($done == null) {
            $this->view->form = $this->model->resetForm();
            $this->view->formName = 'reset-template';
            $this->view->render('page/message');
        } else {
            $this->model->reset();
            $this->view->message['title'] = 'Reset Password';
            $this->view->message['subtitle'] = '';
            $this->view->message['content'] = 'Your password has been reset';
            $this->view->render('page/message');
        }
    }

    function create() {
        $this->view->id = $this->model->create();
        if ($this->view->id == 0)
            header('location: ' . URL . 'user/signup?exist=yes');
        else
            header('location: ' . URL);
    }

    function edit() {
        $this->view->id = $this->model->edit();
        header('location: ' . URL . 'experience');
    }

    function activate() {
        $isActive = $this->model->activate($_GET['id'], $_GET['hash']);
        if ($isActive){
            $this->model->forceLogin($_GET['id']);
            header('location: ' . URL . 'experience');
        }
        else
            header('location: ' . URL);
    }

    function login() {
        $this->model->login();
        header('location: ' . URL . 'experience');
    }

    function logout() {
        $this->model->logout();
        header('location: ' . URL);
    }

    function profile() {
        $this->model->getUser();
        $this->view->bookings = $this->model->getBookings();
        $this->view->signupForm = $this->model->signupForm();
        $this->view->setBreadcrumb('Signup', true);
        $this->view->render('page/profile');
    }

    function booking($bookid = null) {
        $this->view->booking = $this->model->getBooking($bookid);
        $this->view->user = $this->model->getUser();
        $this->view->setBreadcrumb('Booking');
        $this->view->setBreadcrumb($this->view->booking['booking_description'], true);
        $this->view->render('page/booking_detail');
    }

    function bookingPDF($bookid) {
        $this->view->booking = $this->model->getBooking($bookid);
        $this->view->user = $this->model->getUser();
        $this->view->setBreadcrumb('Booking');
        $this->view->setBreadcrumb($this->view->booking['booking_description'], true);
        require_once( $_SERVER['DOCUMENT_ROOT'] . "/libs/dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();
        ob_start();
        $this->view->render('page/booking_detail');
        //require_once($_SERVER['DOCUMENT_ROOT'] . "/views/templates/booking-detail.php");
        $html = '<html><body><src="' . URL . '/public/img/addFav.png"></body></html>';

        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("file.pdf");
    }

}
