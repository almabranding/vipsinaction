<?php
//error_reporting(0);
require 'config.php';
require 'util/Auth.php';

function __autoload($class) {
    if (file_exists(LIBS . $class .".php")) require LIBS . $class .".php";
}

ini_set('include_path', 'util/PEAR');
// Load the Bootstrap!
$bootstrap = new Bootstrap();

// Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

$bootstrap->init();