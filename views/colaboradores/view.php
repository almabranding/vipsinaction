<div id="colaboradores" class='mainWrapper'>
    <h1><?= $this->title ?></h1>
    <ul id="colaboradores-list">
        <? foreach ($this->donantes as $key => $donante) { ?>
            <li>
                <?= ($key != 0) ? '<div class="colaboradores-separator"></div>' : '' ?>
                <div class="colaboradores-img">
                    <img class="full" src="<?= UPLOAD . Model::getRouteImg($donante['img_date']) .'thumb_250x250_' .$donante['file_name'] ?>">
                    <img class="capaSquare" src="http://temp.vipsinaction.com/public/img/capaSquare.png">
                </div><div class="colaboradores-info">
                    <h1><?= $donante['name'] ?></h1>
                    <?= $donante['content'] ?>
                    <?= ($donante['content'] != '') ? $this->lang['si_saber_mas'] . ' <a target="_blank" href="http://' . $donante['url'] . '">' . $donante['url'] . '</a>' : '' ?>
                    <p class="colaboradores-acumulado"><?= $this->lang['importe_acumulado'] ?><span class="bold"><?= number_format($donante['current_bid'],2,',','.') ?> €</span></p>
                    <div class="colabores-auctions">
                        <a class="link" href="<?= URL ?>colaboradores/auctions/<?= $donante['donantes_id'] ?>/<?= $donante['name'] ?>"><div class="q-button">+</div>
                            <?= $this->lang['subastas_asociadas'] ?></a>
                    </div>
                </div>
            </li>
        <? } ?>
    </ul>
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