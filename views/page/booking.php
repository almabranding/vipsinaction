<div id="booking-wrapper">
<div id="signup-box" class="booking-form">
    <h1 class='uppercase'><?=$this->lang['booking confirmation']?></h1>
    <h3 class='uppercase'>*<?=$this->lang['all fields are required']?></h3>
    <div class="separator"></DIV>
    <h2 class='uppercase'><?=$this->lang['personal details']?></h2>
    <div class="separator"></DIV>

<?= $this->bookingForm->render('views/templates/booking-template.php',false,array('view'=>$this)) ?></div>
