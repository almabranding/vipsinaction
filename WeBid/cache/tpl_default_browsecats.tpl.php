<div class="tableContent2">
	<div class="titTable2 rounded-top rounded-bottom">
		<a href="browse.php?id=0"><?php echo ((isset($this->_rootref['L_287'])) ? $this->_rootref['L_287'] : ((isset($MSG['287'])) ? $MSG['287'] : '{ L_287 }')); ?></a> : <?php echo (isset($this->_rootref['CAT_STRING'])) ? $this->_rootref['CAT_STRING'] : ''; ?>
	</div>
	<div class="table2">
<?php if ($this->_rootref['TOP_HTML'] != ('')) {  ?>
		<table width="98%" border="0" cellspacing="0" cellpadding="4">
			<?php echo (isset($this->_rootref['TOP_HTML'])) ? $this->_rootref['TOP_HTML'] : ''; ?>
		</table>
<?php } ?>
		<br>
<?php if ($this->_rootref['NUM_AUCTIONS'] > 0) {  if ($this->_rootref['ID'] > 0) {  ?>
		<form name="catsearch" action="?id=<?php echo (isset($this->_rootref['ID'])) ? $this->_rootref['ID'] : ''; ?>" method="post">
        <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
		<table width="98%" border="0" cellspacing="0" cellpadding="4" class="catsearch">
			<tr>
				<td><?php echo ((isset($this->_rootref['L_30_0070'])) ? $this->_rootref['L_30_0070'] : ((isset($MSG['30_0070'])) ? $MSG['30_0070'] : '{ L_30_0070 }')); ?>&nbsp;<input type="text" name="catkeyword" size="20">&nbsp;<input type="submit" name="" value="<?php echo ((isset($this->_rootref['L_103'])) ? $this->_rootref['L_103'] : ((isset($MSG['103'])) ? $MSG['103'] : '{ L_103 }')); ?>" class="button">
				&nbsp;&nbsp;<a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>adsearch.php"><?php echo ((isset($this->_rootref['L_464'])) ? $this->_rootref['L_464'] : ((isset($MSG['464'])) ? $MSG['464'] : '{ L_464 }')); ?></a></td>
			</tr>
		</table>
		</form>
	<?php } $this->_tpl_include('browse.tpl'); } else { ?>
		<div class="padding" align="center">
			<?php echo ((isset($this->_rootref['L_198'])) ? $this->_rootref['L_198'] : ((isset($MSG['198'])) ? $MSG['198'] : '{ L_198 }')); ?>
		</div>
<?php } ?>
	</div>
</div>