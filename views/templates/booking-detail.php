<!DOCTYPE html>
<html>
    <body>
<div id="booking-wrapper">
    <div id="signup-box" class="">
        <h1>CONGRATULATIONS</h1>
        <h3>AN E-MAIL WAS SENT...</h3>
        <div class="separator"></DIV>
        <h2>DETAILS OF YOUR RESERVATION</h2>
        <div class="separator"></DIV>
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
                <li class="label">Fullname:</li><li class="data"><?=$user['first_name']?></li>
                <li class="label">Surname:</li><li class="data"><?=$user['last_name']?></li>
                <li class="jump"></li>
                <li class="label">E-mail:</li><li class="data"><?=$user['email']?></li>
                <li class="label">City:</li><li class="data"><?=$user['city']?></li>
                <li class="jump"></li> 
                <li class="label">Phone:</li><li class="data"><?=$user['phone']?></li>
                <li class="label">Country:</li><li class="data"><?=$user['country']?></li>
                <li class="jump"></li>
            </ul>
            <br>
            <ul id="booking-detail-amount">
                <li>
                    <ul class="title">
                        <li class="concept">CONCEPT</li><li class="checkin">CHECK IN</li><li class="checkout">CHECK OUY</li><li class="places">Nº PLACES</li><li class="amount">AMOUNT</li>
                    </ul>
                </li>
                <li class="line"></li>
                <?  foreach($bookings as $booking){?>
                <li>
                    <ul class="data">
                        <li class="concept"><?=$booking['name']?> - <?=$booking['room_type']?></li><li class="checkin"><?=$lang[date('l',$booking['checkin'])];?>, <?=getTime($booking['checkin'])?></li><li class="checkout"><?=$lang[date('l',$booking['checkout'])];?>, <?=getTime($booking['checkout'])?></li><li class="places"><?=$booking['adults']?> Adult   <?=$booking['children']?> Children</li><li class="amount"><?=$booking['order_price']?> €</li>
                    </ul>
                </li><?}?>
                <li class="total">TOTAL AMOUN: <?=$booking['payment_sum']?>€</li>
            </ul>
        </div>
        <div id="booking-detail-more">
            <div id="need-more">NEED TO FEEL MORE?</div>
            <a href="<?=URL?>experience/" class="booking-more-feel" id="experiences"></a>
            <a href="<?=URL?>accommodation/"  class="booking-more-feel" id="accommodation"></a>
            <a href="<?=URL?>gift/"  class="booking-more-feel" id="gift"></a>
            <a href="#"  class="booking-more-feel" id="market"></a>
        </div>
        <div id="booking-detail-print-box">
            <a href="#"  value="Print this page" onClick="window.print()" class="booking-more-feel" id="print"></a>
            <a href="<?=URL?>user/bookingPDF/8MRGZ0P3LB"  class="booking-more-feel" id="pdf"></a>
        </div>
    </div>
</div>
</body>
</html>
<?
function getTime($sqlTime){
        $timestamp = strtotime($sqlTime);
        return date("d-m-Y",$timestamp);
    }
    ?>