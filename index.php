<?php

//error_reporting(0);
require 'config.php';
require 'util/Strip.php';
require 'util/Util.php';
ini_set('include_path', 'util/PEAR');
// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    if (file_exists(LIBS . $class . ".php"))
        require LIBS . $class . ".php";
}
// Load the Bootstrap!
$bootstrap = new Bootstrap();

// Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

$bootstrap->init();
//$bootstrap->end();
