


<div id="signup-box">
<label for="loginCheck" class="xLogo">x</label>
<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<?=$accounttype ?>
    <h1><?=$this->variables['accede_tu_cuenta']?></h1>
    <h2><?=$this->variables['no_tienes_cuenta']?> <label id="registerLabel" for="signupCheck"><?=$this->variables['registrate_aqui']?></label></h2>
<ul><li class="row">
    <?php echo $label_email . $email ?>
</li>
<li class="row">
    <?php echo $label_firstname . $firstname ?>
</li>
<li class="row even">
    <?php echo $label_password . $password ?>
</li>
<li class="row last">
    <a href="https://www.facebook.com/dialog/oauth?client_id=<?=APP_ID?>&redirect_uri=<?=APP_REDIRECT?>&scope=publish_stream,email,basic_info" title="Signup with facebook">
     <div id="facebookSignup" class="facebookLogin"></div></a>
    <?php echo $_btnsubmitLogin ?>
</li>

</ul>
<div class="clear"></div>
</div>

