<div id="sectionHeader">
    <h1>Auctions</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?= URL ?>auctions/view'">Add new auction</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <? $this->getView('table'); ?>
    <? $this->getView('pagination'); ?>
</div>
