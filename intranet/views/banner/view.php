<div id="sectionHeader">
    <a href="<?= URL ?>banner/lista"><div id="arrowBack">Back to banners</div></a>
    <h1><?=$this->group['name']?></h1>
    <div id="sectionNav">
        <div class="linkNav" id="allSelect">Select all</div>
        <div id="deleteImage" class="btn red">Delete</div>
        <div class="btn grey" onclick="showPop('newImage');" >Add new image</div>
        <div class="btn blue" onclick="location.href = '<?= URL ?>banner/viewGroup/<?=$this->group['id']?>'" >Edit banner</div>
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
                    <input id="h1096" class="btnSmall editImg" type="button" value="Edit" onclick="location.href = '<?=URL; ?>banner/viewImage/<?= $value['sugid']; ?>/<?=$this->group['id']?>'" >
                    <input class="btnSmall" type="submit" value="Delete" onclick="secureMsg('Do you want to delete this suggestion?','banner/delete/<?= $value['sugid'].'/'.$this->group['id']?>');" style="background: #bb0000;">
                </li>
            <? } ?>
        </ul>
    </div>
</div>
<div class="white_box hide" id="newImage" style="width:auto;left:30%;position:absolute;">
    <? $this->viewUploadFile('banner/add/'.$this->group['id']); ?>
</div>
