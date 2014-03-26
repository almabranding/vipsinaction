

<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<style type="text/css">
    .Zebra_Form .optional {display: none }
</style>

<script type="text/javascript">
    var mycallback = function(value, segment) {
        $segment = $('.optional' + segment);
        if (value)
            $segment.css('display', 'inline-block');
        else
            $segment.hide();
    }
   
   
</script>

<div>
    <label for="signupCheck" class="xLogo">x</label>
    <?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>

    <h1><?= $this->variables['personal_data'] ?></h1>
    <div id="user-image">
        <div class="user-img"> <img class='full' src="<?= UPLOAD . Model::getRouteImg($this->variables['user']['img_date']) .'thumb_250x250_'. $this->variables['user']['file_name'] ?>"></div>
        <label for="user-file">+ <?= $this->variables['lang']['upload_picture'] ?></label><input id="user-file" type="file" name="user-file" class="user-file">
        <ul class="user-options">
            <li>
                <a class="link" href="<?=URL?>user/bids"><div class="q-button">+</div>
                <?= $this->variables['lang']['see_auctions'] ?></a>
            <li>
                <a class="link" href="<?=URL?>user/favorites"><div class="q-button">+</div>
                <?= $this->variables['lang']['see_favorites'] ?></a>
            <li>
                <a class="link" href="<?=URL?>faq"><div class="q-button">?</div>
                <?= $this->variables['lang']['any_duda'] ?></a>
        </ul>
    </div><div id="user-form">
        <ul><li class="row">
                <?php echo $label_email . $email ?>
                <span id="error_1" class="orange error" style="display: none;"><?= $this->variables['lang']['mail_existe'] ?></span>
            </li>
            <li class="row">
                <?php echo $label_firstname . $firstname ?>
            </li>
            <li class="row even">
                <?php echo $label_lastname . $lastname ?>
            </li>
            <li class="clear"></li>
            <li class="row">
                <?php echo $label_nick . $nick ?>
                <span id="error_2" class="orange error" style="display: none;"><?= $this->variables['lang']['nick_existe'] ?></span>
            </li>
            <li class="clear"></li>

            <li class="row even" id="phone">
                <?php echo $label_phone . $phone ?>
            </li>
            <li class="row even">
                <?php echo $label_user_password . $user_password ?>
            </li>
            <li class="row even">
                <?php echo $label_confirm_password . $confirm_password ?>
            </li>
        </ul>
    </div>
    <h1 style="margin-top:30px;"><?= $this->variables['lang']['address'] ?></h1>
    <ul>
        <li class="row even">
            <?php echo $label_add_street . $add_street ?>
        </li>
        <li class="row even number">
            <?php echo $label_add_number . $add_number ?>
        </li>
        <li class="row even number">
            <?php echo $label_add_flat . $add_flat ?>
        </li>
        <li class="row even number">
            <?php echo $label_add_door . $add_door ?>
        </li>
        <li class="row even number">
            <?php echo $label_add_stairs . $add_stairs ?>
        </li>
        <li class="row even zipcode">
            <?php echo $label_add_zip . $add_zip ?>
        </li>
        <li class="row even city">
            <?php echo $label_add_city . $add_city ?>
        </li>

        <li class="row even leftAlign" style="margin:20px 0;">
            <?php echo $bill_1 . $label_bill_1 ?>
        </li>
    </ul>
    <ul class=" optional optional1">
        <li><h1  style="margin-top:10px;"><?= $this->variables['lang']['fact_address'] ?></h1></li>
        <li class="row even street">
            <?php echo $label_bill_street . $bill_street ?>
        </li>
        <li class="row even number">
            <?php echo $label_bill_number . $bill_number ?>
        </li>
        <li class="row even number">
            <?php echo $label_bill_flat . $bill_flat ?>
        </li>
        <li class="row even number">
            <?php echo $label_bill_door . $bill_door ?>
        </li>
        <li class="row even number">
            <?php echo $label_bill_stairs . $bill_stairs ?>
        </li>
        <li class="row even zipcode">
            <?php echo $label_bill_zip . $bill_zip ?>
        </li>
        <li class="row even city">
            <?php echo $label_bill_city . $bill_city ?>
        </li>
    </ul>
    <ul>
        <li class="row even leftAlign"  style="margin:20px 0 0;">
            <?php echo $news_1 . $label_news_1 ?>
        </li>
        <li class="row last" style='text-align:right;'>
            <?php echo $_btnsubmit ?>
        </li>
    </ul>
    <div class="clear"></div>
</div>

