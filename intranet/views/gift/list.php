<div id="sectionHeader">
    <h1>Gift</h1>
    <div id="sectionNav">
        <?if($this->section=='gift'){?>
        <div class="btn grey" onclick="location.href = '<?=URL; ?>gift/types'">Categories</div>
        <div class="btn blue" onclick="location.href = '<?=URL; ?>gift/view'">New gift</div>
        <?}else{?>
        <div class="btn grey" onclick="location.href = '<?=URL; ?>gift/lista'">Gifts</div>
        <div class="btn blue" onclick="location.href = '<?=URL; ?>gift/viewType'">New category</div>
        <?}?>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
<? $this->getView('table');?>
</div>