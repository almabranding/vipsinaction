


<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<?= $accounttype ?>
<style>
    ul li{margin: 10px 0;}
#algunaDuda{
        float: right;
    position: relative;
    right: 20px;}</style>
<ul><li class="row">
        <?php echo $label_deseo . $deseo ?>
    </li>
    <li class="row" style="width: 25%;display:inline-block;vertical-align: top">
        <?php echo $label_donacion . $donacion ?>
    </li><li class="row" style="width: 75%;display:inline-block;text-align: right;;vertical-align: top">
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
        <?php echo $label_nombre . $nombre ?>
    </li><li class="row" style="width: 60%;display:inline-block;text-align: right;">
        <div style="width: 90%;margin-left: 9%;"><?php echo $label_email . $email ?></div>
    </li>
    <li class="row" style="width: 60%;">

    </li>
    <br>
    <li class="row last">
        <?php echo $extra_acuerdo . $label_extra_acuerdo ?>
    </li><li class="row last">
        <?php echo $_btnsubmit ?>
        
    </li>
</ul>
<div id="algunaDuda">
    <a class="link" href="http://temp.vipsinaction.com/faq">
        <div class="q-button">?</div>
        <?= $this->variables['alguna_duda'] ?>
    </a>
</div>
<div class="clear"></div>


