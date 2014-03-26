<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo ((isset($this->_rootref['L_25_0018'])) ? $this->_rootref['L_25_0018'] : ((isset($MSG['25_0018'])) ? $MSG['25_0018'] : '{ L_25_0018 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L_516'])) ? $this->_rootref['L_516'] : ((isset($MSG['516'])) ? $MSG['516'] : '{ L_516 }')); ?></h4>
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
				<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } ?>
                <div class="plain-box"><?php echo (isset($this->_rootref['NEWS_COUNT'])) ? $this->_rootref['NEWS_COUNT'] : ''; echo ((isset($this->_rootref['L_517'])) ? $this->_rootref['L_517'] : ((isset($MSG['517'])) ? $MSG['517'] : '{ L_517 }')); ?> <a href="addnew.php"><?php echo ((isset($this->_rootref['L_518'])) ? $this->_rootref['L_518'] : ((isset($MSG['518'])) ? $MSG['518'] : '{ L_518 }')); ?></a></div>
                <table width="98%" cellpadding="0" cellspacing="0">
                <tr>
                	<th width="20%"><?php echo ((isset($this->_rootref['L_314'])) ? $this->_rootref['L_314'] : ((isset($MSG['314'])) ? $MSG['314'] : '{ L_314 }')); ?></th>
                	<th width="60%"><?php echo ((isset($this->_rootref['L_312'])) ? $this->_rootref['L_312'] : ((isset($MSG['312'])) ? $MSG['312'] : '{ L_312 }')); ?></th>
                	<th><?php echo ((isset($this->_rootref['L_297'])) ? $this->_rootref['L_297'] : ((isset($MSG['297'])) ? $MSG['297'] : '{ L_297 }')); ?></th>
                </tr>
<?php $_news_count = (isset($this->_tpldata['news'])) ? sizeof($this->_tpldata['news']) : 0;if ($_news_count) {for ($_news_i = 0; $_news_i < $_news_count; ++$_news_i){$_news_val = &$this->_tpldata['news'][$_news_i]; ?>
                <tr <?php echo $_news_val['BG']; ?>>
                	<td><?php echo $_news_val['DATE']; ?></td>
                	<td <?php if ($_news_val['SUSPENDED'] == (1)) {  ?>style="background: #FAD0D0; color: #B01717; font-weight: bold;"<?php } ?>><?php echo $_news_val['TITLE']; ?></td>
                	<td>
                    	<a href="editnew.php?id=<?php echo $_news_val['ID']; ?>&PAGE=<?php echo (isset($this->_rootref['PAGE'])) ? $this->_rootref['PAGE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_298'])) ? $this->_rootref['L_298'] : ((isset($MSG['298'])) ? $MSG['298'] : '{ L_298 }')); ?></a><br>
						<a href="deletenew.php?id=<?php echo $_news_val['ID']; ?>&PAGE=<?php echo (isset($this->_rootref['PAGE'])) ? $this->_rootref['PAGE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_008'])) ? $this->_rootref['L_008'] : ((isset($MSG['008'])) ? $MSG['008'] : '{ L_008 }')); ?></a>
                    </td>
                </tr>
<?php }} ?>
                </table>
                <table width="98%" cellpadding="0" cellspacing="0" class="blank">
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
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>