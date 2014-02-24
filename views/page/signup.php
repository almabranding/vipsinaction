<div id="signup-box">
    <h1>SIGN UP FORM</h1>
    <h3>*ALL FIELDS ARE REQUIRED</h3>
    <div class="separator"></DIV>
    <h2>PERSONAL DETAILS</h2>
    <div class="separator"></DIV>
</div>
<?= $this->signupForm->render('views/templates/signup-template.php') ?>
<div id="errorMsg"><?=$this->error?></div>