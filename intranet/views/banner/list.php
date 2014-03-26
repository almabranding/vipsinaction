<div id="sectionHeader">
    <h1>Banners</h1>
    <div id="sectionNav">
                <div class="btn blue" onclick="location.href = '<?= URL ?>banner/view'" >New banner</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <? $this->getView('table');?>
<? $this->getView('pagination'); ?>
</div>
