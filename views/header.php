<? if (RUTE == '/' && !Session::get('cookies')) { ?><input id="cookieCheck" type="checkbox"  class="away"><div id="cookies"><div id="wrapper"><?= $this->lang['coockies_msg'] ?> <label class="xLogo" for="cookieCheck" style="top:0;right:0;">x</label></div></div><? } ?>
<div id="header">
    <div id="wrapper">
        <input id='menu_button' name='menu_button' type="checkbox">
        <label class="menu_button" for='menu_button'></label>
        <div id="menuNavMobile">
            <ul class="navMobile">
                <? foreach ($this->menu as $key => $menu) { ?><li class="primary">
                        <a target="<?= (( strpos(strtolower($menu['url']), 'http://') === 0 ) ? '_blank' : '') ?>" href="<?= (( strpos(strtolower($menu['url']), 'http://') === 0 || $menu['url'] == '#' ) ? '' : URL) . strtolower($menu['url']) ?>"><?= $menu['name'] ?></a>
                        <? if ($menu['menu_id'] == 2) { ?>
                            <ul class="submenu">
                                <li><a href="<?= URL ?>colaboradores/view/<?= $this->lang['ong'] ?>"><div><?= $this->lang['ong'] ?></div></a></li>
                                <li><a href="<?= URL ?>colaboradores/view/<?= $this->lang['donantes'] ?>"><div><?= $this->lang['donantes'] ?></div></a></li>
                                <li><a href="<?= URL ?>colaboradores/view/<?= $this->lang['empresas'] ?>"><div><?= $this->lang['empresas'] ?></div></a></li>
                            </ul>
                        <? } ?>
                        <? if ($menu['menu_id'] == 5) { ?>
                            <ul class="submenu">
                                <li><a href="<?= URL ?>page/view/<?= $this->lang['about'] ?>"><div><?= $this->lang['quien_somos'] ?></div></a></li>
                                <li><a href="<?= URL ?>page/view/<?= $this->lang['testimonios'] ?>"><div><?= $this->lang['testimonios'] ?></div></a></li>
                            </ul>
                        <? } ?>
                    </li><? } ?>
            </ul>
        </div>
        <div id="menuNav">
            <ul>
                <? foreach ($this->menu as $key => $menu) { ?><li class="primary">
                        <a target="<?= (( strpos(strtolower($menu['url']), 'http://') === 0 ) ? '_blank' : '') ?>" href="<?= (( strpos(strtolower($menu['url']), 'http://') === 0 || $menu['url'] == '#' ) ? '' : URL) . strtolower($menu['url']) ?>"><?= $menu['name'] ?></a>
                        <? if ($menu['menu_id'] == 2) { ?>
                            <ul class="submenu">
                                <li><a href="<?= URL ?>colaboradores/view/<?= $this->lang['ong'] ?>"><div><?= $this->lang['ong'] ?></div></a></li>
                                <li><a href="<?= URL ?>colaboradores/view/<?= $this->lang['donantes'] ?>"><div><?= $this->lang['donantes'] ?></div></a></li>
                                <li><a href="<?= URL ?>colaboradores/view/<?= $this->lang['empresas'] ?>"><div><?= $this->lang['empresas'] ?></div></a></li>
                            </ul>
                        <? } ?>
                        <? if ($menu['menu_id'] == 5) { ?>
                            <ul class="submenu">
                                <li><a href="<?= URL ?>page/view/<?= $this->lang['about'] ?>"><div><?= $this->lang['quien_somos'] ?></div></a></li>
                                <li><a href="<?= URL ?>page/view/<?= $this->lang['testimonios'] ?>"><div><?= $this->lang['testimonios'] ?></div></a></li>
                            </ul>
                        <? } ?>
                    </li><? } ?>
            </ul>
        </div><div id="logo">
            <a href="/"><img src="<?= URL ?>public/img/logo.png"></a>
        </div>
    </div>
</div>
<ul id="socialMediaMargin" class="socialIcons">
    <li>
        <a target="_blank" rel="http://www.facebook.com/sharer/sharer.php?u=<?= $this->share ?>"><div id="fb"></div></a>
    </li>
    <li>
        <a target="_blank" rel="http://twitter.com/intent/tweet?text=<?= $this->shareDesc ?>&url=<?= $this->share ?>"><div id="tw"></div></a>
    </li>
    <li>
        <a target="_blank" rel="https://plus.google.com/share?url=<?= $this->share ?>"><div id="gplus"></div></a>
    </li>
    <li>
        <a target="_blank" rel="http://pinterest.com/pin/create/button/?url=<?= $this->share ?>&media=<?= $this->shareImg ?>&description=<?= $this->shareDesc ?>"><div id="pinterest"></div></a>
    </li>
    <li>
        <a rel="http://www.tumblr.com/share/link?url=<?= urlencode($this->share )?>&name=<?= urlencode($this->shareName) ?>&description=<?= urlencode($this->shareDesc )?>"><div id="tumblr"></div></a>
    </li>
</ul>
<input id="signupCheck" type="checkbox" class="away">
<input id="loginCheck" type="checkbox"  class="away">
<input id="msgCheck" type="checkbox" class="away">
<div id="blackScreen"></div>
<div id="" class="splash-msg autoHide"></div>
<div id="splash-content" class="splash-signup autoHide">
    <? $this->signupForm->render('views/templates/signup-template.php', false, $this->lang); ?>
</div>
<div id="splash-content" class="splash-login autoHide">
    <? $this->loginForm->render('views/templates/login-template.php', false, $this->lang); ?>
</div>
<div id="wrapper">
    <div id="container" class="splash-head">
        <div id="searchBox"><form id="" class="" enctype="multipart/form-data" method="get" action="<?= URL ?>auction/search"><input type="text" name="search" placeholder="<?= $this->lang['search'] ?>"><input type="submit"></form></div>
        <div id="loginBox">            
            <?= (!Session::get('loggedIn')) ? '<label for="loginCheck">' . $this->lang['login'] . '</label> | <label for="signupCheck">' . $this->lang['signup'] . '</label>' : '<a href="' . URL . 'user/settings/">' . $this->lang['welcome'] . ' <span class="orange">' . $this->user['first_name'] . '</span></a> <span class="noMobil">&nbsp;&nbsp;&nbsp;</span><a class="noMobil" href="' . URL . 'user/settings/">' . $this->lang['my_account'] . '</a> <span class="noMobil">|</span> <a class="noMobil" href="' . URL . 'user/bids/">' . $this->lang['my_auctions'] . '</a> <span class="noMobil">|</span> <a class="noMobil" href="' . URL . 'user/favorites/">' . $this->lang['my_favorites'] . '</a> | <a href="' . URL . 'user/logout">' . $this->lang['logout'] . '</a>' ?>  | <span id="languageSel" href="' . URL . 'user/logout"><?=$this->_langList[strtolower(LANG)]?> <ul id="language"><?foreach($this->_langList as $key=>$lang){ if($key!=strtolower(LANG)){?><li><a href="<?=URL.$key.'/'.RUTE?>"><?=$lang?></a></li><?}}?></ul></span>
        </div>

        <? if ($this->getBreadcrumb() != '') { ?>
            <div id="breadcrumb-container">
                <div id="breadcrumb"><?= $this->getBreadcrumb() ?></div>
            </div>
        <? } ?>
    </div>

