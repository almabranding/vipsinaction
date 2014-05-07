<? $time = Model::getRemaingTime($this->auction['ends']); ?>
<div id="auction">
    <div id="auction-content">
        <div id="auction-content-left">
            <div id="auction-content-img"><img src="<?= UPLOAD . Model::getRouteImg($this->auction['img_date']) . $this->auction['file_name'] ?>"></div>
            <? if ($time) { ?><div id="bidForm">
                    <form id="bid-form"  enctype="multipart/form-data" method="get" action="<?= URL ?>auction/bid" name="bid-form">
                                                <input id="next_bid" name="next_bid" type="hidden" value="<?= number_format(str_replace('.','',$this->bids['next_bid']),2,'.','') ?>">
                        <input id="auction_id" name="auction_id" type="hidden" value="<?= $this->auction['auction_id'] ?>">
                        <input id="user_id" name="user_id" type="hidden" value="<?= $this->user['id'] ?>">
                        <div id="bidFormbox">
                            <input id="bidInput" name="bid" type="number">
                            <input value="<?= $this->lang['bid_now'] ?> !" type="button" id="bidButton">
                        </div>
                    </form>
                    <div class="bidOver">
                        <p>
                            <? if($this->Mybids){
                                echo ($this->bids[0]['id'] == $this->user['id'])? $this->lang['eres_el_mayor'] : $this->lang['te_han_superado'];
                            }?>
                        </p>
                    </div>
                    <div class="bidNext"><p><?= $this->lang['minium_ammount'] ?>: <?= $this->bids['next_bid'] ?> €</p></div>
                </div>  
            <? } ?>
        </div><div id="auction-content-right">
            <div class="auction-content-box">
                <h1><?= $this->auction['name'] ?></h1>
                <ul id="auction-data">
                    <li><?= $this->lang['actual_offer'] ?>: <span class="bold"><?= number_format(($this->auction['current_bid'] != 0) ? $this->auction['current_bid'] : $this->auction['minimum_bid'], 2, ',', '.') ?>€</span> <?if($this->bids['num_bids']>5){?><span class="orange">(<?= $this->bids['num_bids'] ?> <?= $this->lang['bids'] ?>)</span><?}?></li>
                    <li><?= $this->lang['value'] ?> : <span class="bold"><?= number_format($this->auction['price'], 2, ',', '.') ?>€</span></li>
                    <li>
                        <? if ($this->auction['ofrecido_id']) {
                            echo $this->lang['offert_by']
                            ?>:<br><br>
                            <img width="150" src="<?= UPLOAD . Model::getRouteImg($this->auction['ofrecido_date']) . $this->auction['file_ofrecido'] ?>">
<? } ?>
                    </li>
                    <?if($this->bids[0]){?><li><?= $this->lang['last_offert'] ?>: <span class="orange"><?= $this->bids[0]['nick'] ?></span></li><?}?>
                    
                    <li><? if ($time) { ?><?= $this->lang['Quedan'] ?>: <p style="display: none;" id="countdownResult" class="bold"><span id="days"></span> <?= $this->lang['días'] ?>, <span id="hours"></span> <?= $this->lang['horas'] ?> , <span id="minutes"></span> <?= $this->lang['minutos'] ?> <?= $this->lang['and'] ?> <span id="seconds"></span> <?= $this->lang['seconds'] ?><?
                            } else {
                                echo $this->lang['auction_ended'];
                            }
                            ?></p></li>
                </ul>
                <div style="display: none;" id="countdown"><?= $this->auction['ends'] ?></div>
                <ul id="aution-actions">
                    <li><a id="addFav" class="link" href="#"><div class="q-button">+</div><?= $this->lang['favorites_list'] ?></a>
                    <li><a class="link" href="<?= URL ?>faq"><div class="q-button">?</div><?= $this->lang['any_doubt'] ?></a>
                </ul>
            </div>
        </div>
    </div>
    <div id="product-detail">
        <div id="detail-tabs">
            <ul class="tabs capitalize">
                <li class="selected"><a href="#description"><div class="tab-box"><?= $this->lang['description'] ?></div></a>
                <li><a href="#legal"><div class="tab-box"><?= $this->lang['legal'] ?></div></a>
                <li><a href="#envio"><div class="tab-box"><?= $this->lang['envio'] ?></div></a>
                <li class="donationInfo"><div class="tab-box"><?= ($this->auction['donated_id']) ? $this->lang['donate_by'] . ':' : '' ?> <a class="orange" href="<?= URL ?>colaboradores/auctions/<?= $this->auction['donated_id'] ?>/<?= $this->auction['donated_name'] ?>"><?= $this->auction['donated_name'] ?></a>  &nbsp;&nbsp;<?= ($this->auction['for_id']) ? $this->lang['Para'] . ':' : '' ?> <a class="orange" href="<?= URL ?>colaboradores/auctions/<?= $this->auction['for_id'] ?>/<?= $this->auction['for_name'] ?>"><?= $this->auction['for_name'] ?></a></div>
            </ul>
            <div class="product-detail-content" id="description">
                <h1><?= $this->auction['name'] ?></h1>
                <div class="desc-text"><?= $this->auction['description'] ?></div><div class="desc-logo"><a href="<?= URL ?>colaboradores/auctions/<?= $this->auction['for'] ?>"><img width="150" src="<?= UPLOAD . Model::getRouteImg($this->auction['for_img_date']) . $this->auction['for_file_name'] ?>"></a></div>         
            </div>
            <h3><?= $this->lang['legal'] ?></h3>
            <div class="product-detail-content"  id="legal">
<?= $this->auction['legal'] ?> 
            </div>
            <h3><?= $this->lang['envio'] ?></h3>
            <div class="product-detail-content"  id="envio">
<?= $this->auction['envio'] ?>
            </div>
        </div>
    </div>
</div>