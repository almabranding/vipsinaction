<div class="container-border container" id="contact">
    <h1><?=$this->lang['contact_us']?></h1>
    <div id='contact-form'>
        <? $this->contactForm->render('views/templates/contact-template.php', false, $this->lang); ?>
    </div><div id='contact-info'>
        <div class='contact-wrapper'>
            <?=$this->article['content']?>
        </div>
    </div>
</div>
