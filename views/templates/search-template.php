

<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<style type="text/css">
    .Zebra_Form .optional { padding: 10px 50px; display: none }
</style>

<!--
    again, in reality you'd have this in an external JavaScript file;
    i am using it like this for the sake of the example
-->
<?
if($this->variables['type']==0 ){
    $info = array(
            'title' => 'accommodation',
            'subtitle' => 'confortable accommodations'
        );
}else if($this->variables['type']==1 ){
    $info = array(
            'title' => 'experience',
            'subtitle' => 'charming experiences'
        );
}

?>
<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<div id="search-box">
    <h1><?= $this->variables['view']->lang[$info['title']] ?></h1>
    <?=$destination?>
    <ul>
        <li class="row">
            <div class="label-box"><label class="uppercase" for=""><?= $this->variables['view']->lang['search'] ?></label><?= $this->variables['view']->lang[$info['subtitle']] ?></div>
            <div class="input-box"><?= $name ?></div>
        </li>
        <li class="row even" id="dates">
            <div class="label-box"><label class="uppercase" for=""><?= $this->variables['view']->lang['dates'] ?></label></div>
            <?= $checkin ?> <?= $checkout ?>
        </li>
        <li class="row">
            <div class="label-box"><label class="uppercase" for=""><?= $this->variables['view']->lang['number'] ?></label><?= $this->variables['view']->lang['of people'] ?><br></div>
            <div  id="number"><div class="first"><?= $label_adults ?><div class="styled-select"><?= $adults ?></div></div><div><?= $label_children ?><div class="styled-select"><?= $children ?></div></div></div>
        </li>
        <li class="row even">
            <div class="label-box"><label class="uppercase" for=""><?= $this->variables['view']->lang['price'] ?></label><?= $this->variables['view']->lang['from-to'] ?></div>
            <div class="input-box"><span>30€</span><input type="range" name="rango" id="rango" value="150" min="0" max="500"><span id="viewPrice">150€</span></div>
            <div style="visibility:hidden;height:0px;"><?= $price ?><?= $type ?></div>
        </li>
        <li class="row even">
            <div class="label-box"><label class="uppercase" for=""><?= $this->variables['view']->lang['search'] ?></label><?= $this->variables['view']->lang['byactivity'] ?><br></div>
            <ul id="activities">
                <li><div><?= $category_1 ?></div><?= $label_category_1 ?></li><li><div><?= $category_2 ?></div><?= $label_category_2 ?></li><li><div><?= $category_3 ?></div><?= $label_category_3 ?></li><li><div><?= $category_4 ?></div><?= $label_category_4 ?></li>
            </ul>
        </li>
    </ul>

    <div class="row last"><?= $_btnsubmit ?></div>
    <div class="clear"></div>
</div>

<script>
    $(document).ready(function() {
        $('#rango').on('change', function() {
            $('#price').val($('#rango').val());
            $('#viewPrice').html($('#rango').val() + '€');

        });
        $('#checkin').Zebra_DatePicker({
            direction: 1,
            format: 'd-m-Y',
            onSelect: function(date) {
                var checkout=$('#checkout').data('Zebra_DatePicker');
                checkout.update({
                    direction: [date, false]
                });
            }
        });
        $('#checkout').Zebra_DatePicker({
            direction: 1,
            format: 'd-m-Y',
            onSelect: function(date) {
                var checkin=$('#checkin').data('Zebra_DatePicker');
                checkin.update({
                    direction: [1,date]
                });
            }
        });
    });
</script>