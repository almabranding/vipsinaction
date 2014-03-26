<div class="container" id="home">
    <div id="banner" class="royalSlider rsMinW">
        <? foreach ($this->banner as $banner) { ?><div id="" class="banner-box">
                <ul><li>
                        <div class='label'>
                            <?= $banner['content'] ?>
                            <a href="<?= $banner['url'] ?>" class="button blue uppercase"><?= $this->lang['puja ahora'] ?>!</a>
                        </div><a href="<?= $banner['url'] ?>"><div class="img"><img alt='<?= $banner['caption'] ?>' src="<?= UPLOAD . Model::getRouteImg($banner['img_date']) . $banner['file_name'] ?>"></div></a>

                    </li></ul>
            </div><? } ?>
    </div>
    <div id="auctions-list-box">
        <ul id="auctions-list">
            <? foreach ($this->auctions as $key=>$auction) { 
                $time=Model::getRemaingTime($auction['ends']);
                ?><li class='pos_<?= $key % 4 ?>'><a href='<?=URL?>auction/view/<?=$auction['auction_id']?>/<?=  urlencode($auction['name'])?>'><div class="content-box">
                        <div class="auctions-list-img-box">
                            <img class='full' src="<?= UPLOAD .Model::getRouteImg($auction['img_date']).'thumb_250x250_'.$auction['file_name']?>">
                            <img class="capaSquare" src="<?=URL?>public/img/capaSquare.png">
                            <div class="auctions-time-label"><?=($time)?$time->d:'0'?> <?=$this->lang['dias']?>, <?=($time)?$time->h:'0'?> <?=$this->lang['horas']?> <?=$this->lang['and']?> <?=($time)?$time->i:'0'?> <?=$this->lang['minutos']?></div>
                        </div>
                        <div class="auctions-list-info">
                            <p><?=$auction['name']?></p>
                            <p class="price"><?= $this->lang['oferta_actual'] ?>: <?= number_format(($auction['current_bid']!=0)?$auction['current_bid']:$auction['minimum_bid'],2,',','.') ?>€</p>
                        </div>
                        </div></a></li><? } ?>
        </ul>
    </div>
</div>
