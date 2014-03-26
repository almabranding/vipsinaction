

<style>
    #contact li{margin: 10px 0;}
        #contact textarea{height: 105px}
</style>
<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
<?= $accounttype ?>

<ul><li class="row">
        <?php echo $label_email . $email ?>
    </li>
    <li class="row">
        <?php echo $label_name . $name ?>
    </li>
    <li class="row even">
        <?php echo $label_subject ?>
        <div class="styled-select">
            <div class='arrow'></div>
            <?php echo $subject ?>
        </div>

    </li>
    <li class="clear"></li>

    <li class="row even">
        <?php echo $label_message . $message ?>
    </li>

    <li class="row last">
        <?php echo $extra_acuerdo . $label_extra_acuerdo ?>
        <?php echo $_btnsubmit ?>
    </li>

</ul>
<div class="clear"></div>


