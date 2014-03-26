<table width="100%" border="0" cellpadding="0" cellspacing="0" class="smallpadding">
<tr>
	<td width="22%" valign="top" class="columL">
    <div class="titTable1 rounded-right">
    	<?php echo ((isset($this->_rootref['L_276'])) ? $this->_rootref['L_276'] : ((isset($MSG['276'])) ? $MSG['276'] : '{ L_276 }')); ?>
    </div>
    <div class="smallpadding">
        <ul>
<?php $_cat_list_count = (isset($this->_tpldata['cat_list'])) ? sizeof($this->_tpldata['cat_list']) : 0;if ($_cat_list_count) {for ($_cat_list_i = 0; $_cat_list_i < $_cat_list_count; ++$_cat_list_i){$_cat_list_val = &$this->_tpldata['cat_list'][$_cat_list_i]; ?>
            <li>
                <span style="background-color:<?php echo $_cat_list_val['COLOUR']; ?>">
                <a href="browse.php?id=<?php echo $_cat_list_val['ID']; ?>"><?php echo $_cat_list_val['IMAGE']; echo $_cat_list_val['NAME']; ?></a> <?php echo $_cat_list_val['CATAUCNUM']; ?>
                </span>
            </li>
<?php }} ?>
        </ul>
        <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>browse.php?id=0"><?php echo ((isset($this->_rootref['L_277'])) ? $this->_rootref['L_277'] : ((isset($MSG['277'])) ? $MSG['277'] : '{ L_277 }')); ?></a>
    </div>
</td>
<td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="maincolum">
    <tr>
        <td class="table2">
        <?php $_featured_count = (isset($this->_tpldata['featured'])) ? sizeof($this->_tpldata['featured']) : 0;if ($_featured_count) {for ($_featured_i = 0; $_featured_i < $_featured_count; ++$_featured_i){$_featured_val = &$this->_tpldata['featured'][$_featured_i]; ?>
            <div style="float:left;display:block;width:180px;margin:5px;background-color:#FFFEEE;border:#CCCCCC 1px solid;padding:5px;min-height:150px;">
                <div style="display:block;" align="center"><img src="<?php echo $_featured_val['IMAGE']; ?>"></div>
                <div style="display:block;" align="center"><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_featured_val['ID']; ?>"><?php echo $_featured_val['TITLE']; ?></a><br><?php echo $_featured_val['BID']; ?></div>
            </div>
        <?php }} ?>
        </td>
    </tr>  
    <?php if ($this->_rootref['B_HOT_ITEMS']) {  ?>
    <tr>
        <td class="titTable4"><?php echo ((isset($this->_rootref['L_279'])) ? $this->_rootref['L_279'] : ((isset($MSG['279'])) ? $MSG['279'] : '{ L_279 }')); ?></td>
    </tr>
    <tr>
        <td class="table2">
        <?php $_hotitems_count = (isset($this->_tpldata['hotitems'])) ? sizeof($this->_tpldata['hotitems']) : 0;if ($_hotitems_count) {for ($_hotitems_i = 0; $_hotitems_i < $_hotitems_count; ++$_hotitems_i){$_hotitems_val = &$this->_tpldata['hotitems'][$_hotitems_i]; ?>
            <div style="float:left;display:block;width:180px;margin:5px;background-color:#FFFEEE;border:#CCCCCC 1px solid;padding:5px;min-height:150px;">
                <div style="display:block;" align="center"><img src="<?php echo $_hotitems_val['IMAGE']; ?>"></div>
                <div style="display:block;" align="center"><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_hotitems_val['ID']; ?>"><?php echo $_hotitems_val['TITLE']; ?></a><br><?php echo $_hotitems_val['BID']; ?></div>
            </div>
        <?php }} ?>
        </td>
    </tr>
    <?php } if ($this->_rootref['B_AUC_LAST']) {  ?>
    <tr>
        <td class="titTable4"><?php echo ((isset($this->_rootref['L_278'])) ? $this->_rootref['L_278'] : ((isset($MSG['278'])) ? $MSG['278'] : '{ L_278 }')); ?></td>
    </tr>
    <tr>
        <td class="table2">
        <?php $_auc_last_count = (isset($this->_tpldata['auc_last'])) ? sizeof($this->_tpldata['auc_last']) : 0;if ($_auc_last_count) {for ($_auc_last_i = 0; $_auc_last_i < $_auc_last_count; ++$_auc_last_i){$_auc_last_val = &$this->_tpldata['auc_last'][$_auc_last_i]; ?>
            <p style="display:block;" <?php echo $_auc_last_val['BGCOLOUR']; ?>><?php echo $_auc_last_val['DATE']; ?> <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_auc_last_val['ID']; ?>"><?php echo $_auc_last_val['TITLE']; ?></a></p>
        <?php }} ?>
        </td>
    </tr>
    <?php } if ($this->_rootref['B_AUC_ENDSOON']) {  ?>
    <tr>
        <td class="titTable4"><?php echo ((isset($this->_rootref['L_280'])) ? $this->_rootref['L_280'] : ((isset($MSG['280'])) ? $MSG['280'] : '{ L_280 }')); ?></td>
    </tr>
    <tr>
        <td class="table2">
        <?php $_end_soon_count = (isset($this->_tpldata['end_soon'])) ? sizeof($this->_tpldata['end_soon']) : 0;if ($_end_soon_count) {for ($_end_soon_i = 0; $_end_soon_i < $_end_soon_count; ++$_end_soon_i){$_end_soon_val = &$this->_tpldata['end_soon'][$_end_soon_i]; ?>
            <p style="display:block;" <?php echo $_end_soon_val['BGCOLOUR']; ?>><?php echo $_end_soon_val['DATE']; ?> <a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo $_end_soon_val['ID']; ?>"><?php echo $_end_soon_val['TITLE']; ?></a></p>
        <?php }} ?>
        </td>
    </tr>
    <?php } ?>
    </table>
</td>
<td width="20%" valign="top" class="columR">
<?php if ($this->_rootref['B_MULT_LANGS']) {  ?>
    <div class="titTable1 rounded-left">
    	<?php echo ((isset($this->_rootref['L_2__0001'])) ? $this->_rootref['L_2__0001'] : ((isset($MSG['2__0001'])) ? $MSG['2__0001'] : '{ L_2__0001 }')); ?>
    </div>
    <div class="smallpadding">
        <?php echo (isset($this->_rootref['FLAGS'])) ? $this->_rootref['FLAGS'] : ''; ?>
    </div>
<?php } if ($this->_rootref['B_LOGIN_BOX']) {  if ($this->_rootref['B_LOGGED_IN']) {  ?>
    <div class="titTable1 rounded-left">
    	<?php echo ((isset($this->_rootref['L_200'])) ? $this->_rootref['L_200'] : ((isset($MSG['200'])) ? $MSG['200'] : '{ L_200 }')); ?> <?php echo (isset($this->_rootref['YOURUSERNAME'])) ? $this->_rootref['YOURUSERNAME'] : ''; ?>
    </div>
    <div class="smallpadding">
        <ul>
            <li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>edit_data.php?"><?php echo ((isset($this->_rootref['L_244'])) ? $this->_rootref['L_244'] : ((isset($MSG['244'])) ? $MSG['244'] : '{ L_244 }')); ?></a></li>
            <li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>user_menu.php"><?php echo ((isset($this->_rootref['L_622'])) ? $this->_rootref['L_622'] : ((isset($MSG['622'])) ? $MSG['622'] : '{ L_622 }')); ?></a></li>
            <li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>logout.php"><?php echo ((isset($this->_rootref['L_245'])) ? $this->_rootref['L_245'] : ((isset($MSG['245'])) ? $MSG['245'] : '{ L_245 }')); ?></a></li>
        </ul>
    </div>
	<?php } else { ?>
    <div class="titTable1 rounded-left">
    	<?php echo ((isset($this->_rootref['L_221'])) ? $this->_rootref['L_221'] : ((isset($MSG['221'])) ? $MSG['221'] : '{ L_221 }')); ?>
    </div>
    <div class="smallpadding">
        <form name="login" action="<?php echo (isset($this->_rootref['SSLURL'])) ? $this->_rootref['SSLURL'] : ''; ?>user_login.php" method="post">
        <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
            <table width="100%">
            <tr>
                <td width="25%"><label for="username" title="please enter your username"><?php echo ((isset($this->_rootref['L_003'])) ? $this->_rootref['L_003'] : ((isset($MSG['003'])) ? $MSG['003'] : '{ L_003 }')); ?></label></td>
                <td width="75%"><input type="text" name="username" id="username" size="10" maxlength="20"></td>
            </tr>
            <tr>
                <td width="25%"><label for="password" title="please enter your password"><?php echo ((isset($this->_rootref['L_004'])) ? $this->_rootref['L_004'] : ((isset($MSG['004'])) ? $MSG['004'] : '{ L_004 }')); ?>&nbsp;</label></td>
                <td width="75%"><input type="password" name="password" id="password" size="10" maxlength="20"></td>
            </tr>
            </table>
            <p><input type="checkbox" name="rememberme" id="rememberme" value="1"><label for="rememberme">&nbsp;<?php echo ((isset($this->_rootref['L_25_0085'])) ? $this->_rootref['L_25_0085'] : ((isset($MSG['25_0085'])) ? $MSG['25_0085'] : '{ L_25_0085 }')); ?></label></p>
            <p align="center"><input type="submit" name="action" value="<?php echo ((isset($this->_rootref['L_275'])) ? $this->_rootref['L_275'] : ((isset($MSG['275'])) ? $MSG['275'] : '{ L_275 }')); ?>" class="button"></p>
            <p><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>forgotpasswd.php"><?php echo ((isset($this->_rootref['L_215'])) ? $this->_rootref['L_215'] : ((isset($MSG['215'])) ? $MSG['215'] : '{ L_215 }')); ?></a></p>
        </form>
    </div>
	<?php } } if ($this->_rootref['B_HELPBOX']) {  ?>
    <div class="titTable1 rounded-left">
    	<?php echo ((isset($this->_rootref['L_281'])) ? $this->_rootref['L_281'] : ((isset($MSG['281'])) ? $MSG['281'] : '{ L_281 }')); ?>
    </div>
    <div class="smallpadding">
        <ul>
        <?php $_helpbox_count = (isset($this->_tpldata['helpbox'])) ? sizeof($this->_tpldata['helpbox']) : 0;if ($_helpbox_count) {for ($_helpbox_i = 0; $_helpbox_i < $_helpbox_count; ++$_helpbox_i){$_helpbox_val = &$this->_tpldata['helpbox'][$_helpbox_i]; ?>
            <li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>viewhelp.php?cat=<?php echo $_helpbox_val['ID']; ?>" alt="faqs"  class="new-window"><?php echo $_helpbox_val['TITLE']; ?></a></li>
        <?php }} ?>
        </ul>
    </div>
<?php } if ($this->_rootref['B_NEWS_BOX']) {  ?>
    <div class="titTable1 rounded-left">
    	<?php echo ((isset($this->_rootref['L_282'])) ? $this->_rootref['L_282'] : ((isset($MSG['282'])) ? $MSG['282'] : '{ L_282 }')); ?>
    </div>
    <div class="smallpadding">
        <ul>
        <?php $_newsbox_count = (isset($this->_tpldata['newsbox'])) ? sizeof($this->_tpldata['newsbox']) : 0;if ($_newsbox_count) {for ($_newsbox_i = 0; $_newsbox_i < $_newsbox_count; ++$_newsbox_i){$_newsbox_val = &$this->_tpldata['newsbox'][$_newsbox_i]; ?>
            <li><?php echo $_newsbox_val['DATE']; ?> - <a href="viewnews.php?id=<?php echo $_newsbox_val['ID']; ?>"><?php echo $_newsbox_val['TITLE']; ?></a></li>
        <?php }} ?>
        </ul>
    </div>   
<?php } ?>
	</td>
</tr>
</table>