<div id="booking-wrapper">
    <div id="signup-box" class="booking-page">
        <h1>CONGRATULATIONS</h1>
        <h3>AN E-MAIL WAS SENT...</h3>
        <div class="separator"></DIV>
        <h2>DETAILS OF YOUR RESERVATION</h2>
        <div id="booking-detail-wrapper">
            <div id="splash-logo">
                <a href="/">
                    <img src="http://terrae.com.mialias.net/public/img/logo.png">
                </a>
                <div class="comefeel">COME & FEEL</div>
                <div class="subline"></div>
            </div>
            <br>
            <ul id="booking-detail-user">
                <li class="label">Fullname:</li><li class="data"><?= $this->user['first_name'] ?></li>
                <li class="label">Surname:</li><li class="data"><?= $this->user['last_name'] ?></li>
                <li class="jump"></li>
                <li class="label">E-mail:</li><li class="data"><?= $this->user['email'] ?></li>
                <li class="label">City:</li><li class="data"><?= $this->user['city'] ?></li>
                <li class="jump"></li> 
                <li class="label">Phone:</li><li class="data"><?= $this->user['phone'] ?></li>
                <li class="label">Country:</li><li class="data"><?= $this->user['country'] ?></li>
                <li class="jump"></li>
            </ul>
            <br>
            <ul id="booking-detail-amount">
                <li>
                    <ul class="title">
                        <li class="concept">CONCEPT</li><li class="checkin">CHECK IN</li><li class="checkout">CHECK OUT</li><li class="places">Nº PLACES</li><li class="amount">AMOUNT</li>
                    </ul>
                </li>
                <li class="line"></li>
                <? $total = 0;
                foreach ($this->rooms as $booking) {
                    $total+=$booking['price']; ?>
                    <li>
                        <ul class="data">
                            <? if (!isset($_POST['giftType'])) { ?>
                                <li class="concept"><?= $booking['name'] ?> - <?= $booking['room_type'] ?></li><li class="checkin"><?= $this->lang[date('l', strtotime($booking['checkin_date']))]; ?>, <?= Model::getTime($booking['checkin_date']) ?></li><li class="checkout"><?= $this->lang[date('l', strtotime($booking['checkout_date']))]; ?>, <?= Model::getTime($booking['checkout_date']) ?></li><li class="places"><?= $booking['max_adults'] ?> Adult   <?= $booking['max_children'] ?> Children</li><li class="amount"><?= $booking['price'] ?> €</li>
                            <? } ?>
                            <? if (isset($_POST['giftType'])) { ?>
                                <li class="concept"><?= $booking['name'] ?></li><li class="checkin"><?= '-' ?></li><li class="checkout"><?='-'?></li><li class="places"><?='-' ?></li><li class="amount"><?= $booking['price'] ?> €</li>
                            <? } ?>
                        </ul>
                    </li><? } ?>
                <li class="total">TOTAL AMOUNT: <?= $total ?> €</li>
            </ul>
        </div>
        <div id="booking-detail-more">
            <div id="need-more">NEED TO FEEL MORE?</div>
            <a href="<?= URL ?>experience/" class="booking-more-feel" id="experiences"></a>
            <a href="<?= URL ?>accommodation/"  class="booking-more-feel" id="accommodation"></a>
            <a href="<?= URL ?>gift/"  class="booking-more-feel" id="gift"></a>
            <a href="#"  class="booking-more-feel" id="market"></a>
        </div>
        <div id="booking-detail-print-box">
            <a href="#"  value="Print this page" onClick="window.print()" class="booking-more-feel" id="print"></a>
            <a href="<?= URL ?>user/bookingPDF/8MRGZ0P3LB"  class="booking-more-feel" id="pdf"></a>
        </div>
    </div>