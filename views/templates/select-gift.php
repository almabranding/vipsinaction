


<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!--
    again, in reality you'd have this in an external JavaScript file;
    i am using it like this for the sake of the example
-->

<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<div id="gift-wrapper">
     <ul id="gift-types">
<?foreach($this->variables['view']->gift as $gift){?>
         <li style="color:<?=$gift['color']?>"><div class="box"> <input id="gift_<?=$gift['gift_id']?>" type="radio" name="giftType" value="<?=$gift['gift_id']?>"></div><label for="gift_<?=$gift['gift_id']?>" class="desc content"><span class="title uppercase"><?=$this->variables['view']->lang['card?'].' '.$gift['name']?> (<?=$gift['price']?> €)</span><br><?=$gift['content']?></label></li>
<?}?>
</ul>  
</div>
<div id="signup-box">
    <p class="title"><?=$this->variables['view']->lang['FOR WHOM IS THE GIFT?']?> </p><br><br>
<ul>
<li class="row name">
    <?php echo $label_first_name . $first_name ?>
</li>
<li class="row even name">
    <?php echo $label_last_name. $last_name?>
</li>
<li class="clear"></li>
<li class="row email">
    <?php echo $label_email . $email ?>
</li>
<li class="clear"></li>
<li class="row even message">
    <?php echo $label_message . $message ?>
</li>
</ul>

<div class="clear"></div>
</div>
<div class="row"><?php echo $_btnsubmit ?></div>

