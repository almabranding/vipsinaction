<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo ((isset($this->_rootref['L_5142'])) ? $this->_rootref['L_5142'] : ((isset($MSG['5142'])) ? $MSG['5142'] : '{ L_5142 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L_276'])) ? $this->_rootref['L_276'] : ((isset($MSG['276'])) ? $MSG['276'] : '{ L_276 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L_078'])) ? $this->_rootref['L_078'] : ((isset($MSG['078'])) ? $MSG['078'] : '{ L_078 }')); ?></h4>
				<form name="newcat" action="" method="post">
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
					<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } ?>
					<div class="plain-box"><?php echo ((isset($this->_rootref['L_845'])) ? $this->_rootref['L_845'] : ((isset($MSG['845'])) ? $MSG['845'] : '{ L_845 }')); ?></div>
                    <table width="98%" cellpadding="0" cellspacing="0" class="blank">
                        <tr> 
                            <td width="10" height="21">&nbsp;</td>
                            <td colspan="4" height="21"><?php echo (isset($this->_rootref['CRUMBS'])) ? $this->_rootref['CRUMBS'] : ''; ?></td>
                        </tr>
                        <tr>
                            <th width="10">&nbsp;</th>
                            <th width="40%"><b><?php echo ((isset($this->_rootref['L_087'])) ? $this->_rootref['L_087'] : ((isset($MSG['087'])) ? $MSG['087'] : '{ L_087 }')); ?></b></th>
                            <th width="20%"><b><?php echo ((isset($this->_rootref['L_328'])) ? $this->_rootref['L_328'] : ((isset($MSG['328'])) ? $MSG['328'] : '{ L_328 }')); ?></b></th>
                            <th width="20%"><b><?php echo ((isset($this->_rootref['L_329'])) ? $this->_rootref['L_329'] : ((isset($MSG['329'])) ? $MSG['329'] : '{ L_329 }')); ?></b></th>
                            <th><b><?php echo ((isset($this->_rootref['L_008'])) ? $this->_rootref['L_008'] : ((isset($MSG['008'])) ? $MSG['008'] : '{ L_008 }')); ?></b></th>
                        </tr>
<?php $_cats_count = (isset($this->_tpldata['cats'])) ? sizeof($this->_tpldata['cats']) : 0;if ($_cats_count) {for ($_cats_i = 0; $_cats_i < $_cats_count; ++$_cats_i){$_cats_val = &$this->_tpldata['cats'][$_cats_i]; ?>
                        <tr>
                            <td width="10" align="right" valign="middle">
                                <a href="categories.php?parent=<?php echo $_cats_val['CAT_ID']; ?>"><img src="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>images/plus.gif" border="0" alt="Browse Subcategories"></a>
                            </td>
                            <td><input type="text" name="categories[<?php echo $_cats_val['CAT_ID']; ?>]" value="<?php echo $_cats_val['CAT_NAME']; ?>" size="50"></td>
                            <td><input type="text" name="colour[<?php echo $_cats_val['CAT_ID']; ?>]" value="<?php echo $_cats_val['CAT_COLOUR']; ?>" size="25"></td>
                            <td><input type="text" name="image[<?php echo $_cats_val['CAT_ID']; ?>]" value="<?php echo $_cats_val['CAT_IMAGE']; ?>" size="25"></td>
                            <td valign="middle">
                            	<input type="checkbox" name="delete[]" value="<?php echo $_cats_val['CAT_ID']; ?>">
    <?php if ($_cats_val['B_SUBCATS']) {  ?>
                                <img src="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>themes/admin/images/bullet_blue.png">
    <?php } if ($_cats_val['B_AUCTIONS']) {  ?>
                                <img src="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>themes/admin/images/bullet_red.png">
    <?php } ?>
                            </td>
                        </tr>
<?php }} ?>
                        <tr>
                            <td colspan="4" align="right"><?php echo ((isset($this->_rootref['L_30_0102'])) ? $this->_rootref['L_30_0102'] : ((isset($MSG['30_0102'])) ? $MSG['30_0102'] : '{ L_30_0102 }')); ?></td>
                            <td><input type="checkbox" class="selectall" value="delete"></td>
                        </tr>
                        <tr>
                            <td><?php echo ((isset($this->_rootref['L_394'])) ? $this->_rootref['L_394'] : ((isset($MSG['394'])) ? $MSG['394'] : '{ L_394 }')); ?></td>
                            <td><input type="text" name="new_category" size="25"></td>
                            <td><input type="text" name="cat_colour" size="25"></td>
                            <td><input type="text" name="cat_image" size="25"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="5" height="22">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><?php echo ((isset($this->_rootref['L_368'])) ? $this->_rootref['L_368'] : ((isset($MSG['368'])) ? $MSG['368'] : '{ L_368 }')); ?></td>
                            <td colspan="3">
                                <textarea name="mass_add" cols="35" rows="6"></textarea>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="parent" value="<?php echo (isset($this->_rootref['PARENT'])) ? $this->_rootref['PARENT'] : ''; ?>">
                    <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                    <input type="submit" name="action" class="centre" value="<?php echo ((isset($this->_rootref['L_089'])) ? $this->_rootref['L_089'] : ((isset($MSG['089'])) ? $MSG['089'] : '{ L_089 }')); ?>">
				</form>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>