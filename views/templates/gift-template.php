


<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<?=$accounttype ?>
<style>
    #giftForm li{margin: 20px 0;}
    #algunaDuda{
        display: inline-block;
    position: relative;
    text-align: right;
    vertical-align: middle;
    width: 50%;
    margin-bottom: 0px;
}
</style>
<ul id='giftForm'><li class="row">
    <?php echo $label_deseo . $deseo ?>
</li>
<li class="row" style="width: 40%;display:inline-block">
    <?php echo $label_donacion. $donacion ?>
</li><li class="row" style="width: 60%;display:inline-block;text-align: right;">
    <div style="width: 80%;margin-left: 19%;"><?php echo $label_email. $email ?></div>
</li>
<li class="clear"></li>

<li class="row" style="width: 60%;">
    <?php echo $label_name . $name ?>
</li>
<br>
<?=$this->variables['donacion_text']?>
<br>
<li class="row last">
    <?php echo  $extra_acuerdo.$label_extra_acuerdo ?>
</li><li class="row last" style="width: 50%;display: inline-block;">
        <?php echo $_btnsubmit ?>
        
    </li><li id="algunaDuda">
    <a class="link" href="<?=URL?>faq">
        <div class="q-button">?</div>
        <?= $this->variables['alguna_duda'] ?>
    </a>
</li>
</ul>

<div class="clear"></div>


