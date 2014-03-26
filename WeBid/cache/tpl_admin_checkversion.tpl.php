<?php $this->_tpl_include('header.tpl'); ?>
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<?php $this->_tpl_include('sidebar-' . ((isset($this->_rootref['CURRENT_PAGE'])) ? $this->_rootref['CURRENT_PAGE'] : '') . '.tpl'); ?>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div class="main-box">
            	<h4 class="rounded-top rounded-bottom"><?php echo ((isset($this->_rootref['L_5436'])) ? $this->_rootref['L_5436'] : ((isset($MSG['5436'])) ? $MSG['5436'] : '{ L_5436 }')); ?>&nbsp;&gt;&gt;&nbsp;<?php echo ((isset($this->_rootref['L_25_0169a'])) ? $this->_rootref['L_25_0169a'] : ((isset($MSG['25_0169a'])) ? $MSG['25_0169a'] : '{ L_25_0169a }')); ?></h4>
				<form name="errorlog" action="" method="post">
                <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
					<div class="error-box"><b><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></b></div>
<?php } ?>
                    Your Version: <b><?php echo (isset($this->_rootref['MYVERSION'])) ? $this->_rootref['MYVERSION'] : ''; ?></b><br>
                    Current Version: <?php echo (isset($this->_rootref['REALVERSION'])) ? $this->_rootref['REALVERSION'] : ''; ?><br>
                    <?php echo (isset($this->_rootref['TEXT'])) ? $this->_rootref['TEXT'] : ''; ?>
				</form>
            </div>
        </div>
<?php $this->_tpl_include('footer.tpl'); ?>