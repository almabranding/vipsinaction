<section id="bid-content">
    <h2><?= $this->variables['sol_ver_cod'] ?></h2>
    <p><?= $this->variables['ver_cod_text'] ?></p>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?= (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
    <?= $accounttype ?>
    <style>
        ul li{margin: 10px 0;}
      
    </style>
    <ul>
        <li class="row num_code" style="">
            <?= $label_code . $code ?>
        <li class="row send_code">
<?= $_btnsubmit ?>
        </li>
        <li>
            <span class="red"><?=$label_error?></span></li>
    </ul>   
</section>

<div class="colaboradores-separator"></div>
