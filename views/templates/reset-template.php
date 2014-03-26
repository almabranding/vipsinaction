

<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<!--
    again, in reality you'd have this in an external JavaScript file;
    i am using it like this for the sake of the example
-->


<div style="width:400px;">
    <?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
    <ul>
        <li class="row even">
            <?php echo $label_user_password . $user_password ?>
        </li>
        <li class="row even">
            <?php echo $label_confirm_password . $confirm_password ?>
        </li>
    </ul>

</div>
<div class="row last"><?php echo $_btnsubmit ?></div>

