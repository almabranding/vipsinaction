<div id="gift-header">
    <a href="<?=URL?>gift/make-a-gift" class="gift-block <?=($this->section=='makeagift')?'selected':''?>" id="make-a-gift">
        <div class="labelSelected"></div>
        <div class="label">
            <h2 class='uppercase'><?=$this->lang['make a']?></h2>
            <h1 class='uppercase'><?=$this->lang['gift']?></h1>
            <p><?=$this->lang['gift_subtitule1']?></p>
        </div>   
    </a><a href="<?=URL?>gift/chose-a-gift" class="gift-block <?=($this->section=='choseagift')?'selected':''?>" id="chose-your-gift" >
        <div class="labelSelected"></div>
         <div class="label">
            <h2  class='uppercase'><?=$this->lang['chose your']?></h2>
            <h1  class='uppercase'><?=$this->lang['gift']?></h1>
            <p><?=$this->lang['gift_subtitule2']?></p>
        </div>   
    </a>
</div>