<div id="sectionHeader">
    <a href=<?=URL?>gift/lista><div id="arrowBack">Back to gift</div></a>
    <h1>Edit/Create section</h1>
  <div id="sectionNav">
    
        <div class="btn blue" onclick="location.href = '<?=URL; ?>gift/gallery/<?=$this->id; ?>'">Gallery</div>
  </div>
    
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <?php $this->form->render(); ?>
</div>
