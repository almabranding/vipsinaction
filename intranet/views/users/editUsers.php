<div id="sectionHeader">
    <a href="<?=URL?>users/lista"><div id="arrowBack">Back to models</div></a>
    <h1>Edit/Create User</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href='<?php echo URL.LANG;?>/users/editCreateUser/' " >Add new USER</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <?php $this->form->render(); ?>
</div>
