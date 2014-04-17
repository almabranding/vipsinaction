<div id="sectionHeader">
    <a href="<?= URL ?>users/lista"><div id="arrowBack">Back to users</div></a>
    <h1>Edit/Create User</h1>
    <div id="sectionNav">
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
    <div id="detail-tabs">
        <ul class="tabs capitalize">
            <li class="selected"><a href="#personal"><div class="tab-box">Personal</div></a>
            <li><a href="#bids"><div class="tab-box">Bids</div></a>
        </ul>
        <div class="product-detail-content" id="personal">

            <?= $this->form->render(); ?>
        </div>
        <div class="product-detail-content"  id="bids">
            <?= $this->getView('table'); ?> 
        </div>
    </div>
</div>
