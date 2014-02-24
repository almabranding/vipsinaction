<div id="sectionHeader">
    <a href="<?= URL ?>models/editportafolio/<?= $this->model[0]['id']; ?>"><div id="arrowBack">Back to model</div></a>
    <h1>Composite <?= $this->model[0]['name']; ?></h1>
    <div id="sectionNav">
        <div class="btn red" onclick="location.href = '<?php echo URL . LANG; ?>/models/resetComposite/<?php echo $this->id; ?>'">Delete composite</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <ul id="compositeBox" class='compositeBox' style="">
         <?php
            foreach ($this->composite as $key => $value) {
                Back::isImage($value['photo_id']);
                ?>
                <li rel="<?= $value['photo_id'] ?>" id="foo_<?php echo $value['id']; ?>" class="ui-state-default listImage modelList <? echo ($value['main']) ? 'mainPic' : '' ?>" onclick="">
                    <input type="hidden" value="<?= $value['photo_id'] ?>" name="foo[]">
                    <img caption="<?php echo $value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name'].$strNoCache; ?>"><a target="_blank" href="<?php echo URL . UPLOAD . $this->id . '/' . $value['img']; ?>">
                </li>
            <?php } ?>
    </ul>
    <div>
        <input id="model_id" value="<? echo $this->id; ?>" type="hidden">
        <ul id="draggable" class="ui-sortable sortable modelListImages" rel="cosa">
            <?php
            foreach ($this->modelPhotos as $key => $value) {
                Back::isImage($value['photo_id']);
                ?>
                <li rel="<?= $value['photo_id'] ?>" id="foo_<?php echo $value['id']; ?>" class="ui-state-default listImage modelList <? echo ($value['main']) ? 'mainPic' : '' ?>" onclick="">
                    <input type="hidden" value="<?= $value['photo_id'] ?>" name="foo[]">
                    <img caption="<?php echo $value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name'].$strNoCache; ?>"><a target="_blank" href="<?php echo URL . UPLOAD . $this->id . '/' . $value['img']; ?>">
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<script>
    
</script>