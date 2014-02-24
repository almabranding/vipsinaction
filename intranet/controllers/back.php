<?php

class Back extends Controller {

    function __construct() {
        parent::__construct();
        if(!Session::get('loggedIn')) header('location: '.URL);
    }
    public function index() 
    {
        
    }
    public function thumbnails() 
    {
        $this->model->thumbnails();
    }
    public function listar(){
        $this->model->listar_directorios_ruta(ROOT.'../uploads/models/000/');
    }
    public function copyfiles(){
        $this->model->copyfiles();
       
    }
    
}