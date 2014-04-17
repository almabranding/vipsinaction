<section id="bid-content">
    <h2><?= $this->variables['sol_cod_tel'] ?></h2>
    <p><?= $this->variables['confirmacion_puja_text'] ?></p>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?= (isset($zf_error) ? $zf_error : (isset($error) ? $error : '')) ?>
    <?= $accounttype ?>
    <style>
        ul li{margin: 10px 0;}
        #algunaDuda{
            float: right;
            position: relative;
            right: 20px;
        }
    </style>
    <ul>
        <li class="row card_saved" style="">
            <div style="width: 80%;">
                <?= $label_prefix ?>
                <div class="styled-select">
                    <div class='arrow'></div>
                    <?= $prefix ?>
                </div>  
            </div>
        <li class="row num_tel" style="">
            <?= $label_num_tel . $num_tel ?>
        <li class="row send_code">
            <?= $_btnsubmit ?>
        </li>
    </ul>   
</section>

<div class="colaboradores-separator"></div>