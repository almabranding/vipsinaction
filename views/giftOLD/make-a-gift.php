<?include('gift-header.php')?>
<div id="gift-wrapper">
    <div class="separator"></div>
    <h1 class='uppercase'><?=$this->lang['make a gift']?></h1>
    <div class="separator"></div>
    <div class="content">
        <?=$this->article['content']?>
    </div>
   
<?= $this->giftForm->render('views/templates/select-gift.php',false,array('view'=>$this)) ?>
 </div>