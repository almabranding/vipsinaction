<section id="bid-content">
    <h2><?= $this->variables['personal_data'] ?></h2>
    <p><?= $this->variables['confirmacion_puja_text'] ?></p>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?= (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
    <?= $accounttype ?>
    <style>
        ul li{margin: 10px 0;}
        #algunaDuda{
            float: right;
            position: relative;
            right: 20px;
        }
    </style>

    <ul>
        <li class="row card_saved" style="">
            <div style="width: 90%;">
                <?= $label_cardsaved ?>
                <div class="styled-select">
                    <div class='arrow'></div>
                    <?= $cardsaved ?>
                </div>  
            </div>
        <li class="row card_holder" style="">
            <?= $label_cardholder . $cardholder ?>
        <li class="clear"></li>
        <li class="row card_type" style="">
            <div style="width: 90%;">
                <?= $label_cardtype ?>
                <div class="styled-select">
                    <div class='arrow'></div>
                    <?= $cardtype ?>
                </div>  
            </div>

        <li class="row card_number">
            <?= $label_cardnumber . $cardnumber ?>

        <li class="row card_expire">
            <?= $label_expire ?>
            <div class="expire_box">
                <div class="styled-select">
                    <div class='arrow'></div><?= $month ?>
                </div>
            </div><div class="expire_box">
                <div class="styled-select">
                    <div class='arrow'></div><?= $year ?>
                </div>
            </div>
        <li class="row card_cvv">
            <?= $label_cvv . $cvv ?>
        <li class="row">
            <p><?= $this->variables['casilla_guardar_card'] ?></p>
        <li class="row card_name">
            <?= $label_card_name . $card_name ?>
        <li class="row save_card">
            <?= $card_save_card . $label_card_save_card ?>
    </ul>   
</section>
<div class="colaboradores-separator"></div>
<section id="bid-content">

    <ul>
        <li class="row confirm">

            <h2><?= $this->variables['confirma'] ?></h2>
            <?= $this->variables['indicado_desea_pujar'] ?>: <span style="font-weight: bold"><?= $_GET['bid'] ?>€</span><br><br>
            <?= $extra_acuerdo . $label_extra_acuerdo ?>
        <li class="row submitLi">
            <?= $_btnsubmit ?>
    </ul>
</section>
<script>
    $('#confirmBid').on('submit', function() {
        $('.inputRed').removeClass('inputRed');
        var correct = false;
        if ($('#cardnumber').length) {
            if ($('#cardnumber').val() !== '') {
                $('#cardnumber').validateCreditCard(function(result) {
                    if (result.luhn_valid && result.luhn_valid)
                        correct = true;
                    if (result.card_type !== null)
                        if ($('#cardtype').val() !== result.card_type.name)
                            correct = false;
                }, {
                    accept: ['visa', 'mastercard']
                });
            }
            if (!correct)
                $('#cardnumber').addClass('inputRed');
            return correct;
        }
        return true;
    });
    $('#cardsaved').on('change', function() {
        var cardsaved = $('#cardsaved').val();
        console.log(cardsaved);
        window.location.href = '<?= URL ?>auction/bid?auction_id=<?= $_GET['auction_id'] ?>&user_id=<?= $_GET['user_id'] ?>&bid=<?= $_GET['bid'] ?>&card=' + cardsaved;
    });
</script>
