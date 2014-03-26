<div class="container-border container" id="page">
    <h1>
        LA OPORTUNIDAD DE <span class="orange">VIVIR</span> TUS <span class="orange">SUEÑOS</span>
        Y <span class="orange">MEJORAR</span> NUESTRO <span class="orange">MUNDO</span></h1>
   <?=$this->article['content']?>
    <div class="colaboradores-separator"></div>
    <h2><?=$this->lang['lo_dicen_nosotros']?></h2>
    <ul id="dicen">
        <li><a href="#"><img src="<?= UPLOAD ?>dicen01.jpg"></a>
        <li><a href="#"><img src="<?= UPLOAD ?>dicen02.jpg"></a>
        <li><a href="#"><img src="<?= UPLOAD ?>dicen03.jpg"></a>
        <li><a href="#"><img src="<?= UPLOAD ?>dicen04.jpg"></a>
        <li><a href="#"><img src="<?= UPLOAD ?>dicen05.jpg"></a>
    </ul>
    <div class="colaboradores-separator"></div>
    <h2><?=$this->lang['lo_opinan_usuarios']?></h2>
    <ul id="opiniones">
        <?foreach($this->reviews as $key=>$review){?>
        <li>
            <?=($key!=0)?'<div class="colaboradores-separator"></div>':''?>
            <div class="opiniones-img">
                <img class='full' src="<?= UPLOAD . Model::getRouteImg($review['img_date']) .'thumb_250x250_'. $review['file_name'] ?>">
            </div><div class="opiniones-content">
                <h1><?=$review['name']?>
                </h1>
                <p><?=$review['content']?></p> </div>
        </li>
        <?}?>
    </ul>
</div>
