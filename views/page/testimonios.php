<div class="container" id="testimonials">
    <h1><?=$this->lang['lo_opinan_usuarios']?></h1>
    <ul id="opiniones">
        <?foreach($this->reviews as $key=>$review){?>
        <li class="<?=($key%2)?'last':''?>">
            <h1><?=$review['name']?> </h1>
            <div class="opiniones-img">
                <img class='full' src="<?= UPLOAD . Model::getRouteImg($review['img_date']) . $review['file_name'] ?>">
            </div>
            <div class="opiniones-content">
                <p><?=$review['content']?></p> 
            </div>
        </li>
        <?}?>
    </ul>
</div>
