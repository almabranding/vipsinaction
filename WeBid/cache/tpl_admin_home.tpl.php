<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<div class="box">
                	<h4 class="rounded-top"><?php echo ((isset($this->_rootref['L_1061'])) ? $this->_rootref['L_1061'] : ((isset($MSG['1061'])) ? $MSG['1061'] : '{ L_1061 }')); ?></h4>
                    <div class="rounded-bottom">
                    	<form name="anotes" action="" method="post">
							<textarea rows="15" name="anotes" class="anotes"><?php echo (isset($this->_rootref['ADMIN_NOTES'])) ? $this->_rootref['ADMIN_NOTES'] : ''; ?></textarea>
							<input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
							<input type="submit" name="act" value="<?php echo ((isset($this->_rootref['L_007'])) ? $this->_rootref['L_007'] : ((isset($MSG['007'])) ? $MSG['007'] : '{ L_007 }')); ?>">
						</form>
					</div>
                </div>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
<?php if ($this->_rootref['THIS_VERSION'] == $this->_rootref['CUR_VERSION']) {  ?>
            	<div class="info-box"><?php echo ((isset($this->_rootref['L_30_0212'])) ? $this->_rootref['L_30_0212'] : ((isset($MSG['30_0212'])) ? $MSG['30_0212'] : '{ L_30_0212 }')); ?></div>
<?php } else { ?>
            	<div class="error-box"><?php echo ((isset($this->_rootref['L_30_0211'])) ? $this->_rootref['L_30_0211'] : ((isset($MSG['30_0211'])) ? $MSG['30_0211'] : '{ L_30_0211 }')); ?></div>
<?php } if ($this->_rootref['ERROR'] != ('')) {  ?>
				<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } ?>
            	<table width="98%" cellpadding="1" cellspacing="0">
					<tr>
						<th colspan="2"><?php echo ((isset($this->_rootref['L_25_0025'])) ? $this->_rootref['L_25_0025'] : ((isset($MSG['25_0025'])) ? $MSG['25_0025'] : '{ L_25_0025 }')); ?></th>
					</tr>
					<tr>
						<td width="172"><strong><?php echo ((isset($this->_rootref['L_528'])) ? $this->_rootref['L_528'] : ((isset($MSG['528'])) ? $MSG['528'] : '{ L_528 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?></td>
					</tr>
					<tr class="bg">
						<td><strong><?php echo ((isset($this->_rootref['L_527'])) ? $this->_rootref['L_527'] : ((isset($MSG['527'])) ? $MSG['527'] : '{ L_527 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo ((isset($this->_rootref['L_540'])) ? $this->_rootref['L_540'] : ((isset($MSG['540'])) ? $MSG['540'] : '{ L_540 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['ADMINMAIL'])) ? $this->_rootref['ADMINMAIL'] : ''; ?></td>
					</tr>
					<tr class="bg">
						<td><strong><?php echo ((isset($this->_rootref['L_25_0026'])) ? $this->_rootref['L_25_0026'] : ((isset($MSG['25_0026'])) ? $MSG['25_0026'] : '{ L_25_0026 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['CRON'])) ? $this->_rootref['CRON'] : ''; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo ((isset($this->_rootref['L_663'])) ? $this->_rootref['L_663'] : ((isset($MSG['663'])) ? $MSG['663'] : '{ L_663 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['GALLERY'])) ? $this->_rootref['GALLERY'] : ''; ?></td>
					</tr>
					<tr class="bg">
						<td><strong><?php echo ((isset($this->_rootref['L_2__0025'])) ? $this->_rootref['L_2__0025'] : ((isset($MSG['2__0025'])) ? $MSG['2__0025'] : '{ L_2__0025 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['BUY_NOW'])) ? $this->_rootref['BUY_NOW'] : ''; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo ((isset($this->_rootref['L_5008'])) ? $this->_rootref['L_5008'] : ((isset($MSG['5008'])) ? $MSG['5008'] : '{ L_5008 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?></td>
					</tr>
					<tr class="bg">
						<td><strong><?php echo ((isset($this->_rootref['L_25_0035'])) ? $this->_rootref['L_25_0035'] : ((isset($MSG['25_0035'])) ? $MSG['25_0035'] : '{ L_25_0035 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['TIMEZONE'])) ? $this->_rootref['TIMEZONE'] : ''; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo ((isset($this->_rootref['L_363'])) ? $this->_rootref['L_363'] : ((isset($MSG['363'])) ? $MSG['363'] : '{ L_363 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['DATEFORMAT'])) ? $this->_rootref['DATEFORMAT'] : ''; ?> <small>(<?php echo (isset($this->_rootref['DATEEXAMPLE'])) ? $this->_rootref['DATEEXAMPLE'] : ''; ?>)</small></td>
					</tr>
					<tr class="bg">
						<td><strong><?php echo ((isset($this->_rootref['L_5322'])) ? $this->_rootref['L_5322'] : ((isset($MSG['5322'])) ? $MSG['5322'] : '{ L_5322 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['DEFULTCONTRY'])) ? $this->_rootref['DEFULTCONTRY'] : ''; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo ((isset($this->_rootref['L_2__0002'])) ? $this->_rootref['L_2__0002'] : ((isset($MSG['2__0002'])) ? $MSG['2__0002'] : '{ L_2__0002 }')); ?></strong></td>
						<td>
<?php $_langs_count = (isset($this->_tpldata['langs'])) ? sizeof($this->_tpldata['langs']) : 0;if ($_langs_count) {for ($_langs_i = 0; $_langs_i < $_langs_count; ++$_langs_i){$_langs_val = &$this->_tpldata['langs'][$_langs_i]; ?>
						<p><?php echo $_langs_val['LANG']; if ($_langs_val['B_DEFAULT']) {  ?> (<?php echo ((isset($this->_rootref['L_2__0005'])) ? $this->_rootref['L_2__0005'] : ((isset($MSG['2__0005'])) ? $MSG['2__0005'] : '{ L_2__0005 }')); ?>)<?php } ?></p>
<?php }} ?>
                        </td>
					</tr>
					<tr class="bg">
						<td><strong><?php echo ((isset($this->_rootref['L_30_0214'])) ? $this->_rootref['L_30_0214'] : ((isset($MSG['30_0214'])) ? $MSG['30_0214'] : '{ L_30_0214 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['THIS_VERSION'])) ? $this->_rootref['THIS_VERSION'] : ''; ?> (<?php echo (isset($this->_rootref['CUR_VERSION'])) ? $this->_rootref['CUR_VERSION'] : ''; ?>)</td>
					</tr>
				</table>
            	<table width="98%" cellpadding="1" cellspacing="0">
					<tr>
						<th colspan="4"><?php echo ((isset($this->_rootref['L_25_0031'])) ? $this->_rootref['L_25_0031'] : ((isset($MSG['25_0031'])) ? $MSG['25_0031'] : '{ L_25_0031 }')); ?></th>
					</tr>
					<tr>
						<td width="25%"><strong><?php echo ((isset($this->_rootref['L_25_0055'])) ? $this->_rootref['L_25_0055'] : ((isset($MSG['25_0055'])) ? $MSG['25_0055'] : '{ L_25_0055 }')); ?></strong></td>
                        <td width="25%"><?php echo (isset($this->_rootref['C_USERS'])) ? $this->_rootref['C_USERS'] : ''; ?></td>
                        <td width="25%"><strong><?php echo ((isset($this->_rootref['L_25_0055'])) ? $this->_rootref['L_25_0055'] : ((isset($MSG['25_0055'])) ? $MSG['25_0055'] : '{ L_25_0055 }')); ?></strong></td>
						<td width="25%">
<?php if ($this->_rootref['USERCONF'] == 0) {  ?>
                        <strong><?php echo ((isset($this->_rootref['L_893'])) ? $this->_rootref['L_893'] : ((isset($MSG['893'])) ? $MSG['893'] : '{ L_893 }')); ?></strong>: <?php echo (isset($this->_rootref['C_IUSERS'])) ? $this->_rootref['C_IUSERS'] : ''; ?><br>
                        <strong><?php echo ((isset($this->_rootref['L_892'])) ? $this->_rootref['L_892'] : ((isset($MSG['892'])) ? $MSG['892'] : '{ L_892 }')); ?></strong>: <?php echo (isset($this->_rootref['C_UUSERS'])) ? $this->_rootref['C_UUSERS'] : ''; ?> (<a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/listusers.php?usersfilter=admin_approve"><?php echo ((isset($this->_rootref['L_5295'])) ? $this->_rootref['L_5295'] : ((isset($MSG['5295'])) ? $MSG['5295'] : '{ L_5295 }')); ?></a>)
<?php } else { ?>
                        <?php echo (isset($this->_rootref['C_IUSERS'])) ? $this->_rootref['C_IUSERS'] : ''; ?>
<?php } ?>
                        </td>
					</tr>
					<tr class="bg">
						<td><strong><?php echo ((isset($this->_rootref['L_25_0057'])) ? $this->_rootref['L_25_0057'] : ((isset($MSG['25_0057'])) ? $MSG['25_0057'] : '{ L_25_0057 }')); ?></strong></td>
                        <td><?php echo (isset($this->_rootref['C_AUCTIONS'])) ? $this->_rootref['C_AUCTIONS'] : ''; ?></td>
                        <td><strong><?php echo ((isset($this->_rootref['L_354'])) ? $this->_rootref['L_354'] : ((isset($MSG['354'])) ? $MSG['354'] : '{ L_354 }')); ?></strong></td>
						<td><?php echo (isset($this->_rootref['C_CLOSED'])) ? $this->_rootref['C_CLOSED'] : ''; ?></td>
					</tr>
					<tr>
						<td><strong><?php echo ((isset($this->_rootref['L_25_0059'])) ? $this->_rootref['L_25_0059'] : ((isset($MSG['25_0059'])) ? $MSG['25_0059'] : '{ L_25_0059 }')); ?></strong></td>
                        <td><?php echo (isset($this->_rootref['C_BIDS'])) ? $this->_rootref['C_BIDS'] : ''; ?></td>
                        <td><strong><?php echo ((isset($this->_rootref['L_25_0063'])) ? $this->_rootref['L_25_0063'] : ((isset($MSG['25_0063'])) ? $MSG['25_0063'] : '{ L_25_0063 }')); ?></strong></td>
						<td>
                            <p><strong><?php echo ((isset($this->_rootref['L_5161'])) ? $this->_rootref['L_5161'] : ((isset($MSG['5161'])) ? $MSG['5161'] : '{ L_5161 }')); ?></strong>: <?php echo (isset($this->_rootref['A_PAGEVIEWS'])) ? $this->_rootref['A_PAGEVIEWS'] : ''; ?></p>
                            <p><strong><?php echo ((isset($this->_rootref['L_5162'])) ? $this->_rootref['L_5162'] : ((isset($MSG['5162'])) ? $MSG['5162'] : '{ L_5162 }')); ?></strong>: <?php echo (isset($this->_rootref['A_UVISITS'])) ? $this->_rootref['A_UVISITS'] : ''; ?></p>
                            <p><strong><?php echo ((isset($this->_rootref['L_5163'])) ? $this->_rootref['L_5163'] : ((isset($MSG['5163'])) ? $MSG['5163'] : '{ L_5163 }')); ?></strong>: <?php echo (isset($this->_rootref['A_USESSIONS'])) ? $this->_rootref['A_USESSIONS'] : ''; ?></p>
                        </td>
					</tr>
				</table>
            	<table width="98%" cellpadding="1" cellspacing="0">
					<tr>
						<th colspan="2"><?php echo ((isset($this->_rootref['L_080'])) ? $this->_rootref['L_080'] : ((isset($MSG['080'])) ? $MSG['080'] : '{ L_080 }')); ?></th>
					</tr>
					<tr>
						<td width="70%"><?php echo ((isset($this->_rootref['L_30_0032'])) ? $this->_rootref['L_30_0032'] : ((isset($MSG['30_0032'])) ? $MSG['30_0032'] : '{ L_30_0032 }')); ?></td>
						<td>
                            <form action="?action=clearcache" method="post">
                            	<input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                                <input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_30_0031'])) ? $this->_rootref['L_30_0031'] : ((isset($MSG['30_0031'])) ? $MSG['30_0031'] : '{ L_30_0031 }')); ?>">
                            </form>
                        </td>
					</tr>
					<tr class="bg">
						<td><?php echo ((isset($this->_rootref['L_1030'])) ? $this->_rootref['L_1030'] : ((isset($MSG['1030'])) ? $MSG['1030'] : '{ L_1030 }')); ?></td>
						<td>
                            <form action="?action=updatecounters" method="post">
                            	<input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
                            	<input type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_1031'])) ? $this->_rootref['L_1031'] : ((isset($MSG['1031'])) ? $MSG['1031'] : '{ L_1031 }')); ?>">
                            </form>
                        </td>
					</tr>
				</table>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>