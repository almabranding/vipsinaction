<div class='mainWrapper'><h1><?= $this->lang['my_account'] ?></h1>
<div class="container-border" id="user">
    <? $this->userForm->render('views/templates/user-template.php', false, array("lang"=>$this->lang,"user"=>$this->user)); ?>
</div>
</div>
