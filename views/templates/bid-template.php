    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?= (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
    <?= $accounttype ?>
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
    $('#_btnsubmit').attr('disabled','disabled')
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
