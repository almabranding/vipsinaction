<div class="container-border container form breath" id="page">
    <h1><?=$this->title?></h1>
    <br><br>
    <h2><?=$this->subtitle?></h2>
     <br><br>
    <? if ($this->form) $this->form->render('views/templates/'.$this->formName.'.php',false,$this->lang) ?>
</div>
