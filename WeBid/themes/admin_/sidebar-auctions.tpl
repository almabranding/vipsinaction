            	<div class="box">
                	<h4 class="rounded-top">{L_239}</h4>
                    <div class="rounded-bottom">
                    	<ul class="menu">
                        	<li><a href="{SITEURL}admin/listauctions.php">{L_067}</a></li>
                        	<li><a href="{SITEURL}admin/listclosedauctions.php">{L_214}</a></li>
                        	<li><a href="{SITEURL}admin/listsuspendedauctions.php">{L_5227}</a></li>
                        </ul>
                    </div>
                </div>
            	<div class="box">
                	<h4 class="rounded-top">{L_1061}</h4>
                    <div class="rounded-bottom">
                    	<form name="anotes" action="" method="post">
							<textarea rows="15" name="anotes" class="anotes">{ADMIN_NOTES}</textarea>
							<input type="hidden" name="csrftoken" value="{_CSRFTOKEN}">
							<input type="submit" name="act" value="{L_007}">
						</form>
					</div>
                </div>