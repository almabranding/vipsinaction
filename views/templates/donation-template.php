


<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<?= $accounttype ?>
<style>
    ul li{margin: 10px 0;}
#algunaDuda{
        display: inline-block;
    position: relative;
    text-align: right;
    vertical-align: middle;
    width: 50%;
    margin-bottom: 0px;
}
</style>
<ul><li class="row">
        <?php echo $label_deseo . $deseo ?>
    </li>
    <li class="row" style="width: 29%;display:inline-block;vertical-align: top">
        <?php echo $label_donacion . $donacion ?>
    </li><li class="row" style="width: 71%;display:inline-block;text-align: right;;vertical-align: top">
        <div style="width: 90%;margin-left: 9%;">
            <?php echo $label_ong ?>
            <div class="styled-select">
                <div class='arrow'></div>
                <?php echo $ong ?>
            </div>  
        </div>
    </li>
    <li class="clear"></li>
    <li class="row" style="width: 40%;display:inline-block">
        <?php echo $label_name . $name ?>
    </li><li class="row" style="width: 60%;display:inline-block;text-align: right;">
        <div style="width: 90%;margin-left: 9%;"><?php echo $label_email . $email ?></div>
    </li>
    <li class="row" style="width: 60%;">

    </li>
    <br>
    <li class="row last">
        <?php echo $extra_acuerdo . $label_extra_acuerdo ?>
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


