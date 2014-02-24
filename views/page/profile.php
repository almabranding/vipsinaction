<? if ($this->bookings) { ?>
    <div id="signup-box">
        <h1>MY BOOKINGS</h1>
        <div class="separator"></div>
        <ul id="booking-list">
            <? foreach ($this->bookings as $booking) { ?><li><div class="title"><?= $booking['booking_description'] ?></div><a class="more" href="<?= URL ?>user/booking/<?= $booking['booking_number'] ?>">+ more info</a></li><? } ?>  
        </ul>
    </div>
<? } ?>

<div id="signup-box">
    <h1>SIGN UP FORM</h1>
    <h3>*ALL FIELDS ARE REQUIRED</h3>
    <div class="separator"></DIV>
    <h2>PERSONAL DETAILS</h2>
    <div class="separator"></DIV>
</div>
<?= $this->signupForm->render('views/templates/signup-template.php') ?>