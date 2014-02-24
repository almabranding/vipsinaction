<div id="sectionHeader">
    <a href="<?= URL ?>suggestions/lista"><div id="arrowBack">Back to suggestions</div></a>
    <h1><?= $this->model[0]['name']; ?></h1>
    <div id="sectionNav">
        <div class="linkNav" id="allSelect">Select all</div>
        
        <div id="deleteImage" class="btn red">Delete</div>
        <div class="btn grey" onclick="showPop('newImage');" >Add new suggestion</div>
        <a href="<?= URL ?>suggestions/editGroup/edit/<?= $this->group; ?>"><div class="btn grey" >Edit suggestion</div></a>
        <div class="btn blue" id="saveInputs">Save</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <div>
        <ul id="sortable" class="ui-sortable sortable modelListImages" rel="cosa">
            <?
            foreach ($this->Gallery as $key => $value) { ?>
                <li id="foo_<?=$value['sugid']; ?>" class="ui-state-default modelList <?= ($value['main']) ? 'mainPic' : '' ?>" onclick="">
                    <input value="<?=$value['id']; ?>" name="check[]" class="checkFoto" type="checkbox">
                    <img width="154" height="207" class="listImage" caption="<?=$value['caption_' . LANG]; ?>" src="<?= URL . UPLOAD . Model::getRouteImg($value['imgdate']) . 'thumb_' . $value['file_name'].$strNoCache; ?>"/>
                    <a target="_blank" href="<?= URL . UPLOAD . Model::getRouteImg($value['imgdate']) . $value['file_name']; ?>"><input id="h1096" class="btnSmall" type="button" value="View" ></a>
                    <input id="h1096" class="btnSmall editImg" type="button" value="Edit" onclick="location.href = '<?=URL; ?>suggestions/viewImage/<?= $value['sugid']; ?>/<?= $this->group; ?>'" >
                    <input class="btnSmall" type="submit" value="Delete" onclick="secureMsg('Do you want to delete this suggestion?','suggestions/delete/<?= $value['sugid'].'/'.$this->group ?>');" style="background: #bb0000;">
                </li>
            <? } ?>
        </ul>
    </div>
</div>
<div class="white_box hide" id="newImage" style="width:auto;left:30%;position:absolute;">
    <? $this->viewUploadFile('suggestions/add/'.$this->group); ?>
</div>
