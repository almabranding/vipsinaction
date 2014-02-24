<div id="cookie">
THIS WEBSITE USES COOKIES. BY CLOSING THIS MESSAGE AND CONTINUING TO BROWSE THIS WEBSITE YOU ARE AGREEING TO OUR USE OF COOKIES.                                                                                        <div class="close"></div></div><div id="splash-header">
    <div id="splash-head">
        <div id="splash-language">
            Language: <div class="language-arrow"><?=  strtoupper(LANG)?></div>
            <ul id="splash-langMenu">
                <li><a href="<?= URL . 'en' . RUTE; ?>">United Kingdom</a></li>
                <li><a href="<?= URL . 'es' . RUTE; ?>">España</a></li>
                <li><a href="<?= URL . 'it' . RUTE; ?>">Italia</a></li>
            </ul>
        </div>
        <div id="splash-login"><label onclick="" for="menuCheck">LOGIN</label>
            <input id="menuCheck" type="checkbox">
            <div id="splash-login-container">
            <div id="splash-login-box">
                <div id="splash-login-pic"></div>
                <div class="splash-login-left">
                    <h2>NEW USER ?</h2>
                    <a href="#" class="ford-arrow">Create Account</a>
                   <h2 style="margin-top: 90px;">FORGOT YOUR PASSWORD?</h2>
                   <a href="/user/remember" class="ford-arrow">Send email</a>
                </div>
                <div class="splash-login-line"></div>
                <div class="splash-login-right">
                    <h1>SIGN IN</h1>
                    <?= $this->loginForm->render('views/templates/login-template.php') ?>
                </div>
            </div>
        </div>
        </div>

        <div id="splash-logo">
            <a href="/"><img src="<?= URL ?>public/img/logo.png"></a>
            <div class="comefeel">COME & FEEL</div>
            <div class="subline"></div>
        </div>

    </div>
    <div id="splash-menu">
        <ul><? foreach ($this->sections as $key => $section) { ?>
            <li class="<?=($key==0)?'selected':''?>"><a href="#"><?= $section['name'] ?></a><?= ($key == 0) ? '<div class="subline"></div>' : ''; ?></li><? } ?>
        </ul>
    </div>
</div>

<div id="splash-content" style="">
    <div id="splash-sly">
        <div class="wrap">
            <div class="frame oneperframe" id="oneperframe">
                <ul class="clearfix">
                    <? foreach ($this->sections as $key => $section) {
                        ?><li style="background-image: url('<?= UPLOAD . Model::getRouteImg($section['img']).$section['file_name']; ?>') "><div id="splash-leyend">
                                <a href="/experience/home/<?= strtolower($section['name']) ?>"> <div id="splash-leyend-text">
                                    <h1><?=  $section['name'] ?></h1>
                                    <p><?= $section['content'] ?></p>
                                    <span class="splash-leyend-go">GO IN</span>
                                </div></a>
                            </div>
                        </li><? } ?>
                </ul>
            </div>
            <ul class="pages"></ul>
        </div>
    </div>

</div>