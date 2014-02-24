<div id="sectionHeader">
    <a href="<?= URL ?>home/lista"><div id="arrowBack">Back to Home</div></a>
    <h1><?= $this->package['name'] ?></h1>
    <div id="sectionNav">
        <div class="btn blue" onclick="location.href = '<?php echo URL . LANG; ?>/home/addModel/<?php echo $this->id; ?>'" >Add a model</div>
        <div class="btn red" id="deleteModels" onclick="">Delete models</div>
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <input id="sectionId" type="hidden" value="<? echo $this->id; ?>">
    <ul id="sortable" class="ui-sortable sortable" rel="cosa">
        <?php foreach ($this->modelsPackage as $key => $value) { ?>
            <li id="foo_<?php echo $value['model_id']; ?>" class="ui-state-default listImage" onclick="">
                <input value="<?php echo $this->id; ?>_<?php echo $value['model_id']; ?>" name="check[]" class="checkFoto" type="checkbox">
                <img caption="<?php echo $value['caption_' . LANG]; ?>" src="<?php echo URL . UPLOAD . 'models/' . Model::idToRute($value['photo_id']) . 'thumb_' . $value['file_file_name']; ?>">
                <p><?php echo $value['name']; ?></p>
                <input id="deleteSingle" class="btnSmall" type="submit" value="Delete" style="background: #bb0000;">
            </li>
        <?php } ?>
</div>