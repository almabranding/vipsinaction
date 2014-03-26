<?php if ($this->_rootref['B_FEATURED_ITEMS']) {  ?>
	<table width="99%" border="0" cellspacing="1" cellpadding="4">
    <?php $_featured_items_count = (isset($this->_tpldata['featured_items'])) ? sizeof($this->_tpldata['featured_items']) : 0;if ($_featured_items_count) {for ($_featured_items_i = 0; $_featured_items_i < $_featured_items_count; ++$_featured_items_i){$_featured_items_val = &$this->_tpldata['featured_items'][$_featured_items_i]; ?>
		<tr align="center">
			<td align="center" width="15%">
				<a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_featured_items_val['ID']; ?>"><img src="<?php echo $_featured_items_val['IMAGE']; ?>" border="0"></a>
			</td>
			<td align="left"<?php if ($_featured_items_val['B_BOLD']) {  ?> style="font-weight: bold;"<?php } ?>>
                <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_featured_items_val['ID']; ?>" class="bigfont"><?php echo $_featured_items_val['TITLE']; ?></a>
				<?php if ($this->_rootref['B_SUBTITLE'] && $_featured_items_val['SUBTITLE'] != ('')) {  ?><p class="smallspan"><?php echo $_featured_items_val['SUBTITLE']; ?></p><?php } ?>
				<p><?php echo ((isset($this->_rootref['L_949'])) ? $this->_rootref['L_949'] : ((isset($MSG['949'])) ? $MSG['949'] : '{ L_949 }')); ?> <?php echo $_featured_items_val['CLOSES']; ?></p>
			</td>
			<td align="center" width="15%">
	<?php if ($_featured_items_val['BUY_NOW'] != ('')) {  ?>
				<span class="redfont bigfont"><?php echo $_featured_items_val['BUY_NOW']; ?></span>
	<?php } else { ?>
				<span class="grayfont"><?php echo ((isset($this->_rootref['L_951'])) ? $this->_rootref['L_951'] : ((isset($MSG['951'])) ? $MSG['951'] : '{ L_951 }')); ?></span>
	<?php } ?>
			</td>
			<td align="center" width="15%">
				<span class="bigfont"><?php echo $_featured_items_val['BIDFORM']; ?></span>
				<p class="smallspan"><?php echo $_featured_items_val['NUMBIDS']; ?></p>
			</td>
		</tr>
    <?php }} ?>
	</table>
    <br class="spacer">
<?php } ?>

	<table width="99%" border="0" cellspacing="1" cellpadding="4">
<?php $_items_count = (isset($this->_tpldata['items'])) ? sizeof($this->_tpldata['items']) : 0;if ($_items_count) {for ($_items_i = 0; $_items_i < $_items_count; ++$_items_i){$_items_val = &$this->_tpldata['items'][$_items_i]; ?>
		<tr align="center" <?php echo $_items_val['ROWCOLOUR']; ?>>
			<td align="center" width="15%">
				<a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_items_val['ID']; ?>"><img src="<?php echo $_items_val['IMAGE']; ?>" border="0"></a>
			</td>
			<td align="left"<?php if ($_items_val['B_BOLD']) {  ?> style="font-weight: bold;"<?php } ?>>
                <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_items_val['ID']; ?>" class="bigfont"><?php echo $_items_val['TITLE']; ?></a>
				<?php if ($this->_rootref['B_SUBTITLE'] && $_items_val['SUBTITLE'] != ('')) {  ?><p class="smallspan"><?php echo $_items_val['SUBTITLE']; ?></p><?php } ?>
				<p><?php echo ((isset($this->_rootref['L_949'])) ? $this->_rootref['L_949'] : ((isset($MSG['949'])) ? $MSG['949'] : '{ L_949 }')); ?> <?php echo $_items_val['CLOSES']; ?></p>
			</td>
			<td align="center" width="15%">
	<?php if ($_items_val['BUY_NOW'] != ('')) {  ?>
				<span class="redfont bigfont"><?php echo $_items_val['BUY_NOW']; ?></span>
	<?php } else { ?>
				<span class="grayfont"><?php echo ((isset($this->_rootref['L_951'])) ? $this->_rootref['L_951'] : ((isset($MSG['951'])) ? $MSG['951'] : '{ L_951 }')); ?></span>
	<?php } ?>
			</td>
			<td align="center" width="15%">
				<span class="bigfont"><?php echo $_items_val['BIDFORM']; ?></span>
				<p class="smallspan"><?php echo $_items_val['NUMBIDS']; ?></p>
			</td>
		</tr>
<?php }} ?>
		<tr align="center">
			<td colspan="4"><?php echo (isset($this->_rootref['NUM_AUCTIONS'])) ? $this->_rootref['NUM_AUCTIONS'] : ''; ?></td>
		</tr>
	</table>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td align="center">
				<?php echo ((isset($this->_rootref['L_5117'])) ? $this->_rootref['L_5117'] : ((isset($MSG['5117'])) ? $MSG['5117'] : '{ L_5117 }')); ?>&nbsp;<?php echo (isset($this->_rootref['PAGE'])) ? $this->_rootref['PAGE'] : ''; ?>&nbsp;<?php echo ((isset($this->_rootref['L_5118'])) ? $this->_rootref['L_5118'] : ((isset($MSG['5118'])) ? $MSG['5118'] : '{ L_5118 }')); ?>&nbsp;<?php echo (isset($this->_rootref['PAGES'])) ? $this->_rootref['PAGES'] : ''; ?>
				<br>
				<?php echo (isset($this->_rootref['PREV'])) ? $this->_rootref['PREV'] : ''; ?>
<?php $_pages_count = (isset($this->_tpldata['pages'])) ? sizeof($this->_tpldata['pages']) : 0;if ($_pages_count) {for ($_pages_i = 0; $_pages_i < $_pages_count; ++$_pages_i){$_pages_val = &$this->_tpldata['pages'][$_pages_i]; ?>
				<?php echo $_pages_val['PAGE']; ?>&nbsp;&nbsp;
<?php }} ?>
				<?php echo (isset($this->_rootref['NEXT'])) ? $this->_rootref['NEXT'] : ''; ?>
			</td>
		</tr>
	</table>