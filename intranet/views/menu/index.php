<div id="sectionHeader">
    <h1>Menu</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?=URL; ?>menu/view'">Add new menu</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
<? $this->getView('table');?>
</div>