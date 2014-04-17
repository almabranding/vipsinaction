<div id="sectionHeader">
    <h1>Media</h1>
    <div id="sectionNav">
        <div class="btn grey" onclick="showPop('newImage');" >Add new photo</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <?
    $this->getView('table');
    ?>
</div>
<div class="white_box hide" id="newImage" style="width:auto;left:30%;position:absolute;">
    <? $this->viewUploadFile('media/addPhoto/'); ?>
</div>