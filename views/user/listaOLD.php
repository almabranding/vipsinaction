<div class="" id="listBids">
    <ul>
        <?foreach($this->bids as $bid){ ?><li>
            <div class="imgBox">
                <img class="full" src="<?= UPLOAD .Model::getRouteImg($bid['img_date']).'thumb_'.$bid['file_name']?>">
            </div>
            <div class="content">
                <h1><?=$bid['name']?></h1>
                <ul>
                    <li>Mi puja: <span class="bold"><?=$bid['maxbid']?>€</span></li>
                    <li>Oferta actual: <span class="bold"><?= ($bid['current_bid']!=0)?$bid['current_bid']:$bid['minimum_bid'] ?>€</span></li>
                    <li>Quedan: <span class="bold"><?$time=Model::getRemaingTime($bid['ends'])?><?=$time->d?> <?=$this->lang['dias']?>, <?=$time->h?> <?=$this->lang['horas']?> <?=$this->lang['and']?> <?=$time->i?> <?=$this->lang['minutos']?></span></li>
                    <li class="orange"><?=($bid['max_bidder']==$this->user['id'])?'Eres el mayor pujador':'Te han superado la puja'?></li>
                </ul>
                <a class="link allInfo" href="<?=URL?>auction/view/<?=$bid['auction_id']?>/<?=$bid['name']?>"><div class="q-button">+</div>
                <?= $this->lang['see_all_info'] ?></a>
            </div>
        </li><?}?>
       
    </ul>
</div>
