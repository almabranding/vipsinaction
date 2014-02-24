<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Robots" content="Nofollow"/>
    <title>Modelpack Intranet</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css" />
    <script type="text/javascript">
        google.load("jquery", "1.7.1");
        google.setOnLoadCallback(function() {
            // Your code goes here.
        });
    </script>
</head>

<body  class="login-page">
    <div id="login-box">
        <div id="header">
            <a href="index.php" > <div id="logo" style="margin:auto; float:none;"><img src="<?= URL ?>public/img/logo.png"></div></a>
            <div id="contact">
                <!--<a href="#">What is modelpack</a> | <a href="#">Contact?</a>-->
            </div>
        </div>
        <div class="form-box">
            <H2>Access</H2>
            <form method="post" action="<?php echo URL . LANG; ?>/login/run" >
                <div id="login-box-name" style="">User:</div><div id="login-box-field" style=""><input name="login" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
                <div id="login-box-name">Password:</div><div id="login-box-field"><input name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
                <br />
                <span class="login-box-options"><input type="checkbox" name="remember" value="1"> Remember <!--<a href="#" style="margin-left:30px;">Forgot password?</a>--></span>
                <br />
                <br />
                <input type="submit" value="LOGIN" class="login-box-button"/>
            </form>
        </div>
    </div>
</body>