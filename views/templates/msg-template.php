<?
$lng=(isset($_GET['lng']))?$_GET['lng']:'es';
$msg=(isset($_GET['lng']))?$_GET['msg']:'no_login';
include('../../lang/'.$lng.'/default.php');?>
<div id="signup-box">
    <label for="msgCheck" class="xLogo">x</label>
    <? switch($msg){
       case 'no_login': ?>
    <h1><?= $lang['registra_o_accede'] ?></h1>
    <div style='margin:20px 0;height: 100px;'>
        <p><?= $lang['debes_reigsitrarte'] ?></p>
        <p><?= $lang['ya_tienes'] ?> <label class='check' for="loginCheck"><?= $lang['entra!'] ?></label><br>
            <?= $lang['no_tienes?'] ?> <label class='check' for="signupCheck"><?= $lang['registrate_aqui'] ?></label></p>
    </div>
    <? break;
    case 'bid_min':?>
    <h1><?= $lang['no_bid_min'] ?></h1>
    <div style='margin:20px 0;height: 100px;'>
        <p><?= $lang['no_bid_min_text'] ?></p>
    </div>
       <? break;
    }?>
    <div class='clr'></div>
</div>