</div>
<div id="footer">
    <div id="wrapper">
        <div id="container">
            <ul class="footer-list">
                <li>
                    <h1>MYCAUSA</h1>
                    <ul class="footer-list-a">
                        <li><a href="<?=URL?>page/view/about"><?=$this->lang['about_us']?></a></li>
                        <li><a href="<?=URL?>faq"><?=$this->lang['preg_freq']?></a></li>
                    </ul>
                </li><li>
                    <h1><?=$this->lang['col.w.US']?></h1>
                    <ul class="footer-list-a">
                        <li><a href="<?=URL?>page/view/contact"><?=$this->lang['eres_ong']?></a></li>
                        <li><a href="<?=URL?>page/view/contact"><?=$this->lang['eres_donante']?></a></li>
                        <li><a href="<?=URL?>page/view/contact"><?=$this->lang['eres_empresa']?></a></li>
                        <li><a href="<?=URL?>page/view/contact"><?=$this->lang['Contactanos']?></a></li>
                    </ul>
                </li><li>
                    <h1><?=$this->lang['APARTADOS']?></h1>
                    <ul class="footer-list-a">
                        <li><label style="cursor: pointer;" for="signupCheck"><?=$this->lang['Regístrate']?></label></li>
                        <li><a href="<?=URL?>page/view/gift"><?=$this->lang['Regalo']?></a></li>
                        <li><a href="<?=URL?>page/view/crowdfunding"><?=$this->lang['Crowdfounding']?></a></li>
                    </ul>
                </li><li>
                    <h1><?=$this->lang['subscribete_a_nuestra']?><br> <?=$this->lang['newslettter']?></h1>
                    <form enctype="multipart/form-data" method="post" action="<?=URL?>user/newsletter" name="contactForm"><input type="text" name="email"><input type="submit" style="display: none;"></form>
                    <ul class="socialIcons">
                        <li>
                            <a target="_blank" href="https://www.facebook.com/pages/mycausacom/1390973194512137"><div id="fb"></div></a>
                        </li>
                        <li>
                            <a target="_blank" href="https://twitter.com/mycausa"><div id="tw"></div></a>
                        </li>
                        <li>
                            <a target="_blank" href="#"><div id="gplus"></div></a>
                        </li>
                        <li>
                            <a target="_blank" href="http://www.pinterest.com/mycausa/"><div id="pinterest"></div></a>
                        </li>
                        <li>
                            <a target="_blank" href="http://mycausa.tumblr.com/"><div id="tumblr"></div></a>
                        </li>
                        <li>
                            <a target="_blank" href="#"><div id="in"></div></a>
                        </li>
                        <li>
                            <a target="_blank" href="#"><div id="instagram"></div></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="privacy">
                © 2014 Mycausa SL. <?=$this->lang['derechos_reservados']?> | <a href="#"><?=$this->lang['politica_privacidad']?></a>
            </div>
        </div>
    </div>  
</div>  
<script>
var lng="<?=LANG?>";
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="<?= URL; ?>public/js/custom.js"></script>
<script src="<?= URL; ?>public/js/mobile.js"></script>
<script src="<?= URL; ?>public/js/zebra_form.js"></script>
<script src="<?= URL; ?>public/js/html2canvas.js"></script>

<?php
if (isset($this->js))
    foreach ($this->js as $js)
        echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
?>
</body>
</html>