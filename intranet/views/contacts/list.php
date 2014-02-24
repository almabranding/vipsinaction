<div id="sectionHeader">
    <h1>Contacts</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?php echo URL . LANG; ?>/contacts/editCreateContact/'" >Create new contact</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <?php $this->search->render(); ?>
    <?php
    $this->getView('table');
    $this->getView('pagination');
    ?>
</div>