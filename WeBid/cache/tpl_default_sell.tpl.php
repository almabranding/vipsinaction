<?php if ($this->_rootref['PAGE'] == 0) {  ?>
<script type="text/javascript">
$(document).ready(function(){
	// set up the page
	// do something
	//sell javascript
	$("#bn_only_no").click(function(){
		$(".additional_shipping_costhide").hide();
		$("#additional_shipping_cost").attr("disabled","disabled");
		$("#min_bid").removeAttr("disabled");
		$("#reserve_price").removeAttr("disabled");
		$("#iqty").attr("disabled","disabled");
		$("#iqty").val("1");
	});
	$("#bn_only_yes").click(function(){
		$(".additional_shipping_costhide").show();
		$("#additional_shipping_cost").removeAttr("disabled","disabled");
		$("#min_bid").attr("disabled","disabled");
		$("#reserve_price").attr("disabled","disabled");
		$("#iqty").removeAttr("disabled");
		$("#bn_yes").attr("checked", "checked");
		$("#bn").removeAttr("disabled");
	});
	$("#reserve_price").focus(function(){
		$("#with_reserve_yes").attr("checked", "checked");
	});
	$("#bn").focus(function(){
		$("#bn_yes").attr("checked", "checked");
	});
	$("#bn_no").click(function(){
		$("#bn_only_no").attr("checked", "checked");
		$("#min_bid").removeAttr("disabled");
		$("#reserve_price").removeAttr("disabled");
		$("#iqty").attr("disabled","disabled");
		$("#iqty").val("1");
	});
	$("#custominc").focus(function(){
		$("#inc2").attr("checked", "checked");
	});
	$("#atype").change(function(){
		if ($(this).find(':selected').val() == 2) { //dutch auction
			$("#additional_shipping_cost").attr("disabled","disabled");
			$("#additional_shipping_cost").removeAttr("disabled","disabled");
			$("#with_reserve_no").attr("checked", "checked");
			$("#bn_only_no").attr("checked", "checked");
			$("#bn_no").attr("checked", "checked");
			$("#inc1").attr("checked", "checked");
			$("#iqty").removeAttr("disabled");
			$("#min_bid").removeAttr("disabled");
			$(".dutchhide").hide();
			$("#minval_text").text("<?php echo ((isset($this->_rootref['L_038'])) ? $this->_rootref['L_038'] : ((isset($MSG['038'])) ? $MSG['038'] : '{ L_038 }')); ?>");
		} else { //normal auction
			$("#additional_shipping_cost").removeAttr("disabled","disabled");
			$(".additional_shipping_costhide").hide();
			$(".dutchhide").show();
			$("#iqty").attr("disabled","disabled");
			$("#iqty").val("1");
			$("#minval_text").text("<?php echo ((isset($this->_rootref['L_020'])) ? $this->_rootref['L_020'] : ((isset($MSG['020'])) ? $MSG['020'] : '{ L_020 }')); ?>");
		}
	});
	$("#bps").click(function(){
		$("#shipping_cost").removeAttr("disabled");
	});
	$(".sps").click(function(){
		$("#additional_shipping_cost").removeAttr("disabled","disabled");
		$(".additional_shipping_costhide").hide();
		$("#shipping_cost").attr("disabled","disabled");
		$("#shipping_cost").val("0.00");
	});
	<?php if ($this->_rootref['B_FEES']) {  ?>
	<?php echo (isset($this->_rootref['FEE_JS'])) ? $this->_rootref['FEE_JS'] : ''; ?>
	// something
	var min_bid_fee = <?php echo (isset($this->_rootref['FEE_MIN_BID'])) ? $this->_rootref['FEE_MIN_BID'] : ''; ?>;
	var bn = <?php echo (isset($this->_rootref['FEE_BN'])) ? $this->_rootref['FEE_BN'] : ''; ?>;
	var rp = <?php echo (isset($this->_rootref['FEE_RP'])) ? $this->_rootref['FEE_RP'] : ''; ?>;
	var st = <?php echo (isset($this->_rootref['FEE_SUBTITLE'])) ? $this->_rootref['FEE_SUBTITLE'] : ''; ?>;
	st = st * 1;
	var rl = <?php echo (isset($this->_rootref['FEE_RELIST'])) ? $this->_rootref['FEE_RELIST'] : ''; ?>;
	$("#min_bid").blur(function(){
		var min_bid = parseFloat($("#min_bid").val());
		updatefee(min_bid_fee * -1);
		min_bid_fee = 0; // just incase theres nothing
		if (min_bid == 0) {
			min_bid_fee = 0;
		} else {
			for (var i = 0; i < setup.length; i++) {
				if (setup[i][0] <= min_bid && setup[i][1] >= min_bid) {
					if (setup[i][3] == 'flat') {
						min_bid_fee = setup[i][2];
						updatefee(setup[i][2]);
					} else {
						min_bid_fee = (setup[i][2] / 100) * min_bid;
						updatefee(min_bid_fee);
					}
					break;
				}
			}
		}
	});
	$("#resetbt").click(function(){
		current_fee = current_fee.toFixed(<?php echo (isset($this->_rootref['FEE_DECIMALS'])) ? $this->_rootref['FEE_DECIMALS'] : ''; ?>);
		$("#fee_exact").val(current_fee);
		$("#to_pay").text(current_fee);
	});
	$("#bn").blur(function(){
		bn();
	});
	$("#bn_yes").click(function(){
		bn();
	});
	$("#bn_no").click(function(){
		$("#bn").val(0);
		bn();
	});
	function bn(){
		if (bn != parseInt($("#bn").val())){
			if (parseInt($("#bn").val()) > 0)
				updatefee(buyout_fee);
			else
				updatefee(buyout_fee * -1);
			bn = parseInt($("#bn").val());
		}
	}
	$("#reserve_price").blur(function(){
		reserve();
	});
	$("#with_reserve_yes").click(function(){
		reserve();
	});
	$("#with_reserve_no").click(function(){
		$("#reserve_price").val(0);
		reserve();
	});
	function reserve(){
		if (rp != parseInt($("#reserve_price").val())){
			if (parseInt($("#reserve_price").val()) > 0)
				updatefee(rp_fee);
			else
				updatefee(rp_fee * -1);
			rp = parseInt($("#reserve_price").val());
		}
	}
	$("#is_featured").click(function(){
		if ($('#is_featured').is(':checked'))
			updatefee(hpfeat_fee);
		else
			updatefee(hpfeat_fee * -1);
	});
	$("#is_bold").click(function(){
		if ($('#is_bold').is(':checked'))
			updatefee(bolditem_fee);
		else
			updatefee(bolditem_fee * -1);
	});
	$("#is_highlighted").click(function(){
		if ($('#is_highlighted').is(':checked'))
			updatefee(hlitem_fee);
		else
			updatefee(hlitem_fee * -1);
	});
		<?php if ($this->_rootref['B_SUBTITLE']) {  ?>
	$("#subtitle").blur(function(){
		if (st > 0 && $("#subtitle").val().length == 0)
		{
			updatefee(subtitle_fee * -1);
			st = 0;
		}
		if (st == 0 && $("#subtitle").val().length > 0)
		{
			updatefee(subtitle_fee);
			st = subtitle_fee;
		}
	});
		<?php } if ($this->_rootref['B_AUTORELIST']) {  ?>
	$("#autorelist").blur(function(){
		var rl_times = $("#autorelist").val();
		updatefee(relist_fee * rl * -1);
		updatefee(relist_fee * rl_times);
		rl = rl_times;
	});
		<?php } ?>
	function updatefee(newfee){
		var nowfee = parseFloat($("#fee_exact").val()) + newfee;
		$("#fee_exact").val(nowfee);
		if (nowfee < 0){
			nowfee = 0;
		}
		nowfee = nowfee.toFixed(<?php echo (isset($this->_rootref['FEE_DECIMALS'])) ? $this->_rootref['FEE_DECIMALS'] : ''; ?>);
		$("#to_pay").text(nowfee);
	}
	<?php } ?>
});
</script>
<?php } if ($this->_rootref['ATYPE_PLAIN'] == (2)) {  ?>
<style type="text/css">
.dutchhide {
	display: none;
}
</style>
<?php } ?>
<div class="content">
	<div class="tableContent2">
		<div class="titTable2">
			<?php echo (isset($this->_rootref['TITLE'])) ? $this->_rootref['TITLE'] : ''; ?>
		</div>
		<div class="table2">
        	<a name="goto"></a>
<?php if ($this->_rootref['ERROR'] != ('')) {  ?>
            <div class="error-box">
                <?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?>
            </div>
<?php } if ($this->_rootref['PAGE'] == 0) {  ?>
			<form name="sell" action="<?php echo (isset($this->_rootref['ASSLURL'])) ? $this->_rootref['ASSLURL'] : ''; ?>sell.php" method="post">
            	<input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
				<table width="100%" border="0" cellpadding="4" cellspacing="0">
					<tr>
						<td class="centre" colspan="2">
                        	<h2 class="underline"><?php echo ((isset($this->_rootref['L_865'])) ? $this->_rootref['L_865'] : ((isset($MSG['865'])) ? $MSG['865'] : '{ L_865 }')); ?></h2>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_287'])) ? $this->_rootref['L_287'] : ((isset($MSG['287'])) ? $MSG['287'] : '{ L_287 }')); ?></b>
						</td>
						<td class="rightpan">
							<?php echo (isset($this->_rootref['CAT_LIST1'])) ? $this->_rootref['CAT_LIST1'] : ''; ?><br>
	<?php if ($this->_rootref['CAT_LIST2'] != ('')) {  ?>
							<?php echo (isset($this->_rootref['CAT_LIST2'])) ? $this->_rootref['CAT_LIST2'] : ''; ?><br>
	<?php } ?>
							[<a href="select_category.php?change=yes"><?php echo ((isset($this->_rootref['L_5113'])) ? $this->_rootref['L_5113'] : ((isset($MSG['5113'])) ? $MSG['5113'] : '{ L_5113 }')); ?></a>]
						</td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_017'])) ? $this->_rootref['L_017'] : ((isset($MSG['017'])) ? $MSG['017'] : '{ L_017 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="text" name="title" size="40" maxlength="70" value="<?php echo (isset($this->_rootref['AUC_TITLE'])) ? $this->_rootref['AUC_TITLE'] : ''; ?>">
						</td>
					</tr>
	<?php if ($this->_rootref['B_SUBTITLE']) {  ?>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_806'])) ? $this->_rootref['L_806'] : ((isset($MSG['806'])) ? $MSG['806'] : '{ L_806 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="text" name="subtitle" id="subtitle" size="40" maxlength="70" value="<?php echo (isset($this->_rootref['AUC_SUBTITLE'])) ? $this->_rootref['AUC_SUBTITLE'] : ''; ?>">
						</td>
					</tr>
	<?php } ?>
					<tr>
						<td align="center" valign="top" colspan="2">
							<b><?php echo ((isset($this->_rootref['L_018'])) ? $this->_rootref['L_018'] : ((isset($MSG['018'])) ? $MSG['018'] : '{ L_018 }')); ?></b>
						</td>
					</tr>
					<tr>
						<td class="rightpan" colspan="2">
					   		<?php echo (isset($this->_rootref['AUC_DESCRIPTION'])) ? $this->_rootref['AUC_DESCRIPTION'] : ''; ?>
						</td>
					</tr>
	<?php if ($this->_rootref['B_GALLERY']) {  ?>
					<tr>
						<td align="right" width="25%" valign="middle" class="leftpan">&nbsp;</td>
						<td valign="top" class="rightpan">
							<h3><?php echo ((isset($this->_rootref['L_663'])) ? $this->_rootref['L_663'] : ((isset($MSG['663'])) ? $MSG['663'] : '{ L_663 }')); ?></h3>
							<p><?php echo (isset($this->_rootref['MAXPICS'])) ? $this->_rootref['MAXPICS'] : ''; ?></p>
							[<a href="<?php echo (isset($this->_rootref['ASSLURL'])) ? $this->_rootref['ASSLURL'] : ''; ?>upldgallery.php" alt="gallery" class="new-window"><?php echo ((isset($this->_rootref['L_677'])) ? $this->_rootref['L_677'] : ((isset($MSG['677'])) ? $MSG['677'] : '{ L_677 }')); ?></a>]
                            <input type="hidden" name="numimages" value="<?php echo (isset($this->_rootref['NUMIMAGES'])) ? $this->_rootref['NUMIMAGES'] : ''; ?>" id="numimages">
                        </td>
					</tr>
	<?php } ?>
					<tr>
						<th colspan="2" align="center" valign="middle" class="leftpan">
							<?php echo ((isset($this->_rootref['L_640'])) ? $this->_rootref['L_640'] : ((isset($MSG['640'])) ? $MSG['640'] : '{ L_640 }')); ?>
						</th>
					</tr>
					<tr>
						<td align="right" width="25%" valign="middle" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_257'])) ? $this->_rootref['L_257'] : ((isset($MSG['257'])) ? $MSG['257'] : '{ L_257 }')); ?></b>
						</td>
						<td class="rightpan"><?php echo (isset($this->_rootref['ATYPE'])) ? $this->_rootref['ATYPE'] : ''; ?></td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="middle" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_258'])) ? $this->_rootref['L_258'] : ((isset($MSG['258'])) ? $MSG['258'] : '{ L_258 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="text" name="iquantity" id="iqty" size="5" value="<?php echo (isset($this->_rootref['ITEMQTY'])) ? $this->_rootref['ITEMQTY'] : ''; ?>" <?php echo (isset($this->_rootref['ITEMQTYD'])) ? $this->_rootref['ITEMQTYD'] : ''; ?>>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b id="minval_text"><?php echo (isset($this->_rootref['MINTEXT'])) ? $this->_rootref['MINTEXT'] : ''; ?></b>
						</td>
						<td class="rightpan">
							<input type="text" size="10" name="minimum_bid" id="min_bid" value="<?php echo (isset($this->_rootref['MIN_BID'])) ? $this->_rootref['MIN_BID'] : ''; ?>" <?php echo (isset($this->_rootref['BN_ONLY'])) ? $this->_rootref['BN_ONLY'] : ''; ?>>
							<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>&nbsp;&nbsp;(<a href="<?php echo (isset($this->_rootref['ASSLURL'])) ? $this->_rootref['ASSLURL'] : ''; ?>converter.php" alt="converter" class="new-window"><?php echo ((isset($this->_rootref['L_5010'])) ? $this->_rootref['L_5010'] : ((isset($MSG['5010'])) ? $MSG['5010'] : '{ L_5010 }')); ?></a>)
						</td>
					</tr>
	<?php if ($this->_rootref['B_CUSINC']) {  ?>
					<tr class="dutchhide">
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_120'])) ? $this->_rootref['L_120'] : ((isset($MSG['120'])) ? $MSG['120'] : '{ L_120 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="radio" name="increments" id="inc1" value="1" <?php echo (isset($this->_rootref['INCREMENTS1'])) ? $this->_rootref['INCREMENTS1'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_614'])) ? $this->_rootref['L_614'] : ((isset($MSG['614'])) ? $MSG['614'] : '{ L_614 }')); ?>
							<br>
							<input type="radio" name="increments" id="inc2" value="2" <?php echo (isset($this->_rootref['INCREMENTS2'])) ? $this->_rootref['INCREMENTS2'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_615'])) ? $this->_rootref['L_615'] : ((isset($MSG['615'])) ? $MSG['615'] : '{ L_615 }')); ?>
							<input type="text" name="customincrement" id="custominc" size="10" value="<?php echo (isset($this->_rootref['CUSTOM_INC'])) ? $this->_rootref['CUSTOM_INC'] : ''; ?>">
							<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>&nbsp;&nbsp;(<a href="converter.php" alt="converter" class="new-window"><?php echo ((isset($this->_rootref['L_5010'])) ? $this->_rootref['L_5010'] : ((isset($MSG['5010'])) ? $MSG['5010'] : '{ L_5010 }')); ?></a>) </td>
					</tr>
	<?php } else { ?>
					<input type="hidden" name="increments" id="inc1" value="1">
	<?php } ?>
					<tr class="dutchhide">
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_021'])) ? $this->_rootref['L_021'] : ((isset($MSG['021'])) ? $MSG['021'] : '{ L_021 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="radio" name="with_reserve" id="with_reserve_no" value="no" <?php echo (isset($this->_rootref['RESERVE_N'])) ? $this->_rootref['RESERVE_N'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_029'])) ? $this->_rootref['L_029'] : ((isset($MSG['029'])) ? $MSG['029'] : '{ L_029 }')); ?>
							<input type="radio" name="with_reserve" id="with_reserve_yes" value="yes" <?php echo (isset($this->_rootref['RESERVE_Y'])) ? $this->_rootref['RESERVE_Y'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_030'])) ? $this->_rootref['L_030'] : ((isset($MSG['030'])) ? $MSG['030'] : '{ L_030 }')); ?>
							<input type="text" name="reserve_price" id="reserve_price" size="10" value="<?php echo (isset($this->_rootref['RESERVE'])) ? $this->_rootref['RESERVE'] : ''; ?>" <?php echo (isset($this->_rootref['BN_ONLY'])) ? $this->_rootref['BN_ONLY'] : ''; ?>>
							<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>&nbsp;&nbsp;(<a href="converter.php" alt="converter" class="new-window"><?php echo ((isset($this->_rootref['L_5010'])) ? $this->_rootref['L_5010'] : ((isset($MSG['5010'])) ? $MSG['5010'] : '{ L_5010 }')); ?></a>) </td>
					</tr>
	<?php if ($this->_rootref['B_BN_ONLY']) {  ?>
					<tr class="dutchhide">
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_30_0063'])) ? $this->_rootref['L_30_0063'] : ((isset($MSG['30_0063'])) ? $MSG['30_0063'] : '{ L_30_0063 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="radio" name="buy_now_only" value="n" <?php echo (isset($this->_rootref['BN_ONLY_N'])) ? $this->_rootref['BN_ONLY_N'] : ''; ?> id="bn_only_no">
							<?php echo ((isset($this->_rootref['L_029'])) ? $this->_rootref['L_029'] : ((isset($MSG['029'])) ? $MSG['029'] : '{ L_029 }')); ?>
							<input type="radio" name="buy_now_only" value="y" <?php echo (isset($this->_rootref['BN_ONLY_Y'])) ? $this->_rootref['BN_ONLY_Y'] : ''; ?> id="bn_only_yes">
							<?php echo ((isset($this->_rootref['L_030'])) ? $this->_rootref['L_030'] : ((isset($MSG['030'])) ? $MSG['030'] : '{ L_030 }')); ?>
						</td>
					</tr>
	<?php } if ($this->_rootref['B_BN']) {  ?>
					<tr class="dutchhide">
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_496'])) ? $this->_rootref['L_496'] : ((isset($MSG['496'])) ? $MSG['496'] : '{ L_496 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="radio" name="buy_now" id="bn_no" value="no" <?php echo (isset($this->_rootref['BN_N'])) ? $this->_rootref['BN_N'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_029'])) ? $this->_rootref['L_029'] : ((isset($MSG['029'])) ? $MSG['029'] : '{ L_029 }')); ?>
							<input type="radio" name="buy_now" id="bn_yes" value="yes" <?php echo (isset($this->_rootref['BN_Y'])) ? $this->_rootref['BN_Y'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_030'])) ? $this->_rootref['L_030'] : ((isset($MSG['030'])) ? $MSG['030'] : '{ L_030 }')); ?>
							<input type="text" name="buy_now_price" id="bn" size="10" value="<?php echo (isset($this->_rootref['BN_PRICE'])) ? $this->_rootref['BN_PRICE'] : ''; ?>">
							<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>&nbsp;&nbsp;(<a href="converter.php" alt="converter" class="new-window"><?php echo ((isset($this->_rootref['L_5010'])) ? $this->_rootref['L_5010'] : ((isset($MSG['5010'])) ? $MSG['5010'] : '{ L_5010 }')); ?></a>) </td>
					</tr>
	<?php } if ($this->_rootref['B_EDIT_STARTTIME']) {  ?>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_2__0016'])) ? $this->_rootref['L_2__0016'] : ((isset($MSG['2__0016'])) ? $MSG['2__0016'] : '{ L_2__0016 }')); ?></b>
						</td>
						<td class="rightpan">
        <?php if ($this->_rootref['B_EDITING']) {  ?>
							<?php echo (isset($this->_rootref['START_TIME'])) ? $this->_rootref['START_TIME'] : ''; ?>
							<input type="hidden" name="a_starts" value="<?php echo (isset($this->_rootref['START_TIME'])) ? $this->_rootref['START_TIME'] : ''; ?>">
        <?php } else { ?>
        					<?php echo ((isset($this->_rootref['L_211'])) ? $this->_rootref['L_211'] : ((isset($MSG['211'])) ? $MSG['211'] : '{ L_211 }')); ?> <input type="checkbox" name="start_now" <?php echo (isset($this->_rootref['START_NOW'])) ? $this->_rootref['START_NOW'] : ''; ?>><br>
							<?php echo ((isset($this->_rootref['L_260'])) ? $this->_rootref['L_260'] : ((isset($MSG['260'])) ? $MSG['260'] : '{ L_260 }')); ?> <input type="text" name="a_starts" id="pubdate_input" value="<?php echo (isset($this->_rootref['START_TIME'])) ? $this->_rootref['START_TIME'] : ''; ?>" size="20" maxlength="19">
							<script type="text/javascript">
								new tcal ({'id': 'pubdate_input','controlname': 'a_starts', 'formname': 'sell'});
							</script>
        <?php } ?>
						</td>
					</tr>
	<?php } else { ?>
    				<input type="hidden" name="start_now" value="1">
    <?php } ?>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_022'])) ? $this->_rootref['L_022'] : ((isset($MSG['022'])) ? $MSG['022'] : '{ L_022 }')); ?></b>
						</td>
						<td class="rightpan">
							<?php echo (isset($this->_rootref['DURATIONS'])) ? $this->_rootref['DURATIONS'] : ''; ?>
						</td>
					</tr>
	<?php if ($this->_rootref['B_AUTORELIST']) {  ?>
                    <tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L__0161'])) ? $this->_rootref['L__0161'] : ((isset($MSG['_0161'])) ? $MSG['_0161'] : '{ L__0161 }')); ?></b>
						</td>
						<td class="rightpan">
                        	<p><?php echo ((isset($this->_rootref['L__0162'])) ? $this->_rootref['L__0162'] : ((isset($MSG['_0162'])) ? $MSG['_0162'] : '{ L__0162 }')); ?></p>
                        	<?php echo (isset($this->_rootref['RELIST'])) ? $this->_rootref['RELIST'] : ''; ?>
						</td>
					</tr>
	<?php } ?>
					<tr>
						<td class="centre" colspan="2">
                        	<h2 class="underline"><?php echo ((isset($this->_rootref['L_864'])) ? $this->_rootref['L_864'] : ((isset($MSG['864'])) ? $MSG['864'] : '{ L_864 }')); ?></h2>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_023'])) ? $this->_rootref['L_023'] : ((isset($MSG['023'])) ? $MSG['023'] : '{ L_023 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="text" size="10" name="shipping_cost" id="shipping_cost" value="<?php echo (isset($this->_rootref['SHIPPING_COST'])) ? $this->_rootref['SHIPPING_COST'] : ''; ?>" <?php if ($this->_rootref['SHIPPING1'] == ('')) {  ?>disabled="disabled"<?php } ?>>
							<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>&nbsp;&nbsp;(<a href="converter.php" alt="converter" class="new-window"><?php echo ((isset($this->_rootref['L_5010'])) ? $this->_rootref['L_5010'] : ((isset($MSG['5010'])) ? $MSG['5010'] : '{ L_5010 }')); ?></a>)
						</td>
					</tr>
					<tr class="additional_shipping_costhide">
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_350_1008'])) ? $this->_rootref['L_350_1008'] : ((isset($MSG['350_1008'])) ? $MSG['350_1008'] : '{ L_350_1008 }')); ?></b>
						</td>
						<td class="rightpan" style="width: 293px">
							<input type="text" size="10" name="additional_shipping_cost" id="additional_shipping_cost" value="<?php echo (isset($this->_rootref['ADDITIONAL_SHIPPING_COST'])) ? $this->_rootref['ADDITIONAL_SHIPPING_COST'] : ''; ?>" <?php if ($this->_rootref['SHIPPING1'] == ('')) {  ?>disabled="disabled"<?php } ?>>
							<?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>&nbsp;&nbsp;(<a href="converter.php" alt="converter" class="new-window"><?php echo ((isset($this->_rootref['L_5010'])) ? $this->_rootref['L_5010'] : ((isset($MSG['5010'])) ? $MSG['5010'] : '{ L_5010 }')); ?></a>)
						</td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_025'])) ? $this->_rootref['L_025'] : ((isset($MSG['025'])) ? $MSG['025'] : '{ L_025 }')); ?></b>
						</td>
						<td valign="top" class="rightpan">
							<input type="radio" name="shipping" id="bps" value="1" <?php echo (isset($this->_rootref['SHIPPING1'])) ? $this->_rootref['SHIPPING1'] : ''; ?>>	
							<?php echo ((isset($this->_rootref['L_031'])) ? $this->_rootref['L_031'] : ((isset($MSG['031'])) ? $MSG['031'] : '{ L_031 }')); ?><br>
							<input type="radio" name="shipping" id="sps" value="2" <?php echo (isset($this->_rootref['SHIPPING2'])) ? $this->_rootref['SHIPPING2'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_032'])) ? $this->_rootref['L_032'] : ((isset($MSG['032'])) ? $MSG['032'] : '{ L_032 }')); ?><br>
							<input type="radio" name="shipping" id="sps" value="3" <?php echo (isset($this->_rootref['SHIPPING3'])) ? $this->_rootref['SHIPPING3'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_867'])) ? $this->_rootref['L_867'] : ((isset($MSG['867'])) ? $MSG['867'] : '{ L_867 }')); ?><br>
							<input type="checkbox" name="international" value="1" <?php echo (isset($this->_rootref['INTERNATIONAL'])) ? $this->_rootref['INTERNATIONAL'] : ''; ?>>
							<?php echo ((isset($this->_rootref['L_033'])) ? $this->_rootref['L_033'] : ((isset($MSG['033'])) ? $MSG['033'] : '{ L_033 }')); ?>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_25_0215'])) ? $this->_rootref['L_25_0215'] : ((isset($MSG['25_0215'])) ? $MSG['25_0215'] : '{ L_25_0215 }')); ?></b>
						</td>
						<td>
							<textarea name="shipping_terms" rows="3" cols="34"><?php echo (isset($this->_rootref['SHIPPING_TERMS'])) ? $this->_rootref['SHIPPING_TERMS'] : ''; ?></textarea>
						</td>
					</tr>
					<tr>
						<td class="centre" colspan="2">
                        	<h2 class="underline"><?php echo ((isset($this->_rootref['L_30_0080'])) ? $this->_rootref['L_30_0080'] : ((isset($MSG['30_0080'])) ? $MSG['30_0080'] : '{ L_30_0080 }')); ?></h2>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_026'])) ? $this->_rootref['L_026'] : ((isset($MSG['026'])) ? $MSG['026'] : '{ L_026 }')); ?></b>
						</td>
						<td class="rightpan">
							<?php echo (isset($this->_rootref['PAYMENTS'])) ? $this->_rootref['PAYMENTS'] : ''; ?>
						</td>
					</tr>
					<tr>
						<td class="centre" colspan="2">
                        	<h2 class="underline"><?php echo ((isset($this->_rootref['L_268'])) ? $this->_rootref['L_268'] : ((isset($MSG['268'])) ? $MSG['268'] : '{ L_268 }')); ?></h2>
						</td>
					</tr>
	<?php if ($this->_rootref['B_MKFEATURED'] || $this->_rootref['B_MKBOLD'] || $this->_rootref['B_MKHIGHLIGHT']) {  ?>
                    <tr>
						<td>&nbsp;</td>
						<td class="rightpan">
        <?php if ($this->_rootref['B_MKFEATURED']) {  ?>
        					<p><input type="checkbox" name="is_featured" id="is_featured" <?php echo (isset($this->_rootref['IS_FEATURED'])) ? $this->_rootref['IS_FEATURED'] : ''; ?>> <?php echo ((isset($this->_rootref['L_273'])) ? $this->_rootref['L_273'] : ((isset($MSG['273'])) ? $MSG['273'] : '{ L_273 }')); ?></p>
        <?php } if ($this->_rootref['B_MKBOLD']) {  ?>
        					<p><input type="checkbox" name="is_bold" id="is_bold" <?php echo (isset($this->_rootref['IS_BOLD'])) ? $this->_rootref['IS_BOLD'] : ''; ?>> <?php echo ((isset($this->_rootref['L_274'])) ? $this->_rootref['L_274'] : ((isset($MSG['274'])) ? $MSG['274'] : '{ L_274 }')); ?></p>
        <?php } if ($this->_rootref['B_MKHIGHLIGHT']) {  ?>
        					<p><input type="checkbox" name="is_highlighted" id="is_highlighted" <?php echo (isset($this->_rootref['IS_HIGHLIGHTED'])) ? $this->_rootref['IS_HIGHLIGHTED'] : ''; ?>> <?php echo ((isset($this->_rootref['L_292'])) ? $this->_rootref['L_292'] : ((isset($MSG['292'])) ? $MSG['292'] : '{ L_292 }')); ?></p>
        <?php } ?>
						</td>
					</tr>
	<?php } if ($this->_rootref['B_CAN_TAX']) {  ?>
                    <tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_1102'])) ? $this->_rootref['L_1102'] : ((isset($MSG['1102'])) ? $MSG['1102'] : '{ L_1102 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="radio" name="is_taxed" value="y" <?php echo (isset($this->_rootref['TAX_Y'])) ? $this->_rootref['TAX_Y'] : ''; ?>>	<?php echo ((isset($this->_rootref['L_030'])) ? $this->_rootref['L_030'] : ((isset($MSG['030'])) ? $MSG['030'] : '{ L_030 }')); ?><br>
							<input type="radio" name="is_taxed" value="n" <?php echo (isset($this->_rootref['TAX_N'])) ? $this->_rootref['TAX_N'] : ''; ?>> <?php echo ((isset($this->_rootref['L_029'])) ? $this->_rootref['L_029'] : ((isset($MSG['029'])) ? $MSG['029'] : '{ L_029 }')); ?>
						</td>
					</tr>
                    <tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_1103'])) ? $this->_rootref['L_1103'] : ((isset($MSG['1103'])) ? $MSG['1103'] : '{ L_1103 }')); ?></b>
						</td>
						<td class="rightpan">
							<input type="radio" name="tax_included" value="y" <?php echo (isset($this->_rootref['TAXINC_Y'])) ? $this->_rootref['TAXINC_Y'] : ''; ?>>	<?php echo ((isset($this->_rootref['L_030'])) ? $this->_rootref['L_030'] : ((isset($MSG['030'])) ? $MSG['030'] : '{ L_030 }')); ?><br>
							<input type="radio" name="tax_included" value="n" <?php echo (isset($this->_rootref['TAXINC_N'])) ? $this->_rootref['TAXINC_N'] : ''; ?>> <?php echo ((isset($this->_rootref['L_029'])) ? $this->_rootref['L_029'] : ((isset($MSG['029'])) ? $MSG['029'] : '{ L_029 }')); ?>
						</td>
					</tr>
	<?php } if ($this->_rootref['B_FEES']) {  ?>
                    <tr>
						<td align="right" width="25%" valign="top" class="leftpan">
							<b><?php echo ((isset($this->_rootref['L_263'])) ? $this->_rootref['L_263'] : ((isset($MSG['263'])) ? $MSG['263'] : '{ L_263 }')); ?></b>
						</td>
						<td class="rightpan">
                        	<input type="hidden" name="fee_exact" id="fee_exact" value="<?php echo (isset($this->_rootref['FEE_VALUE'])) ? $this->_rootref['FEE_VALUE'] : ''; ?>">
                        	<span id="to_pay"><?php echo (isset($this->_rootref['FEE_VALUE_F'])) ? $this->_rootref['FEE_VALUE_F'] : ''; ?></span> <?php echo (isset($this->_rootref['CURRENCY'])) ? $this->_rootref['CURRENCY'] : ''; ?>
						</td>
					</tr>
	<?php } ?>
				</table>
				
				<div style="text-align:center">
					<input type="hidden" value="3" name="action">
					<input type="submit" name="" value="<?php echo ((isset($this->_rootref['L_5189'])) ? $this->_rootref['L_5189'] : ((isset($MSG['5189'])) ? $MSG['5189'] : '{ L_5189 }')); ?>" class="button">&nbsp;&nbsp;&nbsp;<input type="reset" id="resetbt" value="<?php echo ((isset($this->_rootref['L_5190'])) ? $this->_rootref['L_5190'] : ((isset($MSG['5190'])) ? $MSG['5190'] : '{ L_5190 }')); ?>" class="button">
				</div>
			</form>
<?php } else if ($this->_rootref['PAGE'] == (2)) {  ?>
			<form name="preview" action="<?php echo (isset($this->_rootref['ASSLURL'])) ? $this->_rootref['ASSLURL'] : ''; ?>sell.php" method="post">
            <input type="hidden" name="csrftoken" value="<?php echo (isset($this->_rootref['_CSRFTOKEN'])) ? $this->_rootref['_CSRFTOKEN'] : ''; ?>">
			<table width="100%" border="0" cellpadding="4" align="center" cellspacing=0>
			<tr>
				<td colspan="2" align="center"><?php echo ((isset($this->_rootref['L_046'])) ? $this->_rootref['L_046'] : ((isset($MSG['046'])) ? $MSG['046'] : '{ L_046 }')); ?></td>
			</tr>
			<tr>
				<td width="40%" align="right"  valign="top"><b><?php echo ((isset($this->_rootref['L_017'])) ? $this->_rootref['L_017'] : ((isset($MSG['017'])) ? $MSG['017'] : '{ L_017 }')); ?></b></td>
				<td width="60%" ><?php echo (isset($this->_rootref['TITLE'])) ? $this->_rootref['TITLE'] : ''; ?></td>
			</tr>
	<?php if ($this->_rootref['B_SUBTITLE']) {  ?>
			<tr>
				<td width="40%" align="right"  valign="top"><b><?php echo ((isset($this->_rootref['L_806'])) ? $this->_rootref['L_806'] : ((isset($MSG['806'])) ? $MSG['806'] : '{ L_806 }')); ?></b></td>
				<td width="60%" ><?php echo (isset($this->_rootref['SUBTITLE'])) ? $this->_rootref['SUBTITLE'] : ''; ?></td>
			</tr>
	<?php } ?>
			<tr>
				<td  valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_018'])) ? $this->_rootref['L_018'] : ((isset($MSG['018'])) ? $MSG['018'] : '{ L_018 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['AUC_DESCRIPTION'])) ? $this->_rootref['AUC_DESCRIPTION'] : ''; ?></td>
			</tr>
			<tr>
				<td  valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_019'])) ? $this->_rootref['L_019'] : ((isset($MSG['019'])) ? $MSG['019'] : '{ L_019 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['PIC_URL'])) ? $this->_rootref['PIC_URL'] : ''; ?></td>
			</tr>
	<?php if ($this->_rootref['B_GALLERY']) {  ?>
			<tr>
				<td width="260" valign="middle" align="right">&nbsp;</td>
				<td>
				<?php echo ((isset($this->_rootref['L_663'])) ? $this->_rootref['L_663'] : ((isset($MSG['663'])) ? $MSG['663'] : '{ L_663 }')); ?><br>
		<?php $_gallery_count = (isset($this->_tpldata['gallery'])) ? sizeof($this->_tpldata['gallery']) : 0;if ($_gallery_count) {for ($_gallery_i = 0; $_gallery_i < $_gallery_count; ++$_gallery_i){$_gallery_val = &$this->_tpldata['gallery'][$_gallery_i]; ?>
				<a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>preview_gallery.php?img=<?php echo $_gallery_val['K']; ?>" alt="preview" class="new-window"><img src="<?php echo $_gallery_val['IMAGE']; ?>" width=40 hspace=5 border=0></a>
		<?php }} ?>
				</td>
			</tr>
	<?php } if ($this->_rootref['B_BN_ONLY']) {  ?>
			<tr>
				<td valign="top" align="right"><b><?php echo (isset($this->_rootref['MINTEXT'])) ? $this->_rootref['MINTEXT'] : ''; ?></b></td>
				<td><?php echo (isset($this->_rootref['MIN_BID'])) ? $this->_rootref['MIN_BID'] : ''; ?></td>
			</tr>
	<?php } if ($this->_rootref['ATYPE_PLAIN'] == (1)) {  if ($this->_rootref['B_BN_ONLY']) {  ?>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_021'])) ? $this->_rootref['L_021'] : ((isset($MSG['021'])) ? $MSG['021'] : '{ L_021 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['RESERVE'])) ? $this->_rootref['RESERVE'] : ''; ?></td>
			</tr>
		<?php } if ($this->_rootref['B_BN']) {  ?>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_496'])) ? $this->_rootref['L_496'] : ((isset($MSG['496'])) ? $MSG['496'] : '{ L_496 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['BN_PRICE'])) ? $this->_rootref['BN_PRICE'] : ''; ?></td>
			</tr>
		<?php } } ?>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_023'])) ? $this->_rootref['L_023'] : ((isset($MSG['023'])) ? $MSG['023'] : '{ L_023 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['SHIPPING_COST'])) ? $this->_rootref['SHIPPING_COST'] : ''; ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_350_1008'])) ? $this->_rootref['L_350_1008'] : ((isset($MSG['350_1008'])) ? $MSG['350_1008'] : '{ L_350_1008 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['ADDITIONAL_SHIPPING_COST'])) ? $this->_rootref['ADDITIONAL_SHIPPING_COST'] : ''; ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_2__0016'])) ? $this->_rootref['L_2__0016'] : ((isset($MSG['2__0016'])) ? $MSG['2__0016'] : '{ L_2__0016 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['STARTDATE'])) ? $this->_rootref['STARTDATE'] : ''; ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_022'])) ? $this->_rootref['L_022'] : ((isset($MSG['022'])) ? $MSG['022'] : '{ L_022 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['DURATION'])) ? $this->_rootref['DURATION'] : ''; ?></td>
			</tr>
	<?php if ($this->_rootref['B_CUSINC']) {  ?>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_120'])) ? $this->_rootref['L_120'] : ((isset($MSG['120'])) ? $MSG['120'] : '{ L_120 }')); ?></b> </td>
				<td><?php echo (isset($this->_rootref['INCREMENTS'])) ? $this->_rootref['INCREMENTS'] : ''; ?></td>
			</tr>
	<?php } ?>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_261'])) ? $this->_rootref['L_261'] : ((isset($MSG['261'])) ? $MSG['261'] : '{ L_261 }')); ?></b> </td>
				<td><?php echo (isset($this->_rootref['ATYPE'])) ? $this->_rootref['ATYPE'] : ''; ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_025'])) ? $this->_rootref['L_025'] : ((isset($MSG['025'])) ? $MSG['025'] : '{ L_025 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['SHIPPING'])) ? $this->_rootref['SHIPPING'] : ''; ?><br><?php echo (isset($this->_rootref['INTERNATIONAL'])) ? $this->_rootref['INTERNATIONAL'] : ''; ?></td>
			</tr>
			<tr>
				<td align="right" valign="top"><b><?php echo ((isset($this->_rootref['L_25_0215'])) ? $this->_rootref['L_25_0215'] : ((isset($MSG['25_0215'])) ? $MSG['25_0215'] : '{ L_25_0215 }')); ?></b></td>
				<td><?php echo (isset($this->_rootref['SHIPPING_TERMS'])) ? $this->_rootref['SHIPPING_TERMS'] : ''; ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_026'])) ? $this->_rootref['L_026'] : ((isset($MSG['026'])) ? $MSG['026'] : '{ L_026 }')); ?></b> </td>
				<td><?php echo (isset($this->_rootref['PAYMENTS_METHODS'])) ? $this->_rootref['PAYMENTS_METHODS'] : ''; ?></td>
			</tr>
			<tr>
				<td  valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_027'])) ? $this->_rootref['L_027'] : ((isset($MSG['027'])) ? $MSG['027'] : '{ L_027 }')); ?></b></td>
				<td>
					<?php echo (isset($this->_rootref['CAT_LIST1'])) ? $this->_rootref['CAT_LIST1'] : ''; ?>
	<?php if ($this->_rootref['CAT_LIST2'] != ('')) {  ?>
					<br><?php echo (isset($this->_rootref['CAT_LIST2'])) ? $this->_rootref['CAT_LIST2'] : ''; ?>
	<?php } ?>
				</td>
			</tr>
	<?php if ($this->_rootref['B_FEES']) {  ?>
			<tr>
				<td valign="top" align="right"><b><?php echo ((isset($this->_rootref['L_263'])) ? $this->_rootref['L_263'] : ((isset($MSG['263'])) ? $MSG['263'] : '{ L_263 }')); ?></b> </td>
				<td><?php echo (isset($this->_rootref['FEE'])) ? $this->_rootref['FEE'] : ''; ?></td>
			</tr>
	<?php } ?>
			<tr>
				<td  valign="top" align="right"></td>
				<td><?php echo ((isset($this->_rootref['L_264'])) ? $this->_rootref['L_264'] : ((isset($MSG['264'])) ? $MSG['264'] : '{ L_264 }')); ?><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>sell.php?mode=recall"><?php echo ((isset($this->_rootref['L_265'])) ? $this->_rootref['L_265'] : ((isset($MSG['265'])) ? $MSG['265'] : '{ L_265 }')); ?></a><?php echo ((isset($this->_rootref['L_266'])) ? $this->_rootref['L_266'] : ((isset($MSG['266'])) ? $MSG['266'] : '{ L_266 }')); ?><br></td>
			</tr>
	<?php if ($this->_rootref['B_USERAUTH']) {  ?>
			<tr>
				<td align="right"><?php echo ((isset($this->_rootref['L_003'])) ? $this->_rootref['L_003'] : ((isset($MSG['003'])) ? $MSG['003'] : '{ L_003 }')); ?></td>
				<td><b><?php echo (isset($this->_rootref['YOURUSERNAME'])) ? $this->_rootref['YOURUSERNAME'] : ''; ?></b><input type="hidden" name="nick" value="<?php echo (isset($this->_rootref['YOURUSERNAME'])) ? $this->_rootref['YOURUSERNAME'] : ''; ?>">
			</tr>
			<tr>
				<td align="right"><?php echo ((isset($this->_rootref['L_004'])) ? $this->_rootref['L_004'] : ((isset($MSG['004'])) ? $MSG['004'] : '{ L_004 }')); ?></td>
				<td><input type="password" name="password" size="20" maxlength="20" value=""></td>
			</tr>
	<?php } ?>
			</table>
			<div style="text-align:center; padding-top: 10px;">
				<input type="hidden" value="4" name="action">
				<input type="submit" name="" value="<?php echo ((isset($this->_rootref['L_2__0037'])) ? $this->_rootref['L_2__0037'] : ((isset($MSG['2__0037'])) ? $MSG['2__0037'] : '{ L_2__0037 }')); ?>" class="button">
			</div>
			</form>
<?php } else { ?>
			<div class="padding">
				<?php echo ((isset($this->_rootref['L_100'])) ? $this->_rootref['L_100'] : ((isset($MSG['100'])) ? $MSG['100'] : '{ L_100 }')); ?>
                <p><?php echo (isset($this->_rootref['MESSAGE'])) ? $this->_rootref['MESSAGE'] : ''; ?></p>
                <ul>
                	<li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>item.php?id=<?php echo (isset($this->_rootref['AUCTION_ID'])) ? $this->_rootref['AUCTION_ID'] : ''; ?>&mode=1"><?php echo ((isset($this->_rootref['L_101'])) ? $this->_rootref['L_101'] : ((isset($MSG['101'])) ? $MSG['101'] : '{ L_101 }')); ?></a></li>
                    <li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>edit_active_auction.php?id=<?php echo (isset($this->_rootref['AUCTION_ID'])) ? $this->_rootref['AUCTION_ID'] : ''; ?>"><?php echo ((isset($this->_rootref['L_30_0069'])) ? $this->_rootref['L_30_0069'] : ((isset($MSG['30_0069'])) ? $MSG['30_0069'] : '{ L_30_0069 }')); ?></a></li>
                    <li><a href="<?php echo (isset($this->_rootref['SITEURL'])) ? $this->_rootref['SITEURL'] : ''; ?>sellsimilar.php?id=<?php echo (isset($this->_rootref['AUCTION_ID'])) ? $this->_rootref['AUCTION_ID'] : ''; ?>"><?php echo ((isset($this->_rootref['L_2__0050'])) ? $this->_rootref['L_2__0050'] : ((isset($MSG['2__0050'])) ? $MSG['2__0050'] : '{ L_2__0050 }')); ?></a></li>
                </ul>
			</div>
<?php } ?>
		</div>
	</div>
</div>