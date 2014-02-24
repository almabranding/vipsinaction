<div id="sectionHeader">
    <h1>Log</h1>
    <div id="sectionNav">
        <div class="btn red" onclick="location.href='<?php echo URL.LANG;?>/log/deleteLog/' " >Delete log</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
 <?php
    $this->getView('table');
    $this->getView('pagination');
 ?>
</div>