<div class="content">
	<div class="titTable2">
		<?php echo ((isset($this->_rootref['L_181'])) ? $this->_rootref['L_181'] : ((isset($MSG['181'])) ? $MSG['181'] : '{ L_181 }')); ?>
	</div>
	<div class="table2">
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
		<div class="error-box">
			<?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?>
		</div>
<?php } ?>
		<div class="padding centre">
        <table width="676" border="0" cellpadding="6">
            <tr>
                <td width="301">
                    <h2><?php echo ((isset($this->_rootref['L_862'])) ? $this->_rootref['L_862'] : ((isset($MSG['862'])) ? $MSG['862'] : '{ L_862 }')); ?></h2>
                    <form name="user_login" action="<?php echo (isset($this->_rootref['SSLURL'])) ? $this->_rootref['SSLURL'] : ''; ?>user_login.php" method="post">
                        <p class="smallpadding"><?php echo ((isset($this->_rootref['L_187'])) ? $this->_rootref['L_187'] : ((isset($MSG['187'])) ? $MSG['187'] : '{ L_187 }')); ?><br>
                        <input type="text" name="username" size="20" maxlength="20" value="<?php echo (isset($this->_rootref['USER'])) ? $this->_rootref['USER'] : ''; ?>"></p>
                        <p class="smallpadding"><?php echo ((isset($this->_rootref['L_004'])) ? $this->_rootref['L_004'] : ((isset($MSG['004'])) ? $MSG['004'] : '{ L_004 }')); ?><br>
                        <input type="password" name="password" size="20" maxlength="20" value=""></p>
                        <p>
                        <input type="submit" name="input" value="Login" class="button">
                        <input type="hidden" name="action" value="login">
                        <input type="checkbox" name="rememberme" value="1">&nbsp;<?php echo ((isset($this->_rootref['L_25_0085'])) ? $this->_rootref['L_25_0085'] : ((isset($MSG['25_0085'])) ? $MSG['25_0085'] : '{ L_25_0085 }')); ?></p>
                        <p><a href="forgotpasswd.php"><?php echo ((isset($this->_rootref['L_215'])) ? $this->_rootref['L_215'] : ((isset($MSG['215'])) ? $MSG['215'] : '{ L_215 }')); ?></a></p>
                    </form>
                </td>
                <td width="339">
                    <?php echo ((isset($this->_rootref['L_863'])) ? $this->_rootref['L_863'] : ((isset($MSG['863'])) ? $MSG['863'] : '{ L_863 }')); ?>
                </td>
            </tr>
        </table>
        </div>
	</div>
</div>