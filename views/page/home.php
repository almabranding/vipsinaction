<div class="container" id="home">
    <div id="banner" class="royalSlider rsMinW">
        <? foreach ($this->banner as $key => $value) { ?><div id="home-suggestions-content" class="rsContent slide<?= $key ?>">
                <ul class="home-suggestions-box rsContent slide<?= $key ?>"><li id='home-suggestions-title'>
                        <div class='label'></div>
                    </li>
                </ul></div><? } ?>
    </div>
    <div id="auctions-list-box">
        <ul id="auctions-list">
             <? foreach ($this->auctions as $key => $value) { ?><li>
                <div class="auctions-list-img-box">
                    <img src="">
                </div>
                <div class="auctions-list-info">
                </div>
            </li><? } ?>
        </ul>
    </div>
</div>
