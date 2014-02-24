<div id="signup-box">
    <h1><?= $this->message['title'] ?></h1>
    <h3><?= $this->message['subtitle'] ?></h3>
    <div class="separator"></DIV>
</div>
<div id="signup-box">
    <?= $this->message['content'] ?>
</div>
<? if ($this->form) $this->form->render('views/templates/' . $this->formName . '.php') ?>
<div id="errorMsg"><?= $this->error ?></div>