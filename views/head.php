<?
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=($this->siteName)?$this->siteName.' - TERRAE':'TERRAE';?></title>
    <meta charset="UTF-8"> 
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta property="og:title" content="Sight Management" />
    <meta property="og:site_name" content="Sight Management" />
    <meta property="og:description"content="Sight Management"/>
    <meta property="og:image" content="/public/images/logo.png" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, minium-scale=1.0,user-scalable=yes"/>
    <link rel="shortcut icon" href="<?=URL; ?>favicon.png" Content-type="image/x-icon" />
    <link rel="stylesheet" href="<?=URL; ?>public/css/style.css" />
    <link rel="stylesheet" href="<?=URL; ?>public/css/mobile.css"/>
    <link rel="stylesheet" href="<?=URL; ?>public/css/zebra_form.css"/>
    <script src="<?=URL; ?>public/js/modernizr.js"></script>
    <?php
    if (isset($this->css)) 
        foreach ($this->css as $css)
            echo '<link rel="stylesheet" href="'.URL.'views/'.$css.'"/>';
    ?>
    <? include("analyticstracking.php")?>
</head>
<body>
    
    