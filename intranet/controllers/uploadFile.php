<?php

class uploadFile extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    function upload() {
       $img=new upload('');
       return $img->getImg();
    }
    function orderByName($model,$num){
        $this->model->orderByName($model,$num);
    }
    function crop($return='/') {
       $this->model->crop();
       header('location: ' . $return);
    }
}