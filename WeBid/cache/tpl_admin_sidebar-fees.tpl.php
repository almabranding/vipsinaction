<div class="box">
                	<h4 class="rounded-top"><?php echo ((isset($this->_rootref['L_25_0012'])) ? $this->_rootref['L_25_0012'] : ((isset($MSG['25_0012'])) ? $MSG['25_0012'] : '{ L_25_0012 }')); ?></h4>
                    <div class="rounded-bottom">
                    	<ul class="menu">
                        	<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fees.php"><?php echo ((isset($this->_rootref['L_25_0012'])) ? $this->_rootref['L_25_0012'] : ((isset($MSG['25_0012'])) ? $MSG['25_0012'] : '{ L_25_0012 }')); ?></a></li>
                        	<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/fee_gateways.php"><?php echo ((isset($this->_rootref['L_445'])) ? $this->_rootref['L_445'] : ((isset($MSG['445'])) ? $MSG['445'] : '{ L_445 }')); ?></a></li>
                        	<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/enablefees.php"><?php echo ((isset($this->_rootref['L_395'])) ? $this->_rootref['L_395'] : ((isset($MSG['395'])) ? $MSG['395'] : '{ L_395 }')); ?></a></li>
                        	<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/accounts.php"><?php echo ((isset($this->_rootref['L_854'])) ? $this->_rootref['L_854'] : ((isset($MSG['854'])) ? $MSG['854'] : '{ L_854 }')); ?></a></li>
							<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/invoice_settings.php"><?php echo ((isset($this->_rootref['L_1094'])) ? $this->_rootref['L_1094'] : ((isset($MSG['1094'])) ? $MSG['1094'] : '{ L_1094 }')); ?></a></li>
							<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/invoice.php"><?php echo ((isset($this->_rootref['L_766'])) ? $this->_rootref['L_766'] : ((isset($MSG['766'])) ? $MSG['766'] : '{ L_766 }')); ?></a></li>
							<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/tax.php"><?php echo ((isset($this->_rootref['L_1088'])) ? $this->_rootref['L_1088'] : ((isset($MSG['1088'])) ? $MSG['1088'] : '{ L_1088 }')); ?></a></li>
							<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>admin/tax_levels.php"><?php echo ((isset($this->_rootref['L_1083'])) ? $this->_rootref['L_1083'] : ((isset($MSG['1083'])) ? $MSG['1083'] : '{ L_1083 }')); ?></a></li>
                        </ul>
                    </div>
                </div>
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