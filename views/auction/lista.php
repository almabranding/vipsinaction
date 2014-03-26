<div class="mainWrapper" id="listBids">
    <h1><?=$this->title?></h1>
    <ul>
        <?foreach($this->bids as $bid){ 
            $time=Model::getRemaingTime($bid['ends']);
        ?><li>
            <div class="imgBox">
                <img class="full" src="<?= UPLOAD .Model::getRouteImg($bid['img_date']).''.$bid['file_name']?>">
            </div><div class="content">
                <h1><?=$bid['name']?></h1>
                <ul>
                    <li><?= $this->lang['my_puja'] ?>: <span class="bold"><?=number_format($bid['maxbid'],2,',','.')?>€</span></li>
                    <li><?= $this->lang['actual_offer'] ?>: <span class="bold"><?= number_format(($bid['current_bid']!=0)?$bid['current_bid']:$bid['minimum_bid'],2,',','.') ?>€</span></li>
                    <li><?= $this->lang['Quedan'] ?>: <span class="bold"><?if($time){?><?=$time->d?> <?=$this->lang['dias']?>, <?=$time->h?> <?=$this->lang['horas']?> <?=$this->lang['and']?> <?=$time->i?> <?=$this->lang['minutos']?><?}else{ echo $this->lang['auction_ended'];}?></span></li>
                    <li class="orange"><?=($bid['max_bidder']==$this->user['id'])?$this->lang['eres_el_mayor']:$this->lang['te_han_superado']?></li>
                </ul>
                <a class="link allInfo" href="<?=URL?>auction/view/<?=$bid['auction_id']?>/<?=$bid['name']?>"><div class="q-button">+</div>
                <?= $this->lang['see_all_info'] ?></a>
            </div>
        </li><?}?>
       
    </ul>
</div>
