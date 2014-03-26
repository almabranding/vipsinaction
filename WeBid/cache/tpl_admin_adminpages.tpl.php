<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo (isset($this->_rootref['TYPENAME'])) ? $this->_rootref['TYPENAME'] : ''; ?>&nbsp;&gt;&gt;&nbsp;<?php echo (isset($this->_rootref['PAGENAME'])) ? $this->_rootref['PAGENAME'] : ''; ?></h4>
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
					<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } ?>
                <form name="conf" action="" method="post" enctype="multipart/form-data">
				<table width="98%" cellpadding="2" align="center" class="blank">
<?php $_block_count = (isset($this->_tpldata['block'])) ? sizeof($this->_tpldata['block']) : 0;if ($_block_count) {for ($_block_i = 0; $_block_i < $_block_count; ++$_block_i){$_block_val = &$this->_tpldata['block'][$_block_i]; ?>
					<tr valign="top">
  <?php if ($_block_val['B_HEADER']) {  ?>
						<td colspan="2" style="padding:3px; border-top:#0083D7 1px solid; background:#ECECEC;">
                        	<b><?php echo $_block_val['TITLE']; ?></b>
						</td>
  <?php } else { ?>
						<td width="175"><?php echo $_block_val['TITLE']; ?></td>
						<td style="padding:3px;">
							<?php echo $_block_val['DESCRIPTION']; ?>
	<?php if ($_block_val['TYPE'] == ('yesno')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="y"<?php if ($_block_val['DEFAULT'] == ('y')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="n"<?php if ($_block_val['DEFAULT'] == ('n')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?>
	<?php } else if ($_block_val['TYPE'] == ('batch')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="1"<?php if ($_block_val['DEFAULT'] == ('1')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="2"<?php if ($_block_val['DEFAULT'] == ('2')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?>
	<?php } else if ($_block_val['TYPE'] == ('batchstacked')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="1"<?php if ($_block_val['DEFAULT'] == ('1')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?>
				<br><input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="2"<?php if ($_block_val['DEFAULT'] == ('2')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?>	
	<?php } else if ($_block_val['TYPE'] == ('datestacked')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="USA"<?php if ($_block_val['DEFAULT'] == ('USA')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?>
				<br><input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="EUR"<?php if ($_block_val['DEFAULT'] == ('EUR')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?>	
	<?php } else if ($_block_val['TYPE'] == ('select3num')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="0"<?php if ($_block_val['DEFAULT'] == ('0')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?><br>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="1"<?php if ($_block_val['DEFAULT'] == ('1')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?><br>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="2"<?php if ($_block_val['DEFAULT'] == ('2')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE3']; ?><br>
	<?php } else if ($_block_val['TYPE'] == ('select3contact')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="always"<?php if ($_block_val['DEFAULT'] == ('always')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?><br>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="logged"<?php if ($_block_val['DEFAULT'] == ('logged')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?><br>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="never"<?php if ($_block_val['DEFAULT'] == ('never')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE3']; ?><br>
	<?php } else if ($_block_val['TYPE'] == ('text')) {  ?>
				<input type="text" name="<?php echo $_block_val['NAME']; ?>" value="<?php echo $_block_val['DEFAULT']; ?>" size="50" maxlength="255">
	<?php } else if ($_block_val['TYPE'] == ('password')) {  ?>
				<input type="password" name="<?php echo $_block_val['NAME']; ?>" value="<?php echo $_block_val['DEFAULT']; ?>" size="50" maxlength="255">
	<?php } else if ($_block_val['TYPE'] == ('textarea')) {  ?>
				<textarea name="<?php echo $_block_val['NAME']; ?>" cols="65" rows="10"><?php echo $_block_val['DEFAULT']; ?></textarea>
	<?php } else if ($_block_val['TYPE'] == ('days')) {  ?>
				<input type="text" name="<?php echo $_block_val['NAME']; ?>" value="<?php echo $_block_val['DEFAULT']; ?>" size="4" maxlength="4"> <?php echo $_block_val['TAGLINE1']; ?>
	<?php } else if ($_block_val['TYPE'] == ('percent')) {  ?>
				<input type="text" name="<?php echo $_block_val['NAME']; ?>" value="<?php echo $_block_val['DEFAULT']; ?>" size="3" maxlength="3"> <?php echo $_block_val['TAGLINE1']; ?>
	<?php } else if ($_block_val['TYPE'] == ('decimals')) {  ?>
				<input type="text" name="<?php echo $_block_val['NAME']; ?>" value="<?php echo $_block_val['DEFAULT']; ?>" size="5" maxlength="10"> <?php echo $_block_val['TAGLINE1']; ?>
	<?php } else if ($_block_val['TYPE'] == ('yesnostacked')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="y"<?php if ($_block_val['DEFAULT'] == ('y')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?>
				<br><input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="n"<?php if ($_block_val['DEFAULT'] == ('n')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?>
	<?php } else if ($_block_val['TYPE'] == ('sortstacked')) {  ?>
				<input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="alpha"<?php if ($_block_val['DEFAULT'] == ('alpha')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?>
				<br><input type="radio" name="<?php echo $_block_val['NAME']; ?>" value="counter"<?php if ($_block_val['DEFAULT'] == ('counter')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE2']; ?>
	<?php } else if ($_block_val['TYPE'] == ('checkbox')) {  ?>
				<input type="checkbox" name="<?php echo $_block_val['NAME']; ?>" id="<?php echo $_block_val['DEFAULT']; ?>" value="y"<?php if ($_block_val['DEFAULT'] == ('y')) {  ?> checked<?php } ?>> <?php echo $_block_val['TAGLINE1']; ?>
	<?php } else if ($_block_val['TYPE'] == ('dropdown')) {  ?>
		  			<div class="Browse">
				<?php echo (isset($this->_rootref['DROPDOWN'])) ? $this->_rootref['DROPDOWN'] : ''; ?>
	<?php } else if ($_block_val['TYPE'] == ('upload')) {  ?>
				<input type="file" name="<?php echo $_block_val['NAME']; ?>" size="25" maxlength="100">
				<input type="hidden" name="MAX_FILE_SIZE" value="51200">
	<?php } else if ($_block_val['TYPE'] == ('image')) {  ?>
				<img src="<?php echo (isset($this->_rootref['IMAGEURL'])) ? $this->_rootref['IMAGEURL'] : ''; ?>"><?php echo $_block_val['TAGLINE1']; ?><br>
	<?php } else if ($_block_val['TYPE'] == ('link')) {  ?>
				<a href="<?php echo (isset($this->_rootref['LINKURL'])) ? $this->_rootref['LINKURL'] : ''; ?>"><?php echo $_block_val['TAGLINE1']; ?></a>
	<?php } else { ?>
				<?php echo $_block_val['TYPE']; ?>
	<?php } ?>
						</td>
  <?php } ?>
					</tr>
<?php }} ?>
				</table>
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                    <input type="submit" name="act" class="centre" value="<?php echo ((isset($this->_rootref['L_530'])) ? $this->_rootref['L_530'] : ((isset($MSG['530'])) ? $MSG['530'] : '{ L_530 }')); ?>">
				</form>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>