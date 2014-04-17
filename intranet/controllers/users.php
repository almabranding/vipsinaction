<?php

class Users extends Controller {

    function __construct() {
        parent::__construct();
        if (!Session::get('loggedIn'))
            header('location: ' . URL);
    }

    function index() {
        header('location: ' . URL . 'users/lista');
    }

    public function lista($pag = 1, $order = 'id ASC') {
        $maxpp = 35;
        $this->model->pag = $pag;
        $this->view->list = $this->model->usersToTable($this->model->getUsers(null,$order), $order);
        $this->view->render('users/list');
    }

    public function view($id = null, $order = 'id ASC') {
        $this->view->js = array('users/js/custom.js');
        $this->view->form = $this->model->usersForm($id);
        $this->view->list = $this->model->reporttoTable($this->model->getReport($id,$order), $order);
        $this->view->render('users/view');
    }

    public function create() {
        $id = $this->model->create();
        header('location: ' . URL . LANG . '/users/lista/');
    }

    public function edit($id) {
        $this->model->edit($id);
        header('location: ' . URL . LANG . '/users/lista/');
    }

    public function delete($id) {
        $this->model->delete($id);
        header('location: ' . URL . LANG . '/users/lista/');
    }

    public function sort() {
        $this->model->sort();
    }

}
