
<div id="signup-box">
<label for="signupCheck" class="xLogo">x</label>
<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<?=$accounttype ?>
    <h1><?=$this->variables['turn to member']?></h1>
    <a href="https://www.facebook.com/dialog/oauth?client_id=<?=APP_ID?>&redirect_uri=<?=APP_REDIRECT?>&scope=publish_stream,email,user_about_me" title="Signup with facebook">
     <div id="facebookSignup"></div></a>
    <p><?=$this->variables['acuerdos_fb']?> <a href="<?=URL?>terms" target="_blank"><?=$this->variables['Acuerdo de usuario']?></a></p>
    <span id="oregister"><?=$this->variables['O_REGISTRATE']?></span>
    <p><?=$this->variables['coplete_formulario']?></p>
<ul><li class="row" style="text-align: left">
    <?php echo $label_email . $email ?>
    <span id="error_1" class="orange error" style="display: none;"><?=$this->variables['mail_existe']?></span>
</li>
<li class="row">
    <?php echo $label_firstname . $firstname ?>
</li>
<li class="row even">
    <?php echo $label_lastname. $lastname?>
</li>
<li class="clear"></li>
<li class="row" style="text-align: left">
    <?php echo $label_nick . $nick ?>
    <span id="error_2" class="orange error" style="display: none;"><?=$this->variables['nick_existe']?></span>
</li>
<li class="clear"></li>
<li class="row even">
    <?php echo $label_user_password . $user_password?>
</li>
<li class="row even">
    <?php echo $label_confirm_password . $confirm_password ?>
</li>
<li class="clear" style="margin: 10px 0"></li>
<li class="row even leftAlign">
    <?php echo  $extra_acuerdo.$label_extra_acuerdo ?>
</li><li class="row even leftAlign">
    <?php echo  $extra_noticias.$label_extra_noticias ?>
</li>
<li class="row last">
    <?php echo $_btnsubmit ?>
</li>

</ul>
<div class="clear"></div>
</div>

