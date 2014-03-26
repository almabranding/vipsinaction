<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo ((isset($this->_rootref['L_25_0009'])) ? $this->_rootref['L_25_0009'] : ((isset($MSG['25_0009'])) ? $MSG['25_0009'] : '{ L_25_0009 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php if ($this->_rootref['B_EDIT_FILE']) {  if ($this->_rootref['FILENAME'] != ('')) {  echo ((isset($this->_rootref['L_298'])) ? $this->_rootref['L_298'] : ((isset($MSG['298'])) ? $MSG['298'] : '{ L_298 }')); ?>: <?php echo (isset($this->_rootref['FILENAME'])) ? $this->_rootref['FILENAME'] : ''; } else { echo ((isset($this->_rootref['L_518'])) ? $this->_rootref['L_518'] : ((isset($MSG['518'])) ? $MSG['518'] : '{ L_518 }')); } } else { echo ((isset($this->_rootref['L_26_0002'])) ? $this->_rootref['L_26_0002'] : ((isset($MSG['26_0002'])) ? $MSG['26_0002'] : '{ L_26_0002 }')); } ?></h4>
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
				<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } if ($this->_rootref['B_EDIT_FILE']) {  ?>
				<form name="editfile" action="" method="post">
                    <table width="98%" cellpadding="0" cellspacing="0" class="blank">
                    <tr valign="top">
						<td><?php echo ((isset($this->_rootref['L_812'])) ? $this->_rootref['L_812'] : ((isset($MSG['812'])) ? $MSG['812'] : '{ L_812 }')); ?></td>
						<td align="center">
                        	<?php if ($this->_rootref['FILENAME'] != ('')) {  ?><b><?php echo (isset($this->_rootref['FILENAME'])) ? $this->_rootref['FILENAME'] : ''; ?></b><?php } else { ?><input type="text" name="new_filename" value="" style="width:600px;"><?php } ?>
                        </td>
					</tr>
					<tr valign="top">
						<td><?php echo ((isset($this->_rootref['L_813'])) ? $this->_rootref['L_813'] : ((isset($MSG['813'])) ? $MSG['813'] : '{ L_813 }')); ?></td>
						<td align="center">
                        	<textarea style="width:600px; height:400px;" name="content"><?php echo (isset($this->_rootref['FILECONTENTS'])) ? $this->_rootref['FILECONTENTS'] : ''; ?></textarea>
                        </td>
					</tr>
					</table>
                    <input type="hidden" name="action" value="<?php if ($this->_rootref['FILENAME'] != ('')) {  ?>edit<?php } else { ?>add<?php } ?>">
                    <input type="hidden" name="filename" value="<?php echo (isset($this->_rootref['FILENAME'])) ? $this->_rootref['FILENAME'] : ''; ?>">
                    <input type="hidden" name="theme" value="<?php echo (isset($this->_rootref['THEME'])) ? $this->_rootref['THEME'] : ''; ?>">
                    <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                    <input type="submit" name="act" class="centre" value="<?php echo ((isset($this->_rootref['L_071'])) ? $this->_rootref['L_071'] : ((isset($MSG['071'])) ? $MSG['071'] : '{ L_071 }')); ?>">
				</form>
<?php } ?>
				<form name="theme" action="" method="post">
                    <table width="98%" cellpadding="0" cellspacing="0" class="blank">
    <?php $_themes_count = (isset($this->_tpldata['themes'])) ? sizeof($this->_tpldata['themes']) : 0;if ($_themes_count) {for ($_themes_i = 0; $_themes_i < $_themes_count; ++$_themes_i){$_themes_val = &$this->_tpldata['themes'][$_themes_i]; ?>
                    <tr <?php echo $_themes_val['BG']; ?>>
                        <td style="padding-left:10px;">
		<?php if ($_themes_val['B_NOTADMIN']) {  ?>
                            <input type="radio" name="dtheme" value="<?php echo $_themes_val['NAME']; ?>" <?php if ($_themes_val['B_CHECKED']) {  ?>checked="checked" <?php } ?>/>
                            <b><?php echo $_themes_val['NAME']; ?></b>
		<?php } else { ?>
        					<b><?php echo ((isset($this->_rootref['L_841'])) ? $this->_rootref['L_841'] : ((isset($MSG['841'])) ? $MSG['841'] : '{ L_841 }')); ?></b>
		<?php } ?>
                        </td>
                        <td align="left">
                            <p><a href="theme.php?do=listfiles&theme=<?php echo $_themes_val['NAME']; ?>"><?php echo ((isset($this->_rootref['L_26_0003'])) ? $this->_rootref['L_26_0003'] : ((isset($MSG['26_0003'])) ? $MSG['26_0003'] : '{ L_26_0003 }')); ?></a></p>
                            <p><a href="theme.php?do=addfile&theme=<?php echo $_themes_val['NAME']; ?>"><?php echo ((isset($this->_rootref['L_26_0004'])) ? $this->_rootref['L_26_0004'] : ((isset($MSG['26_0004'])) ? $MSG['26_0004'] : '{ L_26_0004 }')); ?></a></p>
                        </td>
                    </tr>
        <?php if ($_themes_val['B_LISTFILES']) {  ?>
                    <tr <?php echo $_themes_val['BG']; ?>>
                        <td align="center" colspan="2">
                        	<select name="file" multiple size="24" style="font-weight:bold; width:350px"
                             ondblclick="document.getElementById('action').value = ''; document.getElementById('theme').value = '<?php echo $_themes_val['NAME']; ?>'; this.form.submit();">
            <?php $_files_count = (isset($_themes_val['files'])) ? sizeof($_themes_val['files']) : 0;if ($_files_count) {for ($_files_i = 0; $_files_i < $_files_count; ++$_files_i){$_files_val = &$_themes_val['files'][$_files_i]; ?>
            				<option value="<?php echo $_files_val['FILE']; ?>"><?php echo $_files_val['FILE']; ?></option>
            <?php }} ?>
            				</select>
                        </td>
                    </tr>
        <?php } }} ?>
					</table>
                    <input type="hidden" name="action" value="update" id="action">
                    <input type="hidden" name="theme" value="" id="theme">
                    <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                    <input type="submit" name="act" value="<?php echo ((isset($this->_rootref['L_26_0000'])) ? $this->_rootref['L_26_0000'] : ((isset($MSG['26_0000'])) ? $MSG['26_0000'] : '{ L_26_0000 }')); ?>">
				</form>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>