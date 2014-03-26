<?php
class Controller {
    
    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
    }
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name,$control='', $modelPath = 'model/') {
        $this->loadLang($name);
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            if(!class_exists($name.'_Model'))require $modelPath .$name.'_model.php';
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }  
        $this->view->user = $this->model->user=Session::get('user');
       
        
    }
    public function loadSingleModel($name, $modelPath = 'model/') {
        $path = $modelPath . $name.'_model.php';
        if (file_exists($path)) {
            if(!class_exists($name.'_Model')) require $modelPath .$name.'_model.php';
            $modelName = $name . '_Model';
            $model=new $modelName();
            return $model;
        }        
    }
    public function loadLang($_allowLang,$name=null) {
        $this->model->_allowLang=$_allowLang;
        $this->view->_allowLang =$_allowLang;
       // public function loadLang($name, $langPath = 'lang/EN/') {
        $langPath='lang/'.LANG.'/';
        require $langPath .'default.php';
        $path = $langPath . $name.'.php';
        if (file_exists($path)) {
            require $path;
        }
        //$this->model->setLang(LANG);
        $this->view->lang = $lang;
        $this->model->lang = $lang;
    
    }

}