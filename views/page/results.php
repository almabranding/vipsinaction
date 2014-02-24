<div id="results">
    <div id="home-search">
        <? $this->search->render('views/templates/search-template.php', false, $this->searchVar); ?>
    </div><div id="home-windows">
        <ul id="results-list">
            <? $cont = 0;
            foreach ($this->availability as $key => $hotel) {
                ?><li>
                    <div class="cover">
                        <h1><?= $hotel[$cont]['name'] ?></h1>
                        <div class="img">
                            <img src="<?= HOTEL_IMAGE . $hotel[$cont]['hotel_image'] ?>">
                        </div>
                        <div class="description">
    <?= $hotel[$cont]['description'] ?>
                            <a href="/experience/detail/<?= $hotel[$cont]['hotel_id'] ?>/<?= $hotel[$cont]['name'] ?>" class="more"><?=$this->lang['more']?></a>
                        </div>
                        <h2>Availability and booking</h2>
                    </div>
                    <ul id="results-list-options">
                        <li>
                            <ul class="results-list-cols results-list-title">
                                <li class="col-options">
                                    <?=$this->lang['options']?>
                                </li>
                                <li class="col-maxplace">
                                    <?=$this->lang['maxplace']?>
                                </li>
                                <li class="col-price">
                                    <?=$this->lang['price']?>
                                </li>
                                <li class="col-places">
                                    Nº Places
                                </li>
                            </ul>
                        </li>
                        <form id="booking"  method="post" action="/booking/confirmation">
                        <? foreach ($hotel as $keyR => $room) {  ?><li>
                                    <ul class="results-list-cols">
                                        <input type="hidden" value="<?= $room['room_id'] ?>" name="room_id[]"> 
                                        <input type="hidden" value="<?= $room['hotel_id'] ?>" name="hotel_id[<?= $room['room_id'] ?>]"> 
                                        <input type="hidden" value="<?= $room['room_type'] ?>" name="room_type[<?= $room['room_id'] ?>]"> 
                                        <li class="col-options">
                                            <div class="img"><img src="<?= $room['img'] ?>"></div>
                                            <div class="description">
                                            <?= '<p class="title">' . $room['room_type'] . '</p><p class="desc">' . $room['room_short_description'] . '</p>' ?>
                                            </div>
                                        </li>
                                        <li class="col-maxplace">
                                        <?= $room['available_rooms']*$room['beds'] ?>   X <i class="result-list-person"></i>
                                        </li>
                                        <li class="col-price">
                                            <div class='capitalize'><?=$this->lang['adults']?>: <span class="price"><?= $room['adult_price'] ?> €</span></div><div class='capitalize'><?=$this->lang['children']?>: <span class="price"><?= $room['children_price'] ?> €</span></div>
                                        </li>
                                        <li class="col-places">
                                            <div class="styled-select-box">
                                                <label id="label_adults" for="adults" class='uppercase'><?=$this->lang['adults']?>:</label>
                                                <div class="styled-select">
                                                    <select id="adults" class="control" name="adults[<?= $room['room_id'] ?>]" autocomplete="off">
                                                        <? 
                                                        for ($i = 0; $i <= ($room['max_adults']*$room['available_rooms']); $i++) {
                                                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div><div class="styled-select-box">
                                                <label id="label_adults" for="adults" class='uppercase'><?=$this->lang['children']?>:</label>
                                                <div class="styled-select">
                                                    <select id="children" class="control" name="children[<?= $room['room_id'] ?>]" autocomplete="off">
                                                        <?
                                                        for ($i = 0; $i <= ($room['max_children']*$room['available_rooms']); $i++) {
                                                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li><? } ?><li class="col-reservation">
                                <div class="bookingDates" id="dates">
                                    <input type=”text” id="checkin" name="checkin" placeholder="<?=$this->lang['check in']?>" value="<?= $_GET['checkin'] ?>" class="datepicker"><input name="checkout"  value="<?= $_GET['checkout'] ?>"  type=”text” id="checkout" class="datepicker"  placeholder="<?=$this->lang['check out']?>"></div><input type="submit" class="bookNow" value="<?=$this->lang['book now']?>">
                            </li>
                        </form>
                    </ul>
                </li><? $cont++;} ?>
        </ul>
    <div id='errorMsg'></div>
    </div>
</div>
<script>
   
</script>