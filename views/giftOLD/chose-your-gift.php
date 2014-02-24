<?include('gift-header.php')?>
<div id="gift-wrapper">
    <div class="separator"></div>
    <h1 class='uppercase'><?=$this->lang['chose your gift']?></h1>
    <div class="separator"></div>
    <div class="content">
        <?=$this->article['content']?>
    </div>
    
    <div class="separator"></div><br>
    <ul id="chose-gift-type">
        <li class="<?=($this->type=='all')?'selected':''?>"><a href="<?=URL?>gift/chose-a-gift"><span class="title"><?=$this->lang['all']?></span></a></li>
        <?foreach($this->gift as $gift){?>
        <li class="<?=($this->type==$gift['name']?'selected':'')?>"><a href="<?=URL?>gift/chose-a-gift/<?=$gift['name']?>" style="color:<?=$gift['color']?>"><span class="title"><?=$this->lang['card'].' '.$gift['name']?></span></a></li>
<?}?>
    </ul><br><br>
 
    <ul id="results-list" class="gift-list">
        <?if($this->rooms)foreach($this->rooms as $room){?><li>
            <div class="label" style="background-color:<?=$room['color']?>">CARD <?=$room['gname']?><div class="numPersons"><?=$room['places']?> <span class="xPersons">X</span> <i class="result-list-person"></i></div></div>
        <div class="cover">
            <h1><?=$room['name'];?></h1>
            <div class="img">
                <img src="<?= UPLOAD .Model::getRouteImg($room['gallery'][0]['created_at']).$room['gallery'][0]['file_name'] ?>">
            </div>
            <div class="description">
                <?=$room['content']?>
                <a href="/gift/detail/<?=$room['gift_id']?>/<?=$room['name']?>" class="more"><?=$this->lang['more']?></a>
            </div>
        </div>
        </li>
        <?}?>
    </ul>
   </div>