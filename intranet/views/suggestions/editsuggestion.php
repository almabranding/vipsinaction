<div id="sectionHeader">
    <?if($this->id!=null){?>
    <a href="<?= URL ?>suggestions/view/<?= $this->id; ?>"><div id="arrowBack">Back to suggestions</div></a>
   <? }else{?>
    <a href="<?= URL ?>suggestions/lista"><div id="arrowBack">Back to suggestions</div></a>
    <?}?>
    <h1>Suggestion</h1>
   
    <div class="clr"></div>
</div>
<? $this->form->render();


