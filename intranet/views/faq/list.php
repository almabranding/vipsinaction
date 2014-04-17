<div id="sectionHeader">
    <h1>FAQ</h1>
    <div id="sectionNav">
                <div class="btn blue" onclick="location.href = '<?= URL ?>faq/view'" >New faq</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <? $this->getView('table');?>
<? $this->getView('pagination'); ?>
</div>
