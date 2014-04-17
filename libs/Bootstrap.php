<?php

class Bootstrap {

    private $_url = null;
    private $_cache = null;
    private $_controller = null;
    private $_controllerPath = 'controllers/'; // Always include trailing slash
    private $_modelPath = 'model/'; // Always include trailing slash
    private $_errorFile = 'error.php';
    private $_errorModule = 'error';
    private $_errorLunched = false;
    private $_defaultFile = 'index.php';
    private $_ZebraForm = 'Zebra_Form/Zebra_Form.php';
    private $_allowLang = Array('es', 'en', 'ca');
    private $_langList = Array(
        'es' => 'ESPAÑOL',
        'en' => 'ENGLISH',
        'ca' => 'CATALAN'
    );

    /**
     * Starts the Bootstrap
     * 
     * @return boolean
     */
    public function init() {
        // Sets the protected $_url
        $this->_getUrl();
        //$this->_getCache();
        Session::init();
        require LIBS . $this->_ZebraForm;

        // Serve from the cache if it is the same age or younger than the last 
        // modification time of the included file (includes/$reqfilename)
        //$this->loadCache();
        // Load the default controller if no URL is set
        // eg: Visit http://localhost it loads Default Controller
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }
        $this->_loadExistingController();
        if (!$this->_errorLunched)
            $this->_callControllerMethod();
    }

    /**
     * End the Bootstrap
     * 
     * @return boolean
     */
    public function end() {
        
    }

    /**
     * Check if the page is cached
     */
    public function loadCache() {

        $cachetime = 30 * 60; // 5 minutes
        $cachefile = ROOT . "cache/" . $this->_cache . ".html";
        if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
            include($cachefile);
            exit;
        }


        // start the output buffer
        ob_start();
    }

    /**
     * (Optional) Set a custom path to controllers
     * @param string $path
     */
    public function setControllerPath($path) {
        $this->_controllerPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to models
     * @param string $path
     */
    public function setModelPath($path) {
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: error.php
     */
    public function setErrorFile($path) {
        $this->_errorFile = trim($path, '/');
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: index.php
     */
    public function setDefaultFile($path) {
        $this->_defaultFile = trim($path, '/');
    }

    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = str_replace(' ', '+', $url);
        $url = str_replace('-', '', $url);
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
        foreach ($this->_url as $id => $value) {
            if (!in_array($value, $this->_allowLang)) {
                $auxUrl.='/' . $value;
            }
        }
        define('PATH', $auxUrl);
        Session::init();
        if (in_array(strtolower($this->_url[0]), $this->_allowLang)) {
            Session::set('lang', strtolower(array_shift($this->_url)));
            define('LANG', Session::get('lang'));
        } else {
            if (!Session::get('lang')) {
                Session::set('lang', 'es');
            }
            define('LANG', Session::get('lang'));
        }
        $rute = '';
        foreach ($this->_url as $value) {
            $rute.=$value . '/';
        }
        if ($rute != '/')
            Session::set('cookies', true);
        define('RUTE', $rute);
    }

    private function _getCache() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        if (empty($url))
            $url = 'index';
        $this->_cache = str_replace('/', '.', $url);
    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Index();
        $this->_controller->loadModel('index', '', $this->_modelPath);
        $this->_controller->loadLang($this->_allowLang,$this->_langList, 'index');
        $this->_controller->index();
    }

    /**
     * Load an existing controller if there IS a GET parameter passed
     * 
     * @return boolean|string
     */
    private function _loadExistingController() {
        $file = $this->_controllerPath . $this->_url[0] . '.php';

        if (file_exists($file)) {
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0], $this->_url[2], $this->_modelPath);
            $this->_controller->loadLang($this->_allowLang,$this->_langList, $this->_url[0]);
        } else {
            $this->_error();
            $this->_controller->index();
            return false;
        }
    }

    /**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod() {
        $length = count($this->_url);

        // Make sure the method we are calling exists
        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                if (!$this->_errorLunched)
                    $this->_error();
                $this->_controller->index();
                exit;
            }
        }
        // Determine what to load
        switch ($length) {
            case 6:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4], $this->_url[5]);
                break;
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;

            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;

            case 3:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;

            case 2:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}();
                break;

            default:
                $this->_controller->index();
                break;
        }
        @$this->_controller->model->endConn();
    }

    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    private function _error() {
        $this->_errorLunched = true;
        require $this->_controllerPath . $this->_errorFile;
        $this->_controller = new Error();
        $this->_controller->loadModel($this->_errorModule);
        return false;
    }

    public function getLangs() {
        return $this->_allowLang;
    }

}
