<div id="sectionHeader">
    <h1>Suggestions</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?= URL ?>/suggestions/editGroup/add'">Add new suggestion</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <? $this->getView('table');?>
<? $this->getView('pagination'); ?>
</div>
