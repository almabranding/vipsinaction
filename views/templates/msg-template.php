<div id="signup-box">
    <label for="msgCheck" class="xLogo">x</label>
    <?= $accounttype ?>
    <h1><?= $this->lang['registra_o_accede'] ?></h1>
    <div style='margin:20px 0;height: 100px;'>
        <p><?= $this->lang['debes_reigsitrarte'] ?></p>
        <p><?= $this->lang['ya_tienes'] ?> <label class='check' for="loginCheck"><?= $this->lang['entra!'] ?></label><br>
            <?= $this->lang['no_tienes?'] ?> <label class='check' for="signupCheck"><?= $this->lang['registrate_aqui'] ?></label></p>
    </div>
    <div class='clr'></div>
</div>