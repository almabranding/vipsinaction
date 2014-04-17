<div class="mainWrapper" id="listBids">
    <h1><?= $this->title ?></h1>
    <? if ($this->donante) { ?>
        <div id="colaboradores" class='mainWrapper' style="margin-bottom: 20px;">
            <ul id="colaboradores-list">
                <li>
                    <div class="colaboradores-img">
                        <img class="full" src="<?= UPLOAD . Model::getRouteImg($this->donante['img_date']) . 'thumb_250x250_' . $this->donante['file_name'] ?>">
                        <img class="capaSquare" src="http://temp.vipsinaction.com/public/img/capaSquare.png">
                    </div><div class="colaboradores-info" style="margin-bottom: 0">
                        <h1><?= $this->donante['name'] ?></h1>
                        <?= $this->donante['content'] ?>
                        <?= ($this->donante['content'] != '') ? $this->lang['si_saber_mas'] . ' <a target="_blank" href="' . $this->donante['url'] . '">' . $this->donante['url'] . '</a>' : '' ?>
                        <p class="colaboradores-acumulado"><?= $this->lang['importe_acumulado'] ?><span class="bold"><?= number_format($this->donante['current_bid'], 2, ',', '.') ?> €</span></p>
                    </div>
                </li>
            </ul>
        </div>
    <? } ?>
    <?
    $orden= array('ends','minimum_bid','name');
    $actual=(isset($_GET['order']))?$_GET['order']:'ends';
    ?>
    <div id="ordenBox"><?= $this->lang['ordenar_por'] ?><div class="orden_Selected"><?=$this->lang['order_'.$actual]?> <i></i></div>
        <ul id="ordenMenu">
            <? 
            $search=(isset($_GET['search']))?'&search='.$_GET['search']:'';
            foreach($orden as $ord){ if($ord!=$actual){?>
            <li>
                <a href="<?=URL.RUTE?>?order=<?=$ord.$search?>"><?=$this->lang['order_'.$ord]?></a>
            </li>
            <?}}?>
        </ul>
    </div>
    <div class="clr"></div>
    <ul>
        <?
        foreach ($this->bids as $bid) {
            $time = Model::getRemaingTime($bid['ends']);
            ?><li>
                <div class="imgBox">
                    <img class="full" src="<?= UPLOAD . Model::getRouteImg($bid['img_date']) . '' . $bid['file_name'] ?>">
                </div><div class="content">
                    <h1><?= $bid['name'] ?></h1>
                    <ul>
                        <li><?= $this->lang['my_puja'] ?>: <span class="bold"><?= number_format($bid['maxbid'], 2, ',', '.') ?>€</span></li>
                        <li><?= $this->lang['actual_offer'] ?>: <span class="bold"><?= number_format(($bid['current_bid'] != 0) ? $bid['current_bid'] : $bid['minimum_bid'], 2, ',', '.') ?>€</span></li>
                        <li><?= $this->lang['Quedan'] ?>: <span class="bold"><? if ($time) { ?><?= $time->d ?> <?= $this->lang['dias'] ?>, <?= $time->h ?> <?= $this->lang['horas'] ?> <?= $this->lang['and'] ?> <?= $time->i ?> <?= $this->lang['minutos'] ?><? } else {
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
