<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo ((isset($this->_rootref['L_25_0012'])) ? $this->_rootref['L_25_0012'] : ((isset($MSG['25_0012'])) ? $MSG['25_0012'] : '{ L_25_0012 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L_842'])) ? $this->_rootref['L_842'] : ((isset($MSG['842'])) ? $MSG['842'] : '{ L_842 }')); ?></h4>
				<form name="errorlog" action="" method="post">
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
					<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } if ($this->_rootref['FEETYPE'] != ('')) {  ?>
                    <table width="98%" cellpadding="0" cellspacing="0">
                        <tr>
                        	<th colspan="6"><?php echo (isset($this->_rootref['FEETYPE'])) ? $this->_rootref['FEETYPE'] : ''; ?></th>
                        </tr>
	<?php if ($this->_rootref['B_SINGLE']) {  ?>
                        <tr>
                            <td width="109" height="22"><?php echo ((isset($this->_rootref['L_263'])) ? $this->_rootref['L_263'] : ((isset($MSG['263'])) ? $MSG['263'] : '{ L_263 }')); ?></td>
                            <td height="22" colspan="5">
                                <input type="text" size="12" name="value" value="<?php echo (isset($this->_rootref['VALUE'])) ? $this->_rootref['VALUE'] : ''; ?>"> <?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>
                            </td>
                        </tr>
	<?php } else { ?>
                        <tr>
                            <th width="120">&nbsp;</th>
                            <th width="120"><b><?php echo ((isset($this->_rootref['L_240'])) ? $this->_rootref['L_240'] : ((isset($MSG['240'])) ? $MSG['240'] : '{ L_240 }')); ?> (<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>)</b></th>
                            <th width="120"><b><?php echo ((isset($this->_rootref['L_241'])) ? $this->_rootref['L_241'] : ((isset($MSG['241'])) ? $MSG['241'] : '{ L_241 }')); ?> (<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>)</b></th>
                            <th width="120"><b><?php echo ((isset($this->_rootref['L_391'])) ? $this->_rootref['L_391'] : ((isset($MSG['391'])) ? $MSG['391'] : '{ L_391 }')); ?> (<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>)</b></th>
                            <th><b><?php echo ((isset($this->_rootref['L_392'])) ? $this->_rootref['L_392'] : ((isset($MSG['392'])) ? $MSG['392'] : '{ L_392 }')); ?></b></th>
                            <th width="70" align="center"><b><?php echo ((isset($this->_rootref['L_008'])) ? $this->_rootref['L_008'] : ((isset($MSG['008'])) ? $MSG['008'] : '{ L_008 }')); ?></b></th>
                        </tr>
		<?php $_fees_count = (isset($this->_tpldata['fees'])) ? sizeof($this->_tpldata['fees']) : 0;if ($_fees_count) {for ($_fees_i = 0; $_fees_i < $_fees_count; ++$_fees_i){$_fees_val = &$this->_tpldata['fees'][$_fees_i]; ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <input type="hidden" name="tier_id[]" value="<?php echo $_fees_val['ID']; ?>">
                                <input name="fee_from[]" type="text" value="<?php echo $_fees_val['FROM']; ?>" size="9">
                            </td>
                            <td><input name="fee_to[]" type="text" value="<?php echo $_fees_val['TO']; ?>" size="9"></td>
                            <td><input name="value[]" type="text" value="<?php echo $_fees_val['VALUE']; ?>" size="9"></td>
                            <td>
                                <select name="type[]">
                                    <option value="flat"<?php echo $_fees_val['FLATTYPE']; ?>><?php echo ((isset($this->_rootref['L_393'])) ? $this->_rootref['L_393'] : ((isset($MSG['393'])) ? $MSG['393'] : '{ L_393 }')); ?></option>
                                    <option value="perc"<?php echo $_fees_val['PERCTYPE']; ?>><?php echo ((isset($this->_rootref['L_357'])) ? $this->_rootref['L_357'] : ((isset($MSG['357'])) ? $MSG['357'] : '{ L_357 }')); ?></option>
                                </select>
                            </td>
                            <td align="center"><input type="checkbox" name="fee_delete[]" value="<?php echo $_fees_val['ID']; ?>"></td>
                        </tr>
		<?php }} ?>
                        <tr>
                            <td><?php echo ((isset($this->_rootref['L_394'])) ? $this->_rootref['L_394'] : ((isset($MSG['394'])) ? $MSG['394'] : '{ L_394 }')); ?></td>
                            <td><input name="new_fee_from" type="text" size="9" value="<?php echo (isset($this->_rootref['FEE_FROM'])) ? $this->_rootref['FEE_FROM'] : ''; ?>"></td>
                            <td><input name="new_fee_to" type="text" size="9" value="<?php echo (isset($this->_rootref['FEE_TO'])) ? $this->_rootref['FEE_TO'] : ''; ?>"></td>
                            <td><input name="new_value" type="text" size="9" value="<?php echo (isset($this->_rootref['FEE_VALUE'])) ? $this->_rootref['FEE_VALUE'] : ''; ?>"></td>
                            <td>
                                <select name="new_type">
                                    <option value="flat"<?php if ($this->_rootref['FEE_TYPE'] == ('flat')) {  ?> selected<?php } ?>><?php echo ((isset($this->_rootref['L_393'])) ? $this->_rootref['L_393'] : ((isset($MSG['393'])) ? $MSG['393'] : '{ L_393 }')); ?></option>
                                    <option value="perc"<?php if ($this->_rootref['FEE_TYPE'] == ('perc')) {  ?> selected<?php } ?>><?php echo ((isset($this->_rootref['L_357'])) ? $this->_rootref['L_357'] : ((isset($MSG['357'])) ? $MSG['357'] : '{ L_357 }')); ?></option>
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
	<?php } ?>
                    </table>
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                    <input type="submit" name="act" class="centre" value="<?php echo ((isset($this->_rootref['L_530'])) ? $this->_rootref['L_530'] : ((isset($MSG['530'])) ? $MSG['530'] : '{ L_530 }')); ?>">
                    <div class="plain-box">&nbsp;</div>
<?php } ?>
					<table width="98%" cellpadding="0" cellspacing="0">
                        <tr>
                            <th colspan="2"><b><?php echo ((isset($this->_rootref['L_417'])) ? $this->_rootref['L_417'] : ((isset($MSG['417'])) ? $MSG['417'] : '{ L_417 }')); ?></b></th>
                        </tr>
                        <tr>
                            <td width="50%"><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=signup_fee"><?php echo ((isset($this->_rootref['L_430'])) ? $this->_rootref['L_430'] : ((isset($MSG['430'])) ? $MSG['430'] : '{ L_430 }')); ?></a></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th colspan="2"><b><?php echo ((isset($this->_rootref['L_431'])) ? $this->_rootref['L_431'] : ((isset($MSG['431'])) ? $MSG['431'] : '{ L_431 }')); ?></b></th>
                        </tr>
                        <tr>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=setup"><?php echo ((isset($this->_rootref['L_432'])) ? $this->_rootref['L_432'] : ((isset($MSG['432'])) ? $MSG['432'] : '{ L_432 }')); ?></a> </td>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=relist_fee"><?php echo ((isset($this->_rootref['L_437'])) ? $this->_rootref['L_437'] : ((isset($MSG['437'])) ? $MSG['437'] : '{ L_437 }')); ?></a> </td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=hpfeat_fee"><?php echo ((isset($this->_rootref['L_433'])) ? $this->_rootref['L_433'] : ((isset($MSG['433'])) ? $MSG['433'] : '{ L_433 }')); ?></a> </td>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=bolditem_fee"><?php echo ((isset($this->_rootref['L_439'])) ? $this->_rootref['L_439'] : ((isset($MSG['439'])) ? $MSG['439'] : '{ L_439 }')); ?></a> </td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=hlitem_fee"><?php echo ((isset($this->_rootref['L_434'])) ? $this->_rootref['L_434'] : ((isset($MSG['434'])) ? $MSG['434'] : '{ L_434 }')); ?></a> </td>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=rp_fee"><?php echo ((isset($this->_rootref['L_440'])) ? $this->_rootref['L_440'] : ((isset($MSG['440'])) ? $MSG['440'] : '{ L_440 }')); ?></a> </td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=picture_fee"><?php echo ((isset($this->_rootref['L_435'])) ? $this->_rootref['L_435'] : ((isset($MSG['435'])) ? $MSG['435'] : '{ L_435 }')); ?></a> </td>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=buyout_fee"><?php echo ((isset($this->_rootref['L_436'])) ? $this->_rootref['L_436'] : ((isset($MSG['436'])) ? $MSG['436'] : '{ L_436 }')); ?></a> </td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=buyer_fee"><?php echo ((isset($this->_rootref['L_775'])) ? $this->_rootref['L_775'] : ((isset($MSG['775'])) ? $MSG['775'] : '{ L_775 }')); ?></a></td>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=endauc_fee"><?php echo ((isset($this->_rootref['L_791'])) ? $this->_rootref['L_791'] : ((isset($MSG['791'])) ? $MSG['791'] : '{ L_791 }')); ?></a></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=subtitle_fee"><?php echo ((isset($this->_rootref['L_803'])) ? $this->_rootref['L_803'] : ((isset($MSG['803'])) ? $MSG['803'] : '{ L_803 }')); ?></a></td>
                            <td><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php?type=excat_fee"><?php echo ((isset($this->_rootref['L_804'])) ? $this->_rootref['L_804'] : ((isset($MSG['804'])) ? $MSG['804'] : '{ L_804 }')); ?></a></td>
                        </tr>
                    </table>
				</form>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>