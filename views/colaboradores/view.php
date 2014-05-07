<div id="colaboradores" class='mainWrapper'>
    <ul class="tabs">
        <li class="<?=($this->title==$this->lang['ong'])?'ui-state-active':''?>"><a href="<?= URL ?>colaboradores/view/<?= $this->lang['ong'] ?>"><div class="tab-box"><?= $this->lang['ong'] ?></div></a></li>
        <li class="<?=($this->title==$this->lang['donantes'])?'ui-state-active':''?>"><a href="<?= URL ?>colaboradores/view/<?= $this->lang['donantes'] ?>"><div class="tab-box"><?= $this->lang['donantes'] ?></div></a></li>
        <li class="<?=($this->title==$this->lang['empresas'])?'ui-state-active':''?>"><a href="<?= URL ?>colaboradores/view/<?= $this->lang['empresas'] ?>"><div class="tab-box"><?= $this->lang['empresas'] ?></div></a></li>
    </ul>
    <ul id="colaboradores-list">
        <? foreach ($this->donantes as $key => $donante) { ?>
            <li>
                <?= ($key != 0) ? '<div class="colaboradores-separator"></div>' : '' ?>
                <div class="colaboradores-img">
                    <img class="full" src="<?= UPLOAD . Model::getRouteImg($donante['img_date']) . 'thumb_250x250_' . $donante['file_name'] ?>">
                    <img class="capaSquare" src="http://temp.vipsinaction.com/public/img/capaSquare.png">
                </div><div class="colaboradores-info">
                    <h1><?= $donante['name'] ?></h1>
                    <?= $donante['content'] ?>
                    <?= ($donante['content'] != '') ? $this->lang['si_saber_mas'] . ' <a target="_blank" href="' . $donante['url'] . '">' . $donante['url'] . '</a>' : '' ?>
                    <br><p class="colaboradores-acumulado"><?= $this->lang['importe_acumulado'] ?><span class="bold"><?= number_format($donante['current_bid'], 2, ',', '.') ?> €</span></p><?if($this->auctions[$donante['donantes_id']]){?><div class="colabores-auctions">
                        <a class="link"><div class="q-button">+</div>
                            <?= $this->lang['subastas_asociadas'] ?></a>
                    </div><?}?>
                </div>
                <div class="mainWrapper" id="listBids">
                    <h2><?=$this->lang['subastas_asociadas']?></h2>
                <ul  class="auctlist">
                    <?
                    foreach ($this->auctions[$donante['donantes_id']] as $bid) {
                        $time = Model::getRemaingTime($bid['ends']);
                        ?><li>
                            <div class="imgBox">
                                <img class="full" src="<?= UPLOAD . Model::getRouteImg($bid['img_date']) . '' . $bid['file_name'] ?>">
                            </div><div class="content">
                                <h1><?= $bid['name'] ?></h1>
                                <ul>
                                    <li><?= $this->lang['my_puja'] ?>: <span class="bold"><?= number_format($bid['maxbid'], 2, ',', '.') ?>€</span></li>
                                    <li><?= $this->lang['actual_offer'] ?>: <span class="bold"><?= number_format(($bid['current_bid'] != 0) ? $bid['current_bid'] : $bid['minimum_bid'], 2, ',', '.') ?>€</span></li>
                                    <li><?= $this->lang['Quedan'] ?>: <span class="bold"><? if ($time) { ?><?= $time['days'] ?> <?= $this->lang['dias'] ?>, <?=$time['hours']?> <?= $this->lang['horas'] ?> <?= $this->lang['and'] ?> <?= $time['minutes'] ?> <?= $this->lang['minutos'] ?><? } else {
                            echo $this->lang['auction_ended'];
                        } ?></span></li>
                                    <li class="orange"><?= ($bid['max_bidder'] == $this->user['id']) ? $this->lang['eres_el_mayor'] : $this->lang['te_han_superado'] ?></li>
                                </ul>
                                <a class="link allInfo" href="<?= URL ?>auction/view/<?= $bid['auction_id'] ?>/<?= $bid['name'] ?>"><div class="q-button">+</div>
                                    <?= $this->lang['see_all_info'] ?></a>
                            </div>
                        </li><? } ?>

                </ul>
                </div>
            </li>
<? } ?>
    </ul>
</div>