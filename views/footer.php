</div>
<div id="footer">
    <div id="wrapper">
        <div id="container">
            <ul class="footer-list">
                <li>
                    <h1>ABOUT US</h1>
                    <p>Aborem quiat rem siti ditiassita eles voluptur, corporum iliberf eruptia vent, quibus, ommost andam harum quaspictus nonestecto est ium liquae secta soluptus di quo eatem qui officta tquias idelis magnamuscidi sinus doluptis dus, sequi odis miliq</p>
                    <p><a>Read more</a></p>
                </li><li>
                    <h1>ACCOMMODATION</h1>
                    <ul class="footer-list-a">
                        <li><a>Rurales</a></li>
                        <li><a>Historicos</a></li>
                        <li><a>Agricolas</a></li>
                        <li><a>Superior</a></li>
                    </ul>
                </li><li>
                    <h1>GIFT</h1>
                    <a>SUGGESTION GIF</a>
                </li><li>
                    <h1>NEWSLETTER</h1>
                    <a>SINGUP FOR RECIVE <br>
                        OUR OFFERS</a>
                </li><li class="footerlogo">
                    <p><span style="font-size: 36px;font-family: 'Gotham';font-weight: bold;color:#ffffff;">TERRAE</span><br>
                        C/ Miguel Grau 329, Piazenza. Italia ©</p>
                </li><li>
                    <h1>EXPERIENCES</h1>
                    <ul class="footer-list-a">
                        <li><a>Saborea</a></li>
                        <li><a>Crea</a></li>
                        <li><a>Recuerda</a></li>
                        <li><a>Explora</a></li>
                    </ul>
                </li>
                <li>
                    <h1>CONTACT</h1>
                    <ul class="footer-list-a">
                        <li><a>CONTACT PARTNERS</a></li>
                        <li><a>CONTACT CLIENTS</a></li>
                    </ul>
                </li><li>
                    <h1>SHARE</h1>
                    <ul class="socialIcons">
                        <li>
                            <a><div id="gp"></div></a>
                        </li>
                        <li>
                            <a><div id="tw"></div></a>
                        </li>
                        <li>
                            <a><div id="fb"></div></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>  
</div>  
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