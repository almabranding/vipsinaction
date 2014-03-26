</div>
<div id="footer">
    <div id="wrapper">
        <div id="container">
            <ul class="footer-list">
                <li>
                    <h1>VIPSENACCIÓN</h1>
                    <ul class="footer-list-a">
                        <li><a>Testimoniales</a></li>
                        <li><a>Equipo</a></li>
                        <li><a>FAQs</a></li>
                    </ul>
                </li><li>
                    <h1>COLABORA CON NOSOTROS</h1>
                    <ul class="footer-list-a">
                        <li><a>Testimoniales</a></li>
                        <li><a>Equipo</a></li>
                        <li><a>FAQs</a></li>
                    </ul>
                </li><li>
                    <h1>CONTACTA CON NOSOTROS</h1>
                    <ul class="footer-list-a">
                        <li><a>Oficinas en Barcelona</a></li>
                        <li><a>Oficinas en Madrid</a></li>
                    </ul>
                </li><li>
                    <h1>SUBSCRÍBETE A NUESTRA<br> NEWSLETTER</h1>
                    <form><input type="text"><input type="submit" style="display: none;"></form>
                    <ul class="socialIcons">
                        <li>
                            <a href="#"><div id="fb"></div></a>
                        </li>
                        <li>
                            <a href="#"><div id="tw"></div></a>
                        </li>
                        <li>
                            <a href="#"><div id="gplus"></div></a>
                        </li>
                        <li>
                            <a href="#"><div id="pinterest"></div></a>
                        </li>
                        <li>
                            <a href="#"><div id="tuenti"></div></a>
                        </li>
                        <li>
                            <a href="#"><div id="in"></div></a>
                        </li>
                        <li>
                            <a href="#"><div id="instagram"></div></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="privacy">
                © 2014 Vipsenaccion SL. Todos los derechos reservados | <a href="#">Política de privacidad</a>
            </div>
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