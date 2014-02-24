

<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<style type="text/css">
    .Zebra_Form .optional { padding: 10px 50px; display: none }
</style>

<!--
    again, in reality you'd have this in an external JavaScript file;
    i am using it like this for the sake of the example
-->

<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>

<?=$accounttype ?>
<div id="signup-box">
<ul>
<li class="row">
    <?php echo $label_firstname . $firstname ?>
</li>
<li class="row even">
    <?php echo $label_lastname. $lastname?>
</li>
<li class="clear"></li>
<li class="row">
    <?php echo $label_email . $email ?>
</li>
<li class="row even" id="phone">
    <?php echo $label_phone . $phone ?>
</li>
<li class="row">
    <?php echo $label_year . $year ?>
</li>
<li class="clear"></li>
<li class="row even">
    <?php echo $label_city . $city ?>
</li>
<li class="row even">
    <?php echo $label_country . $country ?>
</li>
<li class="clear"></li>
<li class="row even">
    <?php echo $label_password . $password ?>
</li>
<li class="row even">
    <?php echo $label_confirm_password . $confirm_password ?>
</li>

</ul>

<div class="clear"></div>
</div>
<div class="row last"><?php echo $_btnsubmit ?></div>

