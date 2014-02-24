<div id="sectionHeader">
    <h1>Home</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?php echo URL . LANG; ?>/home/view'">Add new section</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
<? $this->getView('table');?>
</div>