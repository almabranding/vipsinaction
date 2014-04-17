<div id="sectionHeader">
    <a href="<?= URL ?>media/lista"><div id="arrowBack">Back to images</div></a>
    <h1>Image</h1>
    <div id="sectionNav">
        <div class="btn grey" onclick="$('#cropForm').submit();" >Crop image</div>
    </div>
    <div class="clr"></div>
</div>
<?php $this->form->render(); ?>

        
<div class="container">
    
    <?php $value=$this->img; ?>
    <img src="<?= URL . UPLOAD . Model::getRouteImg($value['img_date']) . $value['file_name']; ?>" id="target" alt="[Jcrop Example]" />
        <div id="preview-pane">
            <div class="preview-container">
                <img src="<?= URL . UPLOAD . Model::getRouteImg($value['img_date']) . $value['file_name']; ?>" class="jcrop-preview" alt="Preview" />
            </div>
        </div>
        <form id="cropForm" action="<?= URL; ?>image/crop" method="post" onsubmit="return checkCoords();">
            <label><input type="checkbox" id="ar_lock" name="thumbnail" />Apply to thumb</label>
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="redirect" name="redirect" value="<?=URL?>media/lista" />
            <input type="hidden" id="rel" name="rel" />
            <input type="hidden" id="original" name="original" value="<?= $value['file_name']; ?>"/>
            <input type="hidden" name="id" value="<?=  $value['photo_id'];  ?>"/>
            <input type="hidden" name="model_id" value="<?= $value['model_id']; ?>"/>
            <input type="hidden" id="filename" name="filename" value="<?= $value['file_name']; ?>"/>
            <input type="hidden" name="filefolder" value="<?= Model::getRouteImg($value['img_date']); ?>"/>
        </form>
    <div class="clearfix"></div>
</div>



