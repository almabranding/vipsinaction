

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

<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>

<div class="row">
    <?php echo $label_name . $name ?>
</div>
<div class="row even">
    <?php echo $label_modelList . $modelList ?>
</div>
<div class="row">
    <?php echo $label_sex . $sex ?>
</div>
<div class="row even">
    <?php echo $label_category . $category ?>
</div>
<div class="row ">
    <?php echo $label_notifications . $notifications_yes ?>

    <div class="optional optional1">
        <div class="row">
             <div class="col">
            <?= $label_height ?>
             </div>
             <div class="col" style="float:left">
            <?= $height_from.'<div style="float:left;line-height:27px;margin:0 10px;"> - </div> ' .$height_to?>
             </div>
            <div class="clr"></div>
        </div>
        
        <div class="row">
             <div class="col">
            <?= $label_shoes ?>
             </div>
             <div class="col" style="float:left">
            <?= $shoes_from.'<div style="float:left;line-height:27px;margin:0 10px;"> - </div> ' .$shoes_to?>
             </div>
            <div class="clr"></div>
        </div>
        
        <div class="row">
             <div class="col">
            <?= $label_chest ?>
             </div>
             <div class="col" style="float:left">
            <?= $chest_from.'<div style="float:left;line-height:27px;margin:0 10px;"> - </div> ' .$chest_to?>
             </div>
            <div class="clr"></div>
        </div>
        
        <div class="row">
             <div class="col">
            <?= $label_waist ?>
             </div>
             <div class="col" style="float:left">
            <?= $waist_from.'<div style="float:left;line-height:27px;margin:0 10px;"> - </div> ' .$waist_to?>
             </div>
            <div class="clr"></div>
        </div>
        <div class="row">
            <?php echo $label_hairtype . $hairtype ?>
        </div>
        <div class="row">
            <?php echo $label_eyetype . $eyetype ?>
        </div>
        <div class="row">
            <?php echo $label_based_in . $based_in ?>
        </div>
        <div class="row">
            <?php echo $label_mother_agency_id . $mother_agency_id ?>
        </div>
        <div class="row">
            <?php echo $label_active . $active ?>
        </div>
        <div class="row">
            <?php echo $label_public . $public ?>
        </div>
    </div>
</div>

<div class="clear"></div>

<div class="row last"><?php echo $_btnsubmit ?></div>
<script type="text/javascript">
    $segment = $('#notifications_yes');
    if ($segment.is(':checked'))
        $('.optional').show();
    $segment.on('click', function() {
        if ($(this).is(':checked'))
            $('.optional').show();
        else {
            $('.optional :input').val('').removeAttr('checked').removeAttr('selected');
            $('.optional').hide();
        }
    })
</script>
