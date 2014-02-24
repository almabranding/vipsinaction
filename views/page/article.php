<div id="article">
    <div class="bgFrame"></div>
    <?=$this->article['content']?>
</div>
<div id="contact">
     <? ($this->article['template']=='contact')? $this->contactForm->render('views/templates/contact-template.php',false):''?>
</div>