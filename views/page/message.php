<div class="container-border container" id="contact">
    <h1><?= $this->message['title'] ?></h1>
    <div id='contact-form'>
        <?= $this->message['content'] ?>
    </div>
    <? if ($this->form) $this->form->render('views/templates/' . $this->formName . '.php') ?>
<div id="errorMsg"><?= $this->error ?></div>
</div>
