<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo ((isset($this->_rootref['L_25_0011'])) ? $this->_rootref['L_25_0011'] : ((isset($MSG['25_0011'])) ? $MSG['25_0011'] : '{ L_25_0011 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L__0008'])) ? $this->_rootref['L__0008'] : ((isset($MSG['_0008'])) ? $MSG['_0008'] : '{ L__0008 }')); ?></h4>
				<form name="deleteusers" action="" method="post">
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
					<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } ?>
					<div class="plain-box"><a href="newbannersuser.php"><?php echo ((isset($this->_rootref['L__0026'])) ? $this->_rootref['L__0026'] : ((isset($MSG['_0026'])) ? $MSG['_0026'] : '{ L__0026 }')); ?></a></div>
                    <table width="98%" cellpadding="0" cellspacing="0">
                    <tr>
                    	<th width="15%"><?php echo ((isset($this->_rootref['L_5180'])) ? $this->_rootref['L_5180'] : ((isset($MSG['5180'])) ? $MSG['5180'] : '{ L_5180 }')); ?></th>
                    	<th width="25%"><?php echo ((isset($this->_rootref['L__0022'])) ? $this->_rootref['L__0022'] : ((isset($MSG['_0022'])) ? $MSG['_0022'] : '{ L__0022 }')); ?></th>
                    	<th width="28%"><?php echo ((isset($this->_rootref['L_303'])) ? $this->_rootref['L_303'] : ((isset($MSG['303'])) ? $MSG['303'] : '{ L_303 }')); ?></th>
                    	<th width="11%"><?php echo ((isset($this->_rootref['L__0025'])) ? $this->_rootref['L__0025'] : ((isset($MSG['_0025'])) ? $MSG['_0025'] : '{ L__0025 }')); ?></th>
                    	<th width="10%">&nbsp;</th>
                    	<th width="11%"><?php echo ((isset($this->_rootref['L_008'])) ? $this->_rootref['L_008'] : ((isset($MSG['008'])) ? $MSG['008'] : '{ L_008 }')); ?></th>
                    </tr>
<?php $_busers_count = (isset($this->_tpldata['busers'])) ? sizeof($this->_tpldata['busers']) : 0;if ($_busers_count) {for ($_busers_i = 0; $_busers_i < $_busers_count; ++$_busers_i){$_busers_val = &$this->_tpldata['busers'][$_busers_i]; ?>
					<tr <?php echo $_busers_val['BG']; ?>>
                    	<td><a href="editbannersuser.php?id=<?php echo $_busers_val['ID']; ?>"><?php echo $_busers_val['NAME']; ?></a></td>
                    	<td><?php echo $_busers_val['COMPANY']; ?></td>
                    	<td><a href="mailto:<?php echo $_busers_val['EMAIL']; ?>"><?php echo $_busers_val['EMAIL']; ?></a></td>
                    	<td><?php echo $_busers_val['NUM_BANNERS']; ?></td>
                    	<td><a href="userbanners.php?id=<?php echo $_busers_val['ID']; ?>"><?php echo ((isset($this->_rootref['L__0024'])) ? $this->_rootref['L__0024'] : ((isset($MSG['_0024'])) ? $MSG['_0024'] : '{ L__0024 }')); ?></a></td>
                    	<td><input type="checkbox" name="delete[]" value="<?php echo $_busers_val['ID']; ?>"></td>
                    </tr>
<?php }} ?>
					</table>
                    <input type="hidden" name="action" value="deleteusers">
                    <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                    <input type="submit" name="act" class="centre" value="<?php echo ((isset($this->_rootref['L__0028'])) ? $this->_rootref['L__0028'] : ((isset($MSG['_0028'])) ? $MSG['_0028'] : '{ L__0028 }')); ?>">
				</form>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>