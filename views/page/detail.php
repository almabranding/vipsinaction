<div id="details">
    <div id="home-search">
        <? $this->search->render('views/templates/search-template.php', false, $this->searchVar); ?>
    </div><div id="home-windows">
        <div id="product-info">

            <div class="cover"><? ?>
                <h1><?= $this->hotel['name'] ?></h1>
                <div id="gallery-tabs" class="img">
                    <? for ($i = 1; $i <= 4; $i++) { ?>
                        <? if ($this->hotel['gallery'][$i] != null) { ?>
                            <div class="gallery-content" id="img-<?= $i ?>"><img src="<?= $this->hotel['gallery'][$i] ?>"></div>
                        <?
                        }
                    }
                    ?>
                    <ul class="tabs">
                        <? for ($i = 1; $i <= 4; $i++) { ?>
                            <? if ($this->hotel['gallery'][$i] != null) { ?>
                                <li class="selected"><a href="#img-<?= $i ?>"><img src="<?= $this->hotel['gallery'][$i] ?>"></a></li>
                            <?
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="description">
<?= $this->hotel['short_description'] ?>
                </div>
            </div>

        </div>
    </div>
    <div id="product-detail">
        <div id="detail-tabs">
            <ul class="tabs capitalize">
                <li class="selected"><a href="#description"><div><?=$this->lang['description']?></div></a></li>
                <li><a href="#map"><div><?=$this->lang['maps']?></div></a></li>
                <li><a href="#policies"><div><?=$this->lang['policies']?></div></a></li>
            </ul>
            <div class="product-detail-content" id="description">
                <div class='author' id='product-detail-text'>
                <?= $this->hotel['description']; ?>
                </div>
<? if ($this->hotel['author_picture'] != '') { ?>
                    <div id='product-detail-author'>
                        <div id='product-detail-author-box'>
                        <img src="<?= HOTEL_GALLERY . $this->hotel['author_picture'] ?>">
                        </div>
                        <p><span class='capitalize'>Author:</span> <?= $this->hotel['author_name'] ?></p>
                    </div>
                <? } ?>
            </div>
            <div class="product-detail-content"  id="map">
                <img src="<?= HOTEL_IMAGE . $this->hotel['map_image'] ?>">
            </div>
            <div class="product-detail-content"  id="policies">
<?= $this->hotel['policies'] ?>
            </div>
        </div>

        <div id="results-list-options">
            <form id="booking"  method="post" action="/booking/confirmation">
<? if ($this->type != 'gift') { ?>
                    <h2><?=$this->lang['Availability and booking']?></h2>
                    <ul>
                        <li>
                            <ul class="results-list-cols results-list-title capitalize">
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
                                    <?=$this->lang['description']?>
                                </li>
                            </ul>
                        </li>
    <? foreach ($this->rooms as $room) { ?><li>
                                <input type="hidden" value="<?= $room['room_id'] ?>" name="room_id[]"> 
                                <input type="hidden" value="<?= $room['hotel_id'] ?>" name="hotel_id[<?= $room['room_id'] ?>]"> 
                                <input type="hidden" value="<?= $room['room_type'] ?>" name="room_type[<?= $room['id'] ?>]"> 
                                <ul class="results-list-cols">
                                    <li class="col-options">
                                        <div class="img"><img src="<?= HOTEL_GALLERY . $room['room_icon'] ?>"></div>
                                        <div class="description">
        <?= $room['room_short_description'] ?>
                                        </div>
                                    </li>
                                    <li class="col-maxplace">
        <?= $room['room_count']*$room['beds'] ?>   X <i class="result-list-person"></i>
                                    </li>
                                    <li class="col-price">
                                        <div class="capitalize"><?=$this->lang['adults']?>: <span class="price"><?= $room['adult_price'] ?> €</span></div><div class='capitalize'><?=$this->lang['children']?>: <span class="price"><?= $room['children_price'] ?> €</span></div>
                                    </li>
                                    <li class="col-places">
                                        <div class="styled-select-box">
                                            <label id="label_adults" for="adults" class='uppercase'><?=$this->lang['adults']?>:</label>
                                            <div class="styled-select">
                                                <select id="adults" class="control" name="adults[<?= $room['room_id'] ?>]">
                                                    <?
                                                    for ($i = 0; $i <= ($room['max_adults']*$room['room_count']); $i++) {
                                                        echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><div class="styled-select-box">
                                            <label id="label_adults" for="adults" class='uppercase'><?=$this->lang['children']?>:</label>
                                            <div class="styled-select">
                                                <select id="children" class="control" name="children[<?= $room['room_id'] ?>]">
                                                    <?
                                                    for ($i = 0; $i <= ($room['max_children']*$room['room_count']); $i++) {
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
                                <input type=”text” id="checkin"  name="checkin"  class="datepicker" placeholder="<?=$this->lang['check in']?>"><input  name="checkout"  placeholder="<?=$this->lang['check out']?>" type=”text” id="checkout" class="datepicker"></div><input type="submit" class="bookNow" value="<?=$this->lang['book now']?>">
                        </li>
                    </ul>
<? } else { ?>
    <? foreach ($this->rooms as $room) { ?>
                        <input type="hidden" value="<?= $room['room_id'] ?>" name="room_id[]"> 
                        <input type="hidden" value="<?= $room['hotel_id'] ?>" name="hotel_id[<?= $room['room_id'] ?>]"> 
                        <input type="hidden" value="<?= $room['room_type'] ?>" name="room_type[<?= $room['room_id'] ?>]"> 
                        <input type="hidden" value="<?= $this->hotel['places'] ?>" name="adults[<?= $room['room_id'] ?>]"> 
                        <input type="hidden" value="0" name="children[<?= $room['room_id'] ?>]"> 
    <? } ?>
                    <input type="hidden" value="<?= $this->hotel['id'] ?>" name="gift"> 
                    <div class="col-reservation">
                        <div class="bookingDates" id="dates">
                            <input type=”text” id="checkin"  name="checkin"  class="datepicker" placeholder="<?=$this->lang['check in']?>"><input  name="checkout"  placeholder="<?=$this->lang['check out']?>" type=”text” id="checkout" class="datepicker"></div><input type="submit" class="bookNow" value="<?=$this->lang['book now']?>">
                    </div>
<? } ?>
            </form>
        </div>
        <div id="errorMsg"></div>
    </div>
</div>
