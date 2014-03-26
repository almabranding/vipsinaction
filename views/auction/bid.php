<?$time=Model::getRemaingTime($this->auction['ends']);?>
<div id="bid">
    <section id="bid-content">
        <h1><?=$this->lang['confirmacion_puja']?></h1>
        <div class="imgBox">
                <img class="full" src="<?= UPLOAD .Model::getRouteImg($this->auction['img_date']).'thumb_'.$this->auction['file_name']?>">
            </div><div class="content">
                <h1><?=$this->auction['name']?></h1>
                <ul>
                    <li><?= $this->lang['actual_offer'] ?>: <span class="bold"><?= number_format(($this->auction['current_bid']!=0)?$this->auction['current_bid']:$this->auction['minimum_bid'],2,',','.') ?>€</span></li>
                    <li><?= $this->lang['Quedan'] ?>: <span class="bold"><?if($time){?><?=$time->d?> <?=$this->lang['dias']?>, <?=$time->h?> <?=$this->lang['horas']?> <?=$this->lang['and']?> <?=$time->i?> <?=$this->lang['minutos']?><?}else{ echo $this->lang['auction_ended'];}?></span></li>
                    <li class="orange"><?=($this->auction['max_bidder']==$this->user['id'])?$this->lang['eres_el_mayor']:$this->lang['te_han_superado']?></li>
                </ul>
                <a class="link allInfo" href="<?=URL?>auction/view/<?=$this->auction['auction_id']?>/<?=$this->auction['name']?>"><div class="q-button">+</div>
                <?= $this->lang['see_all_info'] ?></a>
            </div>
    </section>
    <div class="colaboradores-separator"></div>
   
    <? $this->auctionForm->render('views/templates/bid-template.php',false,$this->lang) ?>

</div>
<ul id="socialMediaMargin" class="socialIcons">
    <li>
        <a href="#"><div id="fb"></div></a>
    </li>
    <li>
        <a href="#"><div id="tw"></div></a>
    </li>
    <li>
        <a href="#"><div id="gplus"></div></a>
    </li>
    <li>
        <a href="#"><div id="pinterest"></div></a>
    </li>
    <li>
        <a href="#"><div id="tuenti"></div></a>
    </li>
    <li>
        <a href="#"><div id="in"></div></a>
    </li>
    <li>
        <a href="#"><div id="instagram"></div></a>
    </li>
</ul>