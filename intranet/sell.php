<?
require 'config.php';
function __autoload($class) {
    if (file_exists(LIBS . $class .".php")) require LIBS . $class .".php";
}
include ROOT.'views/head.php';
include ROOT.'views/header.php';
include '/home/vipsinaction.com/web/temp/WeBid/sell.php';