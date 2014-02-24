<div id="header">
    <div id="menuNav">
        <ul>  
            <? foreach ($this->menu as $key => $menu) { ?><li><a href="<?= strtolower($menu['url']) ?>"><?= $menu['name'] ?></a></li><? } ?>
            <li class="desactivated"><a href="#">MARKET</a></li>
        </ul>
    </div>
    <div id="logo">
        <a href="/experience/home/<?= Session::get('destination') ?>"><img src="<?= URL ?>public/img/logo.png"></a>
    </div>
</div>
<div id="wrapper">
    <div id="container" class="splash-head">
        <label id="navCheckLabel" onclick="" for="navCheck"></label>
        <input id="navCheck" type="checkbox">
        <div id="splash-login"><?= (!Session::get('loggedIn')) ? '<label onclick="" for="menuCheck">LOGIN</label>' : '<a href="' . URL . 'user/profile">Welcome ' . Session::get('username') . '</a> | <a href="' . URL . 'user/logout">Logout</a>' ?>
            <input id="menuCheck" type="checkbox">

        </div>



        <div id="breadcrumb-container">
            <div id="breadcrumb"><?= $this->getBreadcrumb() ?></div>
        </div>
    </div>

