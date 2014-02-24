<div id="details">
    <div id="home-search">
        <? $this->search->render('views/templates/search-template.php', false, $this->searchVar); ?>
    </div><div id="home-windows">
        <div id="product-info">

            <div class="cover"><? ?>
                <h1><?= $this->hotel['name'] ?></h1>
                <div id="gallery-tabs" class="img">
                    <? for ($i = 1; $i <= 4; $i++) { ?>
                        <? if ($this->hotel['room_picture_' . $i] != '') { ?>
                            <div class="gallery-content" id="img-<?= $i ?>"><img src="<?= HOTEL_GALLERY . $this->hotel['room_picture_' . $i] ?>"></div>
                        <? }
                    } ?>
                    <ul class="tabs">
                        <? for ($i = 1; $i <= 4; $i++) { ?>
                            <? if ($this->hotel['room_picture_' . $i] != '') { ?>
                                <li class="selected"><a href="#img-<?= $i ?>"><img src="<?= HOTEL_GALLERY . $this->hotel['room_picture_' . $i] ?>"></a></li>
    <? }
} ?>
                    </ul>
                </div>
                <div class="description">
<?= $this->hotel['description'] ?>
                </div>
            </div>

        </div>
    </div>
    <div id="product-detail">
        <div id="detail-tabs">
            <ul class="tabs">
                <li class="selected"><a href="#description"><div>Description</div></a></li>
                <li><a href="#map"><div>Maps</div></a></li>
                <li><a href="#policies"><div>Policies</div></a></li>
            </ul>
            <div class="product-detail-content" id="description">
                <div class='author' id='product-detail-text'>
                <?= $this->hotel['description']; ?>
                </div>
<? if ($this->hotel['author_picture'] != '') { ?>
                    <div id='product-detail-author'>
                        <img src="<?= HOTEL_GALLERY . $this->hotel['author_picture'] ?>">
                        <p>Author: <?= $this->hotel['author_name'] ?></p>
                    </div>
                <? } ?>
            </div>
            <div class="product-detail-content"  id="map">
                <?= $this->hotel['map_code'] ?>
            </div>
            <div class="product-detail-content"  id="policies">
<?= $this->hotel['policies'] ?>
            </div>
        </div>

        <div id="results-list-options">
            <form  method="post" action="/booking/confirmation">
<? if ($this->type != 'gift') { ?>
                    <h2>Availability and booking</h2>
                    <ul>
                        <li>
                            <ul class="results-list-cols results-list-title">
                                <li class="col-options">
                                    Options
                                </li>
                                <li class="col-maxplace">
                                    Maxplace
                                </li>
                                <li class="col-price">
                                    Price
                                </li>
                                <li class="col-places">
                                    Nº Places
                                </li>
                            </ul>
                        </li>
    <? foreach ($this->rooms as $room) { ?><li>
                                <input type="hidden" value="<?= $room['id'] ?>" name="room_id[]"> 
                                <input type="hidden" value="<?= $room['hotel_id'] ?>" name="hotel_id"> 
                                <input type="hidden" value="<?= $room['room_type'] ?>" name="room_type[<?= $room['id'] ?>]"> 
                                <ul class="results-list-cols">
                                    <li class="col-options">
                                        <div class="img"><img src="<?= HOTEL_GALLERY . $room['room_icon_thumb'] ?>"></div>
                                        <div class="description">
        <?= $room['room_short_description'] ?>
                                        </div>
                                    </li>
                                    <li class="col-maxplace">
        <?= $room['room_count'] * ($room['max_adults'] + $room['max_children'] + $room['max_guests']) ?>   X <i class="result-list-person"></i>
                                    </li>
                                    <li class="col-price">
                                        <div>Adults: <span class="price"><?= $room['mon'] ?> €</span></div><div>Childrens: <span class="price"><?= $room['guest_fee'] ?> €</span></div>
                                    </li>
                                    <li class="col-places">
                                        <div class="styled-select-box">
                                            <label id="label_adults" for="adults">ADULTS:</label>
                                            <div class="styled-select">
                                                <select id="adults" class="control" name="adults[<?= $room['id'] ?>]">
                                                    <?
                                                    for ($i = 0; $i <= $room['max_adults']; $i++) {
                                                        echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><div class="styled-select-box">
                                            <label id="label_adults" for="adults">CHILDREN:</label>
                                            <div class="styled-select">
                                                <select id="children" class="control" name="children[<?= $room['id'] ?>]">
                                                    <?
                                                    for ($i = 0; $i <= $room['max_children']; $i++) {
                                                        echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </li><? } ?>
                        <li class="col-reservation">
                            <div class="bookingDates" id="dates">
                                <input type=”text” id="checkin"  name="checkin"  class="datepicker" placeholder="CHECKIN"><input  name="checkout"  placeholder="CHECKOUT" type=”text” id="checkout" class="datepicker"></div><input type="submit" class="bookNow" value="BOOK NOW">
                        </li>
                    </ul>
<? } else { ?>

                    <input type="hidden" value="<?= $this->rooms['room_id'] ?>" name="room_id[]"> 
                    <input type="hidden" value="<?= $this->rooms['hotel_id'] ?>" name="hotel_id"> 
                    <input type="hidden" value="<?= $this->rooms['room_type'] ?>" name="room_type[<?= $this->rooms['room_id'] ?>]"> 
                    <input type="hidden" id="adults" value="<?= $this->rooms['gift_places'] ?>" name="adults[<?= $this->rooms['room_id'] ?>]"> 
                    <input type="hidden" id="children" value="" name="children[<?= $this->rooms['room_id'] ?>]"> 

                    <div class="col-reservation">
                        <div class="bookingDates" id="dates">
                            <input type=”text” id="checkin"  name="checkin"  class="datepicker" placeholder="CHECKIN"><input  name="checkout"  placeholder="CHECKOUT" type=”text” id="checkout" class="datepicker"></div><input type="submit" class="bookNow" value="BOOK NOW">
                    </div>
<? } ?>

            </form>
        </div>
    </div>
</div>
