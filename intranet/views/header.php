<body>
        <?php Session::init();
        $strNoCache = "?nocache=".time();
        ?>
            <header>
                <div class="header_logo">
                    <div class="wrapper">
                    <a href="<?=URL; ?>"><div id="logo"><img src="<?=WEB?>/public/img/logo.png"></div></a>
                    <div class="header_login"></div>
                    </div>
                </div> 
                <nav class="header_menu" id="sidebarnav">
                    <div class="wrapper">
                    <ul id="menuNav">
                        <? if ($_SESSION[INSTALLATION_KEY]['session_account_type'] == 'owner') { ?><li><a href="<?=URL; ?>home/lista">home</a></li><? } ?>
                        <? if ($_SESSION[INSTALLATION_KEY]['session_account_type'] == 'owner') { ?><li><a href="<?=URL; ?>pages/lista">pages</a></li><? } ?>
                        <? if ($_SESSION[INSTALLATION_KEY]['session_account_type'] == 'owner') { ?><li><a href="<?=URL; ?>gift/lista">gift</a></li><? } ?>
                        <? if ($_SESSION[INSTALLATION_KEY]['session_account_type'] == 'owner') { ?><li><a href="<?=URL; ?>suggestions/lista">suggestions</a></li><? } ?>
                        <? if ($_SESSION[INSTALLATION_KEY]['session_account_type'] == 'owner') { ?><li><a href="<?=URL; ?>banner/lista">banner</a></li><? } ?>
                        <? if ($_SESSION[INSTALLATION_KEY]['session_account_type'] == 'owner') { ?><li><a href="<?=URL; ?>menu">menu</a></li><? } ?>
                        <li><a href="<?=URL?>booking">hotel</a></li>
                    </ul>
                    <ul id="langNav">
                        <li style="border-right: 1px solid #cccccc;"><a href="<?=WEB?>" target="_blank">View site</a></li>
                        <li><a onClick="location.href = '<?= URL . 'login/out'; ?>'">Logout</a></li>
              
                    </ul>
                    </div>
                </nav>
                <div class="header_shadow"></div>
            
            </header>
        <div id="wrapper">
            
            <div id="mainarea">
                <div class="white_full hide" id="white_full" onclick="$('.hide').css('display', 'none')"></div>
                <div id="container">

