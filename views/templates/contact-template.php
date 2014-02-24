

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
<div id="signup-box" class="contact-form">
    <h1>CONTACT FORM</h1>
    <h3>*ALL FIELDS ARE REQUIRED</h3>
    <div class="separator"></DIV>
    <h2>PERSONAL DETAILS</h2>
    <div class="separator"></DIV>
<ul>
<li class="row">
    <?php echo $label_company . $company ?>
</li>
<li class="row even">
    <?php echo $label_name. $name?>
</li>
<li class="clear"></li>
<li class="row">
    <?php echo $label_email . $email ?>
</li>
<li class="row even" id="phone">
    <?php echo $label_phone . $phone ?>
</li>
<li class="clear"></li>
<li class="row even">
    <?php echo $label_city . $city ?>
</li>
<li class="row even" id="country">
    <?php echo $label_country . $country ?>
</li>
<li class="clear"></li>
<li class="row even" id="terms">
    <?php echo '<div>'.$terms_1.'</div>' .$label_terms?>
</li>
</ul>

<div class="clear"></div>
</div>
<div id="contact-request">
    <?php echo $label_request . $request ?>
</div>
<div class="row last"><?php echo $_btnsubmit ?></div>

