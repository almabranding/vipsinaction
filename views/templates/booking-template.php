<?
$total = 0;
?>

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

<?= (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<ul>
    <input type="hidden" value="<?= $total ?>" name="price">
    <li class="row">
        <?= $label_first_name . $first_name ?>
    </li>
    <li class="row even">
        <?= $label_last_name . $last_name ?>
    </li>
    <li class="clear"></li>
    <li class="row">
        <?= $label_email . $email ?>
    </li>
    <li class="row even">
        <?= $label_phone . $phone ?>
    </li>
    <li class="clear"></li>
    <li class="row even">
        <?= $label_city . $city ?>
    </li>
    <li class="row even">
        <?= $label_country . $country ?>
    </li>
</ul>

<div class="clear"></div>
<?
if (isset($_POST['gift'])) {
    echo '<div class="separator"></DIV>
        <h2><span class="uppercase">'.$this->variables['view']->lang['confirm your reservation'].'</span> '.$this->variables['view']->lang['with your Gift Code'].'</h2>
        <div class="separator"></DIV>';
    echo '<ul><li class="row">' . $label_giftcode . $giftcode . '</li></ul>';
} else {
    ?>
    <div class="separator"></DIV>
    <h2><span class="uppercase"><?=$this->variables['view']->lang['confirm your reservation']?></span> <?=$this->variables['view']->lang['with your Credit Card']?></h2>
    <div class="separator"></DIV>

    <ul id="cardData">
        <li class="row fullInput">
            <?= $label_cardholder . $cardholder ?>
        </li>
        <li class="row even fullInput">
            <?= $label_cardnumber . $cardnumber ?>
        </li>
        <li class="clear"></li>
        <li class="row">
            <?= $label_cardtype ?>
            <div class="styled-select-box cardType" >
                <div class="styled-select"><?= $cardtype ?></div>
            </div>
        </li>
        <li class="row even">
            <?= $label_expire ?>
            <div class="styled-select-box">
                <div class="styled-select"><?= $month ?></div>
            </div>
        </li>
        <li class="row even">
            <div class="styled-select-box">
                <div class="styled-select"><?= $year ?></div>
            </div>
        </li>
        <li class="row even cvv">
            <?= $label_cvv . $cvv ?>
        </li>
    </ul>
<? } ?>
</div>
<div id="signup-box" class="booking-detail">
    <h1 class="uppercase"><?=$this->variables['view']->lang['summari']?></h1>
    <h2 class="uppercase"><?=$this->variables['view']->lang['of your reservation']?></h2>
    <? if (!isset($_POST['giftType'])) { ?>
        <div class="img"><img class="full" src="<?= $this->variables['view']->rooms[key($this->variables['view']->rooms)]['hotel_image'] ?>"></div>
        <div class="info">
            <h1 class="title"><? ($this->variables['view']->rooms[0]['name'] != '') ? $this->variables['view']->rooms[0]['name'] : '' ?></h1>
            <ul class="listHotels">
                <? foreach ($this->variables['view']->rooms as $id => $room) { ?><li>
                        <? $total+=$room['price'] * $room['rooms']; ?>
                        <input type="hidden" name="checkin" value="<?= $room['checkin_date'] ?>">
                        <input type="hidden" name="checkout" value="<?= $room['checkout_date'] ?>">
                        <input type="hidden" name="hotel_id" value="<?= $room['hotel_id'] ?>">
                        <input type="hidden" name="room_id[]" value="<?= $room['room_id'] ?>">
                        <input type="hidden" name="room_type[<?= $room['room_id'] ?>]" value="<?= $room['room_type'] ?>">
                        <h2 class="title"><?= $this->variables['view']->rooms[$id]['name'] . ' - ' . $room['room_type'] ?></h2>
                        <ul class="box">
                            <li><div class="attr uppercase"><?=$this->variables['view']->lang['check in']?>:</div><div class="value"><?= $this->variables['view']->lang[date('l', strtotime($room['checkin_date']))]; ?> , <?= Model::getTime($room['checkin_date']) ?></div></li>
                            <li><div class="attr uppercase"><?=$this->variables['view']->lang['check out']?>:</div><div class="value"><?= $this->variables['view']->lang[date('l', strtotime($room['checkout_date']))]; ?> , <?= Model::getTime($room['checkout_date']) ?></div></li>
                            <li><div class="attr uppercase"><?=$this->variables['view']->lang['Nplaces']?>:</div><div class="value capitalize"><?= $room['max_adults'] ?> <?=$this->variables['view']->lang['adults']?>   <?= $room['max_children'] ?> <?=$this->variables['view']->lang['children']?></div></li>
                        </ul>
                    </li><? } ?>
            </ul>
            <? if (!isset($_POST['gift'])) { ?>
                <div class="boxTransparent"><?=$this->variables['view']->lang['Total amount']?>:<span class="price"><?= $total ?> € </span>
                    <div class="vat"><?=$this->variables['view']->lang['vat included']?></div>   
                </div>

                <div class="box"><?=$this->variables['view']->lang['best price guaranteed by Terrae']?></div>
            <? } ?>
        </div>
    <? } ?>
    <? if (isset($_POST['giftType'])) {
        $total = $this->variables['view']->giftInfo['price']; ?>
        <div class="info">
            <h2 class="title uppercase"><?= ($this->variables['view']->giftInfo['name'] != '') ? $this->variables['view']->giftInfo['name'] : '' ?></h2>
            <ul class="box">
                <li><div class="attr capitalize"><?=$this->variables['view']->lang['for']?>For:</div><div class="value"><?= $this->variables['view']->giftInfo['rec_first_name'] . ' ' . $this->variables['view']->giftInfo['rec_last_name'] ?></div></li>
                <li><div class="attr capitalize"><?=$this->variables['view']->lang['email']?>:</div><div class="value"><?= $this->variables['view']->giftInfo['rec_email'] ?></div></li>
                <li><div class="attr capitalize"><?=$this->variables['view']->lang['message']?>Message:</div><div class="value"><?= $this->variables['view']->giftInfo['rec_message'] ?></div></li>
            </ul>
        </div>
<? } ?>
</div>
<? if (!isset($_POST['gift'])) { ?>
    <div class="booking-resume">
        <div class="title"><h1><?=$this->variables['view']->lang['Your reservation']?>:</h1><h2 class="uppercase"><?=$this->variables['view']->lang['charge on card']?></h2></div><div class="price"><?= $total ?>€ <span class="vat"><?=$this->variables['view']->lang['vat included']?></span></div>
    </div>
<? } ?>
</div>

<div id="contact-request">
<?php echo $label_request . $request ?>
</div>
<div class="row last"><?= $_btnsubmit ?></div>
<script>
    $('#bookingForm').on('submit', function() {
        var correct = false;
        if ($('#cardnumber').val() !== '') {
            $('#cardnumber').validateCreditCard(function(result) {
                if (result.luhn_valid && result.luhn_valid)
                    correct = true;
                if ($('#cardtype').val() != result.card_type.name)
                    correct = false;
            }, {
                accept: ['visa', 'mastercard']
            });
        }
        if (!correct)
            $('#cardnumber').addClass('inputRed');
        $('#cardData input').each(function() {
            if ($(this).val() === '') {
                $(this).addClass('inputRed');
                correct = false;
            }
        });
        $('#cardData select').each(function() {
            if ($(this).val() === '') {
                $(this).parents('.styled-select-box').addClass('inputRed');
                correct = false;
            }
        });
        return correct;
    });
</script>
