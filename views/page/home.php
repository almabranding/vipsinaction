<div class="container" id="home">
    <div id="banner" class="royalSlider rsMinW">
        <? for($i=0;$i<4;$i++){ ?><div id="" class="banner-box">
                <ul><li>
                        <div class='label'>
                            <p>ACUDE AL CONCIERTO PRIVADO DE DEPECHE MODE QUE OFRECERÁ EN BARCELONA PARA SÓLO 100  INVITADOS Y CONÓCELOS PERSONALMENTE</p>
 <a href="#" class="button blue uppercase"><?=$this->lang['puja ahora']?>!</a>
                        </div><div class="img"><img src="<?=UPLOAD?>a1.jpg"></div>
                       
                    </li></ul>
            </div><? } ?>
    </div>
    <div id="auctions-list-box">
        <ul id="auctions-list">
            <? for ($i=1;$i<20;$i++) { ?><li><div class="content-box <?=($i%4==0)?'last':''?>">
                    <div class="auctions-list-img-box">
                        <img src="<?=UPLOAD?>a3.jpg">
                    </div>
                    <div class="auctions-list-info">
                        <p>  Cena con e escritor 
                            Quim Monzó</p>
                        <p class="price">Oferta actual: 350€</p>
                    </div>
                </div></li><? } ?>
        </ul>
    </div>
</div>
