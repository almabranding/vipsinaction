<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo ((isset($this->_rootref['L_5142'])) ? $this->_rootref['L_5142'] : ((isset($MSG['5142'])) ? $MSG['5142'] : '{ L_5142 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L_276'])) ? $this->_rootref['L_276'] : ((isset($MSG['276'])) ? $MSG['276'] : '{ L_276 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L_132'])) ? $this->_rootref['L_132'] : ((isset($MSG['132'])) ? $MSG['132'] : '{ L_132 }')); ?></h4>
				<form name="errorlog" action="" method="post">
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
					<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } ?>
                    <div class="plain-box">
                         <p><?php echo ((isset($this->_rootref['L_161'])) ? $this->_rootref['L_161'] : ((isset($MSG['161'])) ? $MSG['161'] : '{ L_161 }')); ?></p>
<?php $_langs_count = (isset($this->_tpldata['langs'])) ? sizeof($this->_tpldata['langs']) : 0;if ($_langs_count) {for ($_langs_i = 0; $_langs_i < $_langs_count; ++$_langs_i){$_langs_val = &$this->_tpldata['langs'][$_langs_i]; ?>
                       	 <a href="categoriestrans.php?lang=<?php echo $_langs_val['LANG']; ?>"><img align="middle" src="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>inc/flags/<?php echo $_langs_val['LANG']; ?>.gif" border="0"></a>
<?php }} ?>
                    </div>
                    <table width="98%" cellpadding="0" cellspacing="0" class="blank">
                    <tr>
                        <th><b><?php echo ((isset($this->_rootref['L_771'])) ? $this->_rootref['L_771'] : ((isset($MSG['771'])) ? $MSG['771'] : '{ L_771 }')); ?></b></th>
                        <th><b><?php echo ((isset($this->_rootref['L_772'])) ? $this->_rootref['L_772'] : ((isset($MSG['772'])) ? $MSG['772'] : '{ L_772 }')); ?></b></th>
                    </tr>
<?php $_cats_count = (isset($this->_tpldata['cats'])) ? sizeof($this->_tpldata['cats']) : 0;if ($_cats_count) {for ($_cats_i = 0; $_cats_i < $_cats_count; ++$_cats_i){$_cats_val = &$this->_tpldata['cats'][$_cats_i]; ?>
                    <tr <?php echo $_cats_val['BG']; ?>>
                        <td><input type="text" name="categories_o[]" value="<?php echo $_cats_val['CAT_NAME']; ?>" size="45" disabled></td>
                        <td><input type="text" name="categories[<?php echo $_cats_val['CAT_ID']; ?>]" value="<?php echo $_cats_val['TRAN_CAT']; ?>" size="45"></td>
                    </tr>
<?php }} ?>
                    </table>
                    <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                    <input type="submit" name="act" class="centre" value="<?php echo ((isset($this->_rootref['L_089'])) ? $this->_rootref['L_089'] : ((isset($MSG['089'])) ? $MSG['089'] : '{ L_089 }')); ?>">
				</form>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>