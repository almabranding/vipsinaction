<div id="sectionHeader">
    <h1>Users</h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href='<?php echo URL.LANG;?>/users/editCreateUser/' " >Add new USER</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
 <?php
    $this->getView('table');
 ?>
</div>