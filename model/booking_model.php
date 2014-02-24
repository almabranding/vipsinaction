<?php

class Booking_Model extends Model {

    public $params, $arrReservation;
    private $fieldDateFormat;
    private $cartItems;
    private $roomsCount;
    private $cartTotalSum;
    private $firstNightSum;
    private $currentCustomerID;
    private $selectedUser = 'customer';
    private $vatPercent = 0;
    private $discountPercent = 0;
    private $discountCampaignID;
    private $discountCoupon;
    private $currencyFormat;
    private $paypal_form_type;
    private $paypal_form_fields;
    private $paypal_form_fields_count;
    private $first_night_possible;
    private $firstNightCalculationType = 'real';
    private $bookingInitialFee = '0';
    private $vatIncludedInPrice = 'no';
    private $maximumAllowedReservations = '10';

    public function __construct() {
        parent::__construct();
        $this->currentCustomerID = (Session::get('userid') != '') ? Session::get('userid') : '';
    }

    public function bookingForm() {
        $action = URL . LANG . '/booking/reservation';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $user = $this->getUser($_SESSION['userid']);

        $form = new Zebra_Form('bookingForm', 'POST', $action, $atributes);
        if (!isset($_POST['giftType'])) {
            $form->add('hidden', 'checkin', $_POST['checkin']);
            $form->add('hidden', 'checkout', $_POST['checkout']);
            foreach ($_POST['room_id'] as $id => $room_id) {
                $form->add('hidden', 'room_id[]', $room_id);
            }
            foreach ($_POST['hotel_id'] as $id => $hotel_id) {
                $form->add('hidden', 'hotel_id[]', $hotel_id);
            }
            foreach ($_POST['room_type'] as $id => $room_type) {
                $form->add('hidden', 'room_type[' . $id . ']', $room_type);
            }
            foreach ($_POST['adults'] as $id => $adults) {
                $form->add('hidden', 'adults[' . $id . ']', $adults);
            }
            foreach ($_POST['children'] as $id => $children) {
                $form->add('hidden', 'children[' . $id . ']', $children);
            }
        }
        if (isset($_POST['giftType'])) {
            $form->add('hidden', 'rec_first_name', $_POST['first_name']);
            $form->add('hidden', 'rec_last_name', $_POST['last_name']);
            $form->add('hidden', 'rec_email', $_POST['email']);
            $form->add('hidden', 'rec_message', $_POST['message']);
            $form->add('hidden', 'giftType', $_POST['giftType']);
        }
        if (isset($_POST['gift'])) {
            $form->add('hidden', 'gift', $_POST['gift']);
        }


        $form->add('label', 'label_first_name', 'first_name', $this->lang['fullname'] . ':');
        $form->add('text', 'first_name', $user['first_name'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Fullname of the booker']));

        $form->add('label', 'label_last_name', 'last_name', $this->lang['surname'] . ':');
        $form->add('text', 'last_name', $user['last_name'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Surnames of the booker']));

        $form->add('label', 'label_email', 'fullname', $this->lang['email'] . ':');
        $form->add('text', 'email', $user['email'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Contact e-mail']));

        $form->add('label', 'label_phone', 'surname', $this->lang['phone'] . ':');
        $form->add('text', 'phone', $user['phone'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Contact phone']));

        $form->add('label', 'label_city', 'fullname', $this->lang['city'] . ':');
        $form->add('text', 'city', $user['city'], array('autocomplete' => 'off', 'placeholder' => $this->lang['City of the booker']));

        $form->add('label', 'label_country', 'country', $this->lang['country'] . ':');
        $form->add('text', 'country', $user['country'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Country of the booker']));

        $form->add('label', 'label_cardholder', 'cardholder', $this->lang['card holder'] . ':');
        $form->add('text', 'cardholder', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['Cardholder´s fullname']));

        $form->add('label', 'label_cardnumber', 'cardnumber', $this->lang['card number'] . ':');
        $form->add('text', 'cardnumber', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['Credit card number']));

        $form->add('label', 'label_giftcode', 'giftcode', $this->lang['gift code'] . ':');
        $form->add('text', 'giftcode', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['Gift Code']));

        $form->add('label', 'label_cardtype', 'cardtype', $this->lang['card type'] . ':');
        $obj = $form->add('select', 'cardtype', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['Please, select card type']));
        $obt['visa'] = 'Visa';
        $obt['mastercard'] = 'Master Card';
        $obj->add_options($obt, true);
        unset($obt);

        $form->add('label', 'label_expire', 'expire', $this->lang['expired date'] . ':');
        $obj = $form->add('select', 'month', 0, array('autocomplete' => 'off', 'placeholder' => 'Month'));
        $obt[''] = '';
        for ($i = 1; $i <= 12; $i++) {
            $obt[$i] = $i;
        }
        $obj->add_options($obt, true);
        unset($obt);
        $obj = $form->add('select', 'year', 0, array('autocomplete' => 'off', 'placeholder' => 'Year'));
        $obt[''] = '';
        for ($i = date('Y'); $i < date('Y') + 10; $i++) {
            $obt[$i] = $i;
        }
        $obj->add_options($obt, true);
        unset($obt);

        $form->add('label', 'label_cvv', 'cvv', 'CVV:');
        $form->add('text', 'cvv', '', array('autocomplete' => 'off', 'placeholder' => '?'));

        $form->add('label', 'label_request', 'request', 'Please write your requests:');
        $obj = $form->add('textarea', 'request', '');
        $form->add('submit', '_btnsubmit', $this->lang['check and confirm']);


        $form->validate();
        return $form;
    }

    public function getBookingInfo() {
        $language_id = strtolower(LANG);
        $rooms_count = 0;
        $show_fully_booked_rooms = ModulesSettings::Get('booking', 'show_fully_booked_rooms');
        $adults = 0;
        $children = 0;
        list($checking['year'], $checking['month'], $checking['day']) = explode('-', $_POST['checkin']);
        list($checkout['year'], $checkout['month'], $checkout['day']) = explode('-', $_POST['checkout']);
        foreach ($_POST['room_id'] as $i => $room) {
            if ($_POST['adults'][$room] > 0 || $_POST['children'][$room] > 0) {
                $room_id = isset($_POST['room_id'][$i]) ? $_POST['room_id'][$i] : '';
                $sql = 'SELECT  r.hotel_id,r.beds,r.id,h.hotel_image,r.max_adults, r.max_children,r.room_count, hd.name, hd.description,rd.room_short_description,rd.room_type,rp.*
                FROM ' . TABLE_ROOMS . ' r
                INNER JOIN ' . TABLE_HOTELS . ' h ON r.hotel_id = h.id 
                INNER JOIN ' . TABLE_HOTELS_DESCRIPTION . ' hd ON h.id = hd.hotel_id
                INNER JOIN ' . TABLE_ROOMS_DESCRIPTION . ' rd ON r.id = rd.room_id
                INNER JOIN ' . DB_PREFIX . 'rooms_prices rp ON r.id = rp.room_id
                WHERE 1=1 AND 
                h.is_active = 1 AND
                rp.is_default = 1 AND
                r.is_active = 1					
                ' . (($room_id != '') ? ' AND r.id=' . (int) $room_id : '');
                $rooms = $this->db->selectOne($sql);
                $numRooms = ($_POST['adults'][$room] + $_POST['children'][$room]) / $rooms['beds'];
                $datetime1 = new DateTime($_POST['checkin']);
                $datetime2 = new DateTime($_POST['checkout']);
                $nights = $datetime1->diff($datetime2);
                $this->params[$room_id] = Array(
                    'room_id' => $room_id,
                    'places' => $rooms['beds'],
                    'numRooms' => $numRooms,
                    'rooms' => $numRooms,
                    'nights' => $nights->days,
                    'hotel_id' => (int) $_POST['hotel_id'],
                    'hotel_image' => HOTEL_IMAGE . $rooms['hotel_image'],
                    'room_type' => $rooms['room_type'],
                    'name' => $rooms['name'],
                    'checkin_date' => $_POST['checkin'],
                    'checkout_date' => $_POST['checkout'],
                    'from_date' => $_POST['checkin'],
                    'to_date' => $_POST['checkout'],
                    'max_adults' => $_POST['adults'][$room],
                    'max_children' => $_POST['children'][$room],
                    'adults' => $_POST['adults'][$room],
                    'children' => $_POST['children'][$room],
                    'from_year' => $checking['year'],
                    'from_month' => $checking['month'],
                    'from_day' => $checking['day'],
                    'to_year' => $checkout['year'],
                    'to_month' => $checkout['month'],
                    'to_day' => $checkout['day'],
                );
                $price = $this->getRoomPrice($room_id, $this->params[$room_id]);
                $this->params[$room_id]['price'] = $price;
            }
        }
        return $this->params;
    }

    public function getGiftList($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select("SELECT * FROM gift_group g JOIN gift_group_description gd ON gd.gift_id=g.id WHERE gd.language_id=:lang", array('lang' => $lang));
        else
            return $this->db->selectOne("SELECT * FROM gift_group g JOIN gift_group_description gd ON gd.gift_id=g.id WHERE gd.gift_id=:id AND gd.language_id=:lang", array('id' => $id, 'lang' => $lang));
    }

    public function giftReservation() {

        $giftInfo = $this->getGiftList($_POST['giftType']);
        $res = array(
            'rec_first_name' => $_POST['rec_first_name'],
            'rec_last_name' => $_POST['rec_last_name'],
            'rec_email' => $_POST['rec_email'],
            'rec_message' => $_POST['rec_message'],
            'gift_group_id' => $_POST['giftType'],
            'code' => $this->GenerateBookingNumber(),
            'customer_id' => $this->currentCustomerID,
            'cc_holder_name' => $_POST['cardholder'],
            'cc_number' => $_POST['cardnumber'],
            'cc_expires_month' => $_POST['month'],
            'cc_expires_year' => $_POST['year'],
            'cc_cvv_code' => $_POST['cvv'],
            'cc_type' => $_POST['cardtype'],
            'gift_group_id' => $_POST['giftType'],
        );
        
        $sql = 'SELECT id
                FROM gift_bookings
                WHERE customer_id = ' . (int) $this->currentCustomerID . ' AND 
                WHERE gift_group_id = ' . (int) $_POST['giftType'] . ' AND 
                status = 0
                ORDER BY id DESC';
        echo $sql;
        $result = $this->db->select($sql);
        
        if ($result[0] > 0) {
            $id = $result[0]['id'];
            $giftId=$id;
            $data = array(
            'status' => 1,
            );
            $this->db->update('gift_bookings', $data, "`id` = '{$id}'");
        }
        $userData = array(
            'customer_id' => $this->currentCustomerID,
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'country' => $_POST['country'],
            'city' => $_POST['city'],
            'price' => $giftInfo['price'],
            'name' => strtoupper($giftInfo['name'])
        );

        $sql = 'UPDATE ' . DB_PREFIX . 'customers
        SET
                first_name = \'' . $userData['first_name'] . '\',
                last_name = \'' . $userData['last_name'] . '\',
                email = \'' . $userData['email'] . '\',
                phone = \'' . $cc_params['phone'] . '\',
                country = \'' . $userData['country'] . '\',
                city = \'' . $userData['city'] . '\'
        WHERE id = \'' . $userData['customer_id'] . '\'';
        $this->db->sqlControl($sql);
        $this->params[] = array_merge($res, $userData);
        if ($giftId) {
            $mail = new MailHelper();
            $mail->getGiftMail($this->params[0]);
        }
        return $giftId;
    }

    public function giftPrepareReservation() {
        echo 1;
        $giftInfo = $this->getGiftList($_POST['giftType']);
        $data = array(
            'status' => 0,
            'rec_first_name' => $_POST['rec_first_name'],
            'rec_last_name' => $_POST['rec_last_name'],
            'rec_email' => $_POST['rec_email'],
            'rec_message' => $_POST['rec_message'],
            'gift_group_id' => $_POST['giftType'],
            'code' => $this->GenerateBookingNumber(),
            'customer_id' => $this->currentCustomerID,
            'cc_holder_name' => $_POST['cardholder'],
            'cc_number' => $_POST['cardnumber'],
            'cc_expires_month' => $_POST['month'],
            'cc_expires_year' => $_POST['year'],
            'cc_cvv_code' => $_POST['cvv'],
            'cc_type' => $_POST['cardtype'],
        );
        $sql = 'SELECT id
                FROM gift_bookings
                WHERE customer_id = ' . (int) $this->currentCustomerID . ' AND
                status = 0
                ORDER BY id DESC';
        echo $sql;
        $result = $this->db->select($sql);
        if ($result[0] > 0) {
            $id = $result[0]['id'];
            $this->db->update('gift_bookings', $data, "`id` = '{$id}'");
            $giftId = $id;
        } else {
            $giftId = $this->db->insert('gift_bookings', $data);
        }
        return $giftId;
    }

    public function getRoomPrice($room_id, $params) {
        // improve: how to make it takes defult price if not found another ?
        // make check periods for 2, 3 days?
        $debug = false;
        $date_from = $params['from_year'] . '-' . ($params['from_month']) . '-' . ($params['from_day']);
        $date_to = $params['to_year'] . '-' . ($params['to_month']) . '-' . ($params['to_day']);
        $room_default_price = $this->GetRoomDefaultPrice($room_id);
        $arr_week_default_price = $this->GetRoomWeekDefaultPrice($room_id);

        // calculate available discounts for specific period of time
        $arr_standard_discounts = $this->GetCampaignInfo('', $date_from, $date_to, 'standard');
        $total_price = '0';
        $offset = 0;
        while ($date_from < $date_to) {
            $curr_date_from = $date_from;
            $offset++;
            $date_from = date('Y-m-d', mktime(0, 0, 0, $params['from_month'], $params['from_day'] + $offset, $params['from_year']));
            //$date_from = $current['year'] . '-' . ($current['mon']) . '-' . ($current['mday']);

            $curr_date_to = $date_from;
            if ($debug)
                echo '<br> (' . $curr_date_from . ' == ' . $curr_date_to . ') ';

            $sql = 'SELECT
                                r.id,
                                r.default_price,
                                r.max_adults,
                                r.max_children,
                                rp.adults,
                                rp.children,
                                rp.mon,
                                rp.tue,
                                rp.wed,
                                rp.thu,
                                rp.fri,
                                rp.sat,
                                rp.sun,
                                rp.sun,
                                rp.is_default
                        FROM ' . DB_PREFIX . 'rooms r
                        INNER JOIN ' . DB_PREFIX . 'rooms_prices rp ON r.id = rp.room_id
                        WHERE
                        r.id = ' . (int) $room_id . ' AND'/*
                      rp.adults >= ' . (int) $params['max_adults'] . ' AND
                      rp.children >= ' . (int) $params['max_children'] . ' AND */
                    . '(
                                (rp.date_from <= \'' . $curr_date_from . '\' AND rp.date_to = \'' . $curr_date_from . '\') OR
                                (rp.date_from <= \'' . $curr_date_from . '\' AND rp.date_to >= \'' . $curr_date_to . '\')
                        ) AND
                        rp.is_default = 0
                        ORDER BY rp.adults ASC, rp.children ASC';
            $room_info = $this->db->select($sql);
            if (sizeof($room_info) > 0) {
                $arr_week_price = $room_info[0];
                // calculate total sum, according to week day prices
                $start = $current_date = strtotime($curr_date_from);
                $end = strtotime($curr_date_to);
                while ($current_date < $end) {

                    // take default weekday price if weekday price is empty
                    if (empty($arr_week_price[strtolower(date('D', $current_date))])) {
                        if ($debug)
                            echo '-' . $arr_week_default_price[strtolower(date('D', $current_date))];
                        $room_price = $arr_week_default_price[strtolower(date('D', $current_date))];
                    }else {
                        if ($debug)
                            echo '=' . $arr_week_price[strtolower(date('D', $current_date))];
                        $room_price = $arr_week_price[strtolower(date('D', $current_date))];
                    }

                    if (isset($arr_standard_discounts[$curr_date_from])) {
                        $room_price = $room_price * (1 - ($arr_standard_discounts[$curr_date_from] / 100));
                        if ($debug)
                            echo ' after ' . $arr_standard_discounts[$curr_date_from] . '%= ' . $room_price;
                    }
                    $total_price += $room_price;
                    $current_date = strtotime('+1 day', $current_date);
                }
            }else {
                // add default (standard) price
                if ($debug)
                    echo '>' . $arr_week_default_price[strtolower(date('D', strtotime($curr_date_from)))];
                $t_price = $arr_week_default_price[strtolower(date('D', strtotime($curr_date_from)))];
                if (!empty($t_price))
                    $room_price = $t_price;
                else
                    $room_price = $room_default_price;

                if (isset($arr_standard_discounts[$curr_date_from])) {
                    $room_price = $room_price * (1 - ($arr_standard_discounts[$curr_date_from] / 100));
                    if ($debug)
                        echo ' after ' . $arr_standard_discounts[$curr_date_from] . '%= ' . $room_price;
                }
                $total_price += $room_price;
            }
        }
        return $total_price;
    }

    private function GetRoomGuestPrice($room_id, $params) {
        $guest_price = '0';

        $sql = 'SELECT
        r.id,
        r.id,
        rp.guest_fee
        FROM ' . TABLE_ROOMS . ' r
        INNER JOIN ' . TABLE_ROOMS_PRICES . ' rp ON r.id = rp.room_id
        WHERE
        r.id = ' . (int) $room_id . ' AND
        (
            (
                rp.is_default = 0 AND 
                rp.adults >= ' . (int) $params['max_adults'] . ' AND
                rp.children >= ' . (int) $params['max_children'] . ' AND 
                ( (rp.date_from <= \'' . $params['from_date'] . '\' AND rp.date_to = \'' . $params['from_date'] . '\') OR
                  (rp.date_from <= \'' . $params['from_date'] . '\' AND rp.date_to >= \'' . $params['to_date'] . '\')
                ) 						
            )
            OR
            (
                rp.is_default = 1
            )
        )
        ORDER BY rp.adults ASC, rp.children ASC, rp.is_default ASC';
        $room_info = $this->db->select($sql);
        if (sizeof($room_info) > 0) {
            $guest_price = $room_info['guest_fee'];
        }

        return $guest_price;
    }

    /**
     * 	Returns room default price
     * 		@param $room_id
     */
    private function GetRoomDefaultPrice($room_id) {
        $sql = 'SELECT
                r.id,
                r.default_price,
                rp.mon,
                rp.tue,
                rp.wed,
                rp.thu,
                rp.fri,
                rp.sat,
                rp.sun,
                rp.sun,
                rp.is_default
        FROM ' . DB_PREFIX . 'rooms r
                INNER JOIN ' . DB_PREFIX . 'rooms_prices rp ON r.id = rp.room_id
        WHERE
                r.id = ' . (int) $room_id . ' AND
                rp.is_default = 1';

        $room_info = $this->db->selectOne($sql);
        if (sizeof($room_info) > 0) {
            return $room_info['mon'];
        } else {
            return $room_info['default_price'];
        }
    }

    /**
     * 	Returns room week default price
     * 		@param $room_id
     */
    private function GetRoomWeekDefaultPrice($room_id) {
        $sql = 'SELECT
            r.id,
            r.default_price,
            rp.mon,
            rp.tue,
            rp.wed,
            rp.thu,
            rp.fri,
            rp.sat,
            rp.sun,
            rp.sun,
            rp.is_default
    FROM ' . DB_PREFIX . 'rooms r
            INNER JOIN ' . DB_PREFIX . 'rooms_prices rp ON r.id = rp.room_id
    WHERE
            r.id = ' . (int) $room_id . ' AND
            rp.is_default = 1';
        $room_default_info = $this->db->selectOne($sql);
        if (sizeof($room_default_info) > 0) {
            return $room_default_info;
        }
        return array();
    }

    public function GetCampaignInfo($campaign_id = '', $from_date = '', $to_date = '', $campaign_type = '') {
        if ($campaign_type == 'standard') {
            $output = array();
            $sql = 'SELECT
                        id,
                        discount_percent,
                        start_date,
                        finish_date
                        FROM ' . TABLE_CAMPAIGNS . '
                        WHERE
                                1=1 AND
                                (
                                        (\'' . $from_date . '\' <= start_date AND \'' . $to_date . '\' > start_date) OR
                                        (\'' . $from_date . '\' < finish_date AND \'' . $to_date . '\' >= finish_date) OR
                                        (\'' . $from_date . '\' >= start_date AND \'' . $to_date . '\' < finish_date)
                                ) AND 
                                is_active = 1 AND
                                campaign_type = \'standard\'					
                        ORDER BY start_date DESC';
            $result = $this->db->select($sql);
            if (sizeof($result) > 0) {
                foreach ($result as $value) {
                    $cdate_from = ($from_date >= $value['start_date']) ? strtotime($from_date) : strtotime($value['start_date']);
                    $cdate_to = ($to_date < $value['finish_date']) ? strtotime($to_date) : strtotime($value['finish_date']);
                    while ($cdate_from < $cdate_to) {
                        $output[date('Y-m-d', $cdate_from)] = $value['discount_percent'];
                        $cdate_from = strtotime('+1 day', $cdate_from);
                    }
                }
            }
        } else {
            $output = array('id' => '', 'discount_percent' => '');
            $from_date = (!empty($from_date)) ? $from_date : @date('Y-m-d');
            $to_date = (!empty($to_date)) ? $to_date : @date('Y-m-d');

            $sql = 'SELECT
                                id,
                                discount_percent,
                                DATE_FORMAT(start_date, \'%M %d\') as start_date,
                                DATE_FORMAT(finish_date, \'%M %d, %Y\') as finish_date,
                                DATE_FORMAT(finish_date, \'%m/%d/%Y\') as formated_finish_date,
                                DATE_FORMAT(finish_date, \'%Y\') as fd_y,
                                DATE_FORMAT(finish_date, \'%m\') as fd_m,
                                DATE_FORMAT(finish_date, \'%d\') as fd_d
                        FROM ' . TABLE_CAMPAIGNS . '
                        WHERE
                                1=1 AND
                                \'' . $from_date . '\' >= start_date AND
                                \'' . $to_date . '\' <= finish_date AND
                                is_active = 1 
                                ' . (($campaign_type != '') ? ' AND campaign_type = \'' . $campaign_type . '\'' : '') . '
                                ' . (($campaign_id != '') ? ' AND id=' . (int) $campaign_id : '') . '
                        ORDER BY start_date DESC';
            $result = $this->db->selectOne($sql);
            if (sizeof($result) > 0) {
                $output['id'] = $result['id'];
                $output['discount_percent'] = $result['discount_percent'];
            }
        }

        return $output;
    }

    public function GetCurrency() {
        $def_currency = '$';
        $sql = 'SELECT * FROM ' . DB_PREFIX . 'currencies WHERE is_default = 1';

        if ($result = $this->db->selectOne($sql)) {
            $def_currency = $result['code'];
        }

        return $def_currency;
    }

    public function bookingReservation() {
        $cc_params = Array(
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['month'],
            'phone' => $_POST['phone'],
            'city' => $_POST['city'],
            'customer_id' => $this->currentCustomerID,
            'country' => $_POST['country'],
            'cc_holder_name' => $_POST['cardholder'],
            'cc_number' => $_POST['cardnumber'],
            'cc_expires_month' => $_POST['month'],
            'cc_expires_year' => $_POST['year'],
            'cc_cvv_code' => $_POST['cvv'],
            'cc_type' => $_POST['cardtype'],
            'request' => $_POST['request'],
        );
        $this->PlaceBooking('', $cc_params);
        //$this->UpdatePaymentDate();
    }

    public function DoReservation($payment_type = '', $additional_info = '', $extras = array(), $pre_payment_type = 'full price', $pre_payment_value = '') {


        $this->currencyCode = $this->GetCurrency();
        $this->currencyRate = '1';
        global $objLogin;
        if (count($this->arrReservation) > 0) {
            $paypal_form_fields_count = 0;
            foreach ($this->arrReservation as $key => $val) {
                $room_price_w_meal_guest = ($val['price']);
                $this->cartItems += 1;
                $this->roomsCount += $val['rooms'];
                $this->cartTotalSum += ($room_price_w_meal_guest / $this->currencyRate);
                if ($this->firstNightCalculationType == 'average') {
                    $this->firstNightSum += ($room_price_w_meal_guest / $val['nights']);
                } else {
                    //$this->firstNightSum += Rooms::GetPriceForDate($key, $val['from_date']);
                }
                if ($val['nights'] > 1)
                    $this->first_night_possible = true;

                if ($this->paypal_form_type == 'multiple') {
                    $this->paypal_form_fields_count++;
                    $this->paypal_form_fields .= draw_hidden_field('item_name_' . $this->paypal_form_fields_count, _ROOM_TYPE . ': ' . $val['room_type'], false);
                    $this->paypal_form_fields .= draw_hidden_field('quantity_' . $this->paypal_form_fields_count, $val['rooms'], false);
                    $this->paypal_form_fields .= draw_hidden_field('amount_' . $this->paypal_form_fields_count, number_format((($val['price'] / $this->currencyRate) / $val['rooms']), '2', '.', ','), false);
                }
            }
        }
        $this->cartTotalSum = number_format($this->cartTotalSum, 2, '.', '');

        if (SITE_MODE == 'demo') {
            $this->error = draw_important_message(_OPERATION_BLOCKED, false);
            return false;
        }

        // check the maximum allowed room reservation per customer
        if ($this->selectedUser == 'customer') {
            $sql = 'SELECT COUNT(*) as cnt FROM ' . DB_PREFIX . 'bookings WHERE customer_id = ' . (int) $this->currentCustomerID . ' AND status < 2';
            $result = $this->db->select($sql);
            $cnt = isset($result[0]['cnt']) ? (int) $result[0]['cnt'] : 0;
            if ($cnt >= $this->maximumAllowedReservations) {
                //$this->error = draw_important_message(_MAX_RESERVATIONS_ERROR, false);
                return false;
            }
        }

        $booking_placed = false;
        $booking_number = '';
        $additional_info = $additional_info;

        $order_price = $this->cartTotalSum;

        // calculate extras
        $extras_sub_total = '0';
        $extras_info = array();
        foreach ($extras as $key => $val) {
            $extr = Extras::GetExtrasInfo($key);
            $extras_sub_total += ($extr['price'] / $this->currencyRate) * $val;
            $extras_info[$key] = $val;
        }
        ///$order_price += $extras_sub_total;
        // calculate discount			
        $discount_value = ($order_price * ($this->discountPercent / 100));
        $order_price_after_discount = $order_price - $discount_value;

        // calculate VAT			 
        $cart_total_wo_vat = round($order_price_after_discount + $extras_sub_total, 2);
        $vat_cost = (($cart_total_wo_vat + $this->bookingInitialFee) * ($this->vatPercent / 100));
        $cart_total = round($cart_total_wo_vat, 2) + $this->bookingInitialFee + $vat_cost;

        if ($pre_payment_type == 'first night') {
            $cart_total = ($this->firstNightSum * (1 + $this->vatPercent / 100));
        } else if (($pre_payment_type == 'percentage') && (int) $pre_payment_value > 0 && (int) $pre_payment_value < 100) {
            $cart_total = ($cart_total * ($pre_payment_value / 100));
        } else if (($pre_payment_type == 'fixed sum') && (int) $pre_payment_value > 0) {
            $cart_total = round($pre_payment_value / $this->currencyRate, 2);
        } else {
            // $cart_total
        }
        if ($this->cartItems > 0) {
            // add order to database
            if (in_array($payment_type, array('poa', 'online', 'paypal', '2co', 'authorize.net', 'bank.transfer'))) {
                if ($payment_type == 'bank.transfer') {
                    $payed_by = '5';
                    $status = '0';
                } else if ($payment_type == 'authorize.net') {
                    $payed_by = '4';
                    $status = '0';
                } else if ($payment_type == '2co') {
                    $payed_by = '3';
                    $status = '0';
                } else if ($payment_type == 'paypal') {
                    $payed_by = '2';
                    $status = '0';
                } else if ($payment_type == 'online') {
                    $payed_by = '1';
                    $status = '0';
                } else {
                    $payed_by = '0';
                    $status = '0';
                }

                // check if prepared booking exists and replace it
                $sql = 'SELECT id, booking_number
                FROM ' . DB_PREFIX . 'bookings
                WHERE customer_id = ' . (int) $this->currentCustomerID . ' AND
                          is_admin_reservation = ' . (($this->selectedUser == 'admin') ? '1' : '0') . ' AND
                          status = 0
                ORDER BY id DESC';
                $result = $this->db->select($sql);
                if ($result[0] > 0) {
                    $booking_number = $result[0]['booking_number'];
                    // booking exists - replace it with new					
                    $sql = 'DELETE FROM ' . DB_PREFIX . 'bookings_rooms WHERE booking_number = \'' . $booking_number . '\'';
                    if (!$this->db->sqlControl($sql)) { /* echo 'error!'; */
                    }

                    $sql = 'UPDATE ' . DB_PREFIX . 'bookings SET ';
                    $sql_end = ' WHERE booking_number = \'' . $booking_number . '\'';
                    $is_new_record = false;
                } else {
                    $sql = 'INSERT INTO ' . DB_PREFIX . 'bookings SET booking_number = \'\',';
                    $sql_end = '';
                    $is_new_record = true;
                }

                $sql .= 'booking_description = \'Rooms Reservation\',
						order_price = ' . $order_price . ',
						pre_payment_type = \'' . $pre_payment_type . '\',
						pre_payment_value = \'' . (($pre_payment_type != 'full price') ? $pre_payment_value : '0') . '\',
						discount_campaign_id = ' . (int) $this->discountCampaignID . ',
						discount_percent = ' . $this->discountPercent . ',
						discount_fee = ' . $discount_value . ',
						vat_fee = ' . $vat_cost . ',
						vat_percent = ' . $this->vatPercent . ',
						initial_fee = ' . $this->bookingInitialFee . ',
						extras = \'' . serialize($extras_info) . '\',
						extras_fee = \'' . $extras_sub_total . '\',
						payment_sum = ' . $cart_total . ',
						additional_payment = 0,						
						currency = \'' . $this->currencyCode . '\',
						rooms_amount = ' . (int) $this->roomsCount . ',						
						customer_id = ' . (int) $this->currentCustomerID . ',
						is_admin_reservation = ' . (($this->selectedUser == 'admin') ? '1' : '0') . ',
						transaction_number = \'\',
						created_date = \'' . date('Y-m-d H:i:s') . '\',
						payment_type = ' . $payed_by . ',
						payment_method = 0,
						coupon_code = \'' . $this->discountCoupon . '\',						
						additional_info = \'' . $additional_info . '\',
						cc_type = \'\',
						cc_holder_name = \'\', 
						cc_number = \'\', 
						cc_expires_month = \'\', 
						cc_expires_year = \'\', 
						cc_cvv_code = \'\',
						status = ' . (int) $status . ',
						status_description = \'\'';
                $sql .= $sql_end;

                // handle booking details
                if ($this->db->sqlControl($sql)) {

                    if ($is_new_record) {
                        $insert_id = $this->db->lastInsertId();
                        $booking_number = $this->GenerateBookingNumber($insert_id);

                        $sql = 'UPDATE ' . DB_PREFIX . 'bookings SET booking_number = \'' . $booking_number . '\' WHERE id = ' . (int) $insert_id;
                        if (!$this->db->sqlControl($sql)) {
                            //$this->error = draw_important_message(_ORDER_ERROR, false);
                        }
                    }

                    $sql = 'INSERT INTO ' . DB_PREFIX . 'bookings_rooms
								(id, booking_number, hotel_id, room_id, room_numbers, checkin, checkout, adults, children, rooms, price, guests, guests_fee, meal_plan_id, meal_plan_price) VALUES ';
                    $items_count = 0;
                    foreach ($this->arrReservation as $key => $val) {
                        $sql .= ($items_count++ > 0) ? ',' : '';
                        $sql .= '(NULL, \'' . $booking_number . '\', ' . (int) $val['hotel_id'] . ', ' . (int) $key . ', \'\', \'' . $val['from_date'] . '\', \'' . $val['to_date'] . '\', \'' . $val['adults'] . '\', \'' . $val['children'] . '\', ' . (int) $val['rooms'] . ', ' . ($val['price'] / $this->currencyRate) . ', ' . (int) $val['guests'] . ', ' . ($val['guests_fee'] / $this->currencyRate) . ', ' . (int) $val['meal_plan_id'] . ', ' . ($val['meal_plan_price'] / $this->currencyRate) . ')';
                    }
                    if ($this->db->sqlControl($sql)) {
                        $booking_placed = true;
                    } else {
//                        $this->error = draw_important_message(_ORDER_ERROR, false);
                    }
                } else {
//                    $this->error = draw_important_message(_ORDER_ERROR, false);
                }
            } else {
//                $this->error = draw_important_message(_ORDER_ERROR, false);
            }
        } else {
//            $this->error = draw_message(_RESERVATION_CART_IS_EMPTY_ALERT, false, true);
        }

        if (SITE_MODE == 'development' && !empty($this->error))
            $this->error .= '<br>' . $sql . '<br>' . mysql_error();

        return $booking_placed;
    }

    public function AddToReservation($room_id, $params) {
        if (!empty($room_id)) {
            //$meal_plan_info = MealPlans::GetPlanInfo($meal_plan_id);
            if (isset($this->arrReservation[$room_id])) {
                // add new info for this room
                $this->arrReservation[$room_id]['from_date'] = $params['from_date'];
                $this->arrReservation[$room_id]['to_date'] = $params['to_date'];
                $this->arrReservation[$room_id]['nights'] = $params['nights'];
                $this->arrReservation[$room_id]['rooms'] = $params['rooms'];
                $this->arrReservation[$room_id]['price'] = $params['price'];
                $this->arrReservation[$room_id]['adults'] = $params['adults'];
                $this->arrReservation[$room_id]['children'] = $params['children'];
                $this->arrReservation[$room_id]['hotel_id'] = (int) $params['hotel_id'];
                //$this->arrReservation[$room_id]['meal_plan_id'] = (int)$params['meal_plan_id'];
                //$this->arrReservation[$room_id]['meal_plan_name'] = isset($meal_plan_info['name']) ? $meal_plan_info['name'] : '';
                //$this->arrReservation[$room_id]['meal_plan_price'] = isset($meal_plan_info['price']) ? number_format($meal_plan_info['price'] * $nights * $adults * $rooms, 2) : 0;
                $this->arrReservation[$room_id]['room_type'] = $params['room_type'];
                //$this->arrReservation[$room_id]['guests']    = $guests;
                //$this->arrReservation[$room_id]['guests_fee'] = number_format($guest_fee * $nights * $adults * $rooms, 2);
            } else {
                // just add new room
                $this->arrReservation[$room_id] = array(
                    'from_date' => $params['from_date'],
                    'to_date' => $params['to_date'],
                    'nights' => $params['nights'],
                    'rooms' => $params['rooms'],
                    'price' => $params['price'],
                    'adults' => $params['adults'],
                    'children' => $params['children'],
                    'hotel_id' => (int) $params['hotel_id'],
                    //'meal_plan_id' => (int)$meal_plan_id,
                    //'meal_plan_name'  => isset($meal_plan_info['name']) ? $meal_plan_info['name'] : '',
                    //'meal_plan_price'  => isset($meal_plan_info['price']) ? number_format($meal_plan_info['price'] * $nights * $adults * $rooms, 2) : 0,
                    'room_type' => $params['room_type'],
                        //'guests'    => $guests,
                        //'guests_fee' => number_format($guest_fee * $nights * $adults * $rooms, 2)
                );
            }
        }
    }

    public function RemoveReservation($room_id) {
        if ((int) $room_id > 0) {
            if (isset($this->arrReservation[$room_id]) && $this->arrReservation[$room_id] > 0) {
                unset($this->arrReservation[$room_id]);
            }
        }
    }

    public function PlaceBooking($additional_info = '', $cc_params = array()) {
        global $objLogin;
        $additional_info = $additional_info;

        if (SITE_MODE == 'demo') {
            $this->message = draw_important_message(_OPERATION_BLOCKED, false);
            return false;
        }

        // check if prepared booking exists
        $sql = 'SELECT id, booking_number
				FROM ' . DB_PREFIX . 'bookings
				WHERE customer_id = ' . (int) $this->currentCustomerID . ' AND
					  is_admin_reservation = ' . (($this->selectedUser == 'admin') ? '1' : '0') . ' AND
					  status = 0
				ORDER BY id DESC';

        $result = $this->db->select($sql);
        if ($result[0] > 0) {
            $booking_number = $result[0]['booking_number'];

            $sql = 'UPDATE ' . DB_PREFIX . 'bookings
					SET
						status_changed = \'' . date('Y-m-d H:i:s') . '\',
						additional_info = \'' . $additional_info . '\',
						cc_type = \'' . $cc_params['cc_type'] . '\',
						cc_holder_name = \'' . $cc_params['cc_holder_name'] . '\',
						cc_number = AES_ENCRYPT(\'' . $cc_params['cc_number'] . '\', \'' . PASSWORDS_ENCRYPT_KEY . '\'),
						cc_expires_month = \'' . $cc_params['cc_expires_month'] . '\',
						cc_expires_year = \'' . $cc_params['cc_expires_year'] . '\',
						cc_cvv_code = \'' . $cc_params['cc_cvv_code'] . '\',
						request = \'' . $cc_params['request'] . '\',
						status = \'1\'
					WHERE booking_number = \'' . $booking_number . '\'';
            $this->db->sqlControl($sql);
            $sql = 'UPDATE ' . DB_PREFIX . 'customers
					SET
						first_name = \'' . $cc_params['first_name'] . '\',
						last_name = \'' . $cc_params['last_name'] . '\',
						email = \'' . $cc_params['email'] . '\',
						phone = \'' . $cc_params['phone'] . '\',
						country = \'' . $cc_params['country'] . '\',
						city = \'' . $cc_params['city'] . '\'
					WHERE id = \'' . $cc_params['customer_id'] . '\'';


            $this->db->sqlControl($sql);

            // update customer bookings/rooms amount
            $sql = 'UPDATE ' . DB_PREFIX . 'customers SET 
						orders_count = orders_count + 1,
						rooms_count = rooms_count + ' . $this->roomsCount . '
					WHERE id = ' . (int) $this->currentCustomerID;
            $this->db->sqlControl($sql);


            //$this->message = draw_success_message(str_replace('_BOOKING_NUMBER_', '<b>' . $booking_number . '</b>', _ORDER_PLACED_MSG), false);
            /* if ($this->SendOrderEmail($booking_number, 'placed', $this->currentCustomerID)) {
              $this->message .= draw_success_message(_EMAIL_SUCCESSFULLY_SENT, false);
              } */

            $sql = 'SELECT * FROM ' . DB_PREFIX . 'customers WHERE id = ' . (int) $this->currentCustomerID;
            $user = $this->db->selectOne($sql);
            $mail = new MailHelper();
            $mail->getBookingMail($this->getBookingInfo(), $user);
        }
        $this->EmptyCart();
    }

    private function GenerateBookingNumber($booking_id = '0') {
        $length = 10;
        $template = '1234567890abcdefghijklmnopqrstuvwxyz';
        settype($template, 'string');
        settype($length, 'integer');
        settype($rndstring, 'string');
        settype($a, 'integer');
        settype($b, 'integer');
        for ($a = 0; $a < $length; $a++) {
            $b = rand(0, strlen($template) - 1);
            $rndstring .= $template[$b];
        }
        return strtoupper($rndstring);
    }

    public function EmptyCart() {
        $this->arrReservation = array();
        $this->arrReservationInfo = array();
        Session::Set('current_customer_id', '');
    }

    public function UpdatePaymentDate($rid) {
        $sql = 'UPDATE ' . DB_PREFIX . 'bookings 
				SET payment_date = \'' . date('Y-m-d H:i:s') . '\'
				WHERE
					id = ' . (int) $rid . ' AND 
					status = 2 AND
					(payment_date = \'\' OR payment_date = \'0000-00-00\')';
        $this->sqlControl($sql);
    }

}
