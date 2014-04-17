<div id="sectionHeader">
    <h1>Report</h1>
    <div id="sectionNav">
        <a href="<?= URL ?>auctions/lista"><div id="arrowBack">Back to auctions</div></a>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <? $this->getView('table'); ?>
    <? $this->getView('pagination'); ?>
</div>
