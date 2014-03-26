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
                    </li><? } ?>
            </ul>
        </div><div id="logo">
            <a href="/"><img src="<?= URL ?>public/img/logo.png"></a>
        </div>
    </div>
</div>
<div id="wrapper">
    <div id="container" class="splash-head">
        <div id="searchBox"><form id="" class="" enctype="multipart/form-data" method="get" action="<?= URL ?>auction/search"><input type="text" name="search" placeholder="<?= $this->lang['search'] ?>"><input type="submit" style="display: none;"></form></div>
        <div id="loginBox">            
            <?= (!Session::get('loggedIn')) ? '<label for="loginCheck">' . $this->lang['login'] . '</label> / <label for="signupCheck">' . $this->lang['signup'] . '</label>' : '<a href="' . URL . 'user/settings/' . $this->user['nick'] . '">' . $this->lang['welcome'] . ' ' . $this->user['first_name'] . '</a> | <a href="' . URL . 'user/logout">' . $this->lang['logout'] . '</a>' ?>
        </div>
        <input id="signupCheck" type="checkbox" class="away">
        <input id="loginCheck" type="checkbox"  class="away">
        <input id="msgCheck" type="checkbox" class="away">
        <div id="splash-content" class="splash-msg">
            <? include('views/templates/msg-template.php'); ?>
        </div>
        <div id="splash-content" class="splash-signup">
            <? $this->signupForm->render('views/templates/signup-template.php', false, $this->lang); ?>
        </div>
        <div id="splash-content" class="splash-login">
            <? $this->loginForm->render('views/templates/login-template.php', false, $this->lang); ?>
        </div>
        <? if ($this->getBreadcrumb() != '') { ?>
            <div id="breadcrumb-container">
                <div id="breadcrumb"><?= $this->getBreadcrumb() ?></div>
            </div>
        <? } ?>
    </div>

