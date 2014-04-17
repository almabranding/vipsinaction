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
                </ul>
                <a class="link allInfo" href="<?=URL?>auction/view/<?=$this->auction['auction_id']?>/<?=$this->auction['name']?>"><div class="q-button">+</div>
                <?= $this->lang['see_all_info'] ?></a>
            </div>
    </section>
    <div class="colaboradores-separator"></div>
    <? if($this->code_request) $this->code_request->render('views/templates/code-request-template.php',false,$this->lang) ?>
    <? if($this->code_verification) $this->code_verification->render('views/templates/code-verification-template.php',false,$this->lang) ?>
    <? if($this->auctionForm) $this->auctionForm->render('views/templates/bid-template.php',false,$this->lang) ?>
</div>