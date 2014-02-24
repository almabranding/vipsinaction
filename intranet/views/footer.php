</div></div>
</div>

<!--        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--        <script src="<?php //echo URL; ?>public/js/jquery.min.js"></script>-->
        
        <script src="<?php echo URL; ?>public/js/jquery.Jcrop.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.filedrop.js"></script>
        <script src="<?php echo URL; ?>public/js/HTML5script.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>tinymce/tinymce.min.js"></script>
        <script src="<?php echo URL; ?>public/js/custom.js"></script>

        <?php
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script src="' . URL . 'views/' . $js . '"></script>';
            }
        }
        ?>
</body>
</html>