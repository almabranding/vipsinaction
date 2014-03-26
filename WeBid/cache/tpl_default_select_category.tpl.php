<style type="text/css">.box {height: 100; width:300;}</style>
<script type="text/javascript">
function SubmitBoxes(N)
{
	$('#catformbox').val(N);
	$('#catform').submit();
}
</script>
<div class="content">
	<div class="tableContent2">
	<div class="titTable2"><?php echo ((isset($this->_rootref['L_028'])) ? $this->_rootref['L_028'] : ((isset($MSG['028'])) ? $MSG['028'] : '{ L_028 }')); ?></div>
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
		<div class="error-box">
			<?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?>
		</div>
<?php } ?>
		<a name="goto"></a>
		<form name="catform" id="catform" action="select_category.php#goto" method="post">
        <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
		<input type="hidden" name="action" value="process">
		<input type="hidden" name="box" value="" id="catformbox">
		<input type="hidden" name="cat_no" value="<?php echo (isset($this->_rootref['CAT_NO'])) ? $this->_rootref['CAT_NO'] : ''; ?>">
		<table width="80%" border="0" cellpadding="4" class="content">
		<tr>
		  <td colspan="2" valign="top">
			<?php if ($this->_rootref['CAT_NO'] == (2)) {  echo ((isset($this->_rootref['L_2__0041'])) ? $this->_rootref['L_2__0041'] : ((isset($MSG['2__0041'])) ? $MSG['2__0041'] : '{ L_2__0041 }')); ?> <?php echo (isset($this->_rootref['COST'])) ? $this->_rootref['COST'] : ''; } else { echo ((isset($this->_rootref['L_2__0038'])) ? $this->_rootref['L_2__0038'] : ((isset($MSG['2__0038'])) ? $MSG['2__0038'] : '{ L_2__0038 }')); } ?>
		  </td>
		</tr>
		<tr> 
<?php $_boxes_count = (isset($this->_tpldata['boxes'])) ? sizeof($this->_tpldata['boxes']) : 0;if ($_boxes_count) {for ($_boxes_i = 0; $_boxes_i < $_boxes_count; ++$_boxes_i){$_boxes_val = &$this->_tpldata['boxes'][$_boxes_i]; ?>
		  <td align="center" style="width:<?php echo $_boxes_val['PERCENT']; ?>%;">
			  <select name="cat<?php echo $_boxes_val['I']; ?>" class="box" size="15" onClick="SubmitBoxes(<?php echo $_boxes_val['I']; ?>)" style="width:230px;">
	<?php $_cats_count = (isset($_boxes_val['cats'])) ? sizeof($_boxes_val['cats']) : 0;if ($_cats_count) {for ($_cats_i = 0; $_cats_i < $_cats_count; ++$_cats_i){$_cats_val = &$_boxes_val['cats'][$_cats_i]; ?>
				<option value="<?php echo $_cats_val['K']; ?>" <?php echo $_cats_val['SELECTED']; ?>><?php echo $_cats_val['CATNAME']; ?></option>
	<?php }} ?>
			  </select>
		   </td>
	<?php if ($_boxes_val['B_NOWLINE']) {  ?>
		</tr>
		<tr>
	<?php } }} ?>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td align="center" colspan="3" >
<?php if ($this->_rootref['B_SHOWBUTTON']) {  ?>
	  <input type="submit" name="submitit" value="<?php echo ((isset($this->_rootref['L_2__0047'])) ? $this->_rootref['L_2__0047'] : ((isset($MSG['2__0047'])) ? $MSG['2__0047'] : '{ L_2__0047 }')); ?>" class="button">
<?php } ?>
		  </td>
		</tr>
		</table>
		</form>
<?php if ($this->_rootref['CAT_NO'] == (2) && ! $this->_rootref['B_SHOWBUTTON']) {  ?>
		<div class="padding" style="text-align:right;">
		<form name="catform" action="sell.php" method="post">
        	<input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
			<input type="hidden" name="act" value="skipexcat">
			<input type="submit" name="submitit" value="<?php echo ((isset($this->_rootref['L_805'])) ? $this->_rootref['L_805'] : ((isset($MSG['805'])) ? $MSG['805'] : '{ L_805 }')); ?>" class="button">
		</form>
		</div>
<?php } ?>
	</div>
</div>