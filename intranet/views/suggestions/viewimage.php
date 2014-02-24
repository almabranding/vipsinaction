<div id="sectionHeader">
    <a href="<?= URL ?>suggestions/view/<?= $this->group; ?>"><div id="arrowBack">Back to suggestions</div></a>
    <h1>Image</h1>
   
    <div class="clr"></div>
</div>
<? $this->form->render(); ?>

        
<div class="container">
        <img src="<?= URL . UPLOAD . Model::getRouteImg($this->img['imgdate']) . $this->img['file_name']; ?>" id="target" alt="[Jcrop Example]" />
        <div id="preview-pane">
            <div class="preview-container">
                <img src="<?php echo URL . UPLOAD . Model::getRouteImg($this->img['imgdate']) . $this->img['file_name']; ?>" class="jcrop-preview" alt="Preview" />
            </div>
        </div>
        <form id="cropForm" action="<?= URL; ?>uploadFile/crop/suggestions" method="post" onsubmit="return checkCoords();">
            <label><input type="checkbox" id="ar_lock" name="thumbnail" />Apply to thumb</label>
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="rel" name="rel" />
            <input type="hidden" id="original" name="original" value="<?= $this->img['file_name']; ?>"/>
            <input type="hidden" name="id" value="<?= $this->img['id'] ?>"/>
            <input type="hidden" id="filename" name="filename" value="<?= $this->img['file_name']; ?>"/>
            <input type="hidden" name="filefolder" value="<?= Model::getRouteImg($this->img['imgdate']); ?>"/>
        </form>
 <div id="sectionNav">
        <div class="btn grey" onclick="$('#cropForm').submit();" >Crop image</div>
    </div>
    <div class="clearfix"></div>
</div>



