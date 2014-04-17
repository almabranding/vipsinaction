<div id="faq" class="mainWrapper">
    <h1><?= $this->lang['PREGUNTAS_FRECUENTES'] ?></h1>
    <div id="accordion" class="container-border container">
        <? foreach ($this->faq as $key=>$faq) { ?>
            <h3><?= ($key+1).') '.$faq['name'] ?></h3>
            <div>
                <p>
                    <?= $faq['content'] ?>
                </p>
            </div>
        <? } ?>
    </div>
</div>