<?php

class User extends Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->msg = 'This page doesnt exist';
        $this->view->render('error/index');
    }

    function settings($nick) {
        $this->view->setBreadcrumb('<a class="capitalize" href="/">'.$this->view->lang['home'].'</a>');
        $this->view->setBreadcrumb('<span class="capitalize">'.$this->view->lang['user'].'</span>');
        $this->view->js = array('user/js/custom.js');
        if ($nick != $this->model->user['nick'])
            header('location: ' . URL);
        $this->view->userForm = $this->model->userForm($nick);
        $this->view->user = $this->model->getUser($nick);
        $this->view->render('user/view');
    }

    function favorites() {
        $this->view->title=$this->view->lang['favoritos'];
        $this->view->setBreadcrumb('<a class="capitalize" href="/">'.$this->view->lang['home'].'</a>',true);
        $this->view->setBreadcrumb('<a class="capitalize" href="/user/settings/'.$this->model->user['nick'].'">'.$this->view->lang['user'].'</a>',true);
        $this->view->setBreadcrumb('<span class="capitalize">'.$this->view->lang['favoritos'].'</span>');
        $this->view->bids=$this->model->getFavorites();
        $this->view->render('auction/lista');
    }
    function bids() {
        $this->view->title=$this->view->lang['my_bids'];
        $this->view->setBreadcrumb('<a class="capitalize" href="/">'.$this->view->lang['home'].'</a>',true);
        $this->view->setBreadcrumb('<a class="capitalize" href="/user/settings/'.$this->model->user['nick'].'">'.$this->view->lang['user'].'</a>',true);
        $this->view->setBreadcrumb('<span class="capitalize">'.$this->view->lang['my_bids'].'</span>');
        $this->view->bids=$this->model->getBids();
        $this->view->render('auction/lista');
    }

    function remember($done = null) {
        $this->view->message['title'] = 'REMEMBER PASSWORD';
        $this->view->setBreadcrumb('Remember password', true);
        if ($done == null) {
            $this->view->form = $this->model->rememberForm();
            $this->view->formName = 'remember-template';
            $this->view->render('page/message');
        } else {
            $this->model->sendChangePasswordMail();
            header('location: ' . URL . 'user/message/5');
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

    function message($code = null) {
        switch ($code) {
            //Register done, please confirm
            case 1:
                $this->view->setBreadcrumb('Register Complete');
                $this->view->message['title'] = 'Please confirm your mail';
                $this->view->message['subtitle'] = '';
                $this->view->message['content'] = 'We sent you an email. Please confirm your mail';
                break;
            //FbRegister done, login
            case 2:
                $this->view->setBreadcrumb('Register Complete');
                $this->view->message['title'] = 'Reset Password';
                $this->view->message['subtitle'] = '';
                $this->view->message['content'] = 'Your password has been reset';
                break;
            //Password has been changed
            case 3:
                $this->view->setBreadcrumb('Password changed');
                $this->view->message['title'] = 'Reset Password';
                $this->view->message['subtitle'] = '';
                $this->view->message['content'] = 'Your password has been reset';
                break;
            //User not found
            case 4:
                $this->view->setBreadcrumb('User not found');
                $this->view->message['title'] = 'User or password wrong';
                $this->view->message['subtitle'] = '';
                $this->view->message['content'] = 'Please try again or <a href="'.URL.'user/remember">reset password</a>';
                break;
            //Remember password
            case 5:
                $this->view->setBreadcrumb('Remember Password');
                $this->view->message['title'] = 'Remember Password';
                $this->view->message['subtitle'] = '';
                $this->view->message['content'] = 'We sent you an email. Please check your mail';
                break;
        }
        $this->view->render('page/message');
    }

    function create() {
        $this->view->id = $this->model->create();
        if ($this->view->id == 0)
            header('location: ' . URL . 'user/message');
        else
            header('location: ' . URL . 'user/message/1');
    }

    function edit() {
        $error = $this->model->edit();
        switch ($error) {
            case 1:
                header('location: ' . URL . 'user/message/1');
                break;
            default:
                header('location: ' . URL);
        }
    }

    function activate() {
        $this->model->activate($_GET['id'], $_GET['hash']);
        header('location: ' . URL);
    }

    function login() {
        $error = $this->model->login();
        switch ($error) {
            case 0:
                header('location: ' . URL);
                break;
            case 1:
                header('location: ' . URL . 'user/message/4');
                break;
            case 2:
                header('location: ' . URL . 'user/message/1');
                break;
            default:
                header('location: ' . URL);
        }
    }

    function logout() {
        $this->model->logout();
        header('location: ' . URL);
    }

    function fbRegister() {
        $this->model->fbRegister();
    }

    function checkRegister() {
        $this->model->checkRegister();
    }

}
