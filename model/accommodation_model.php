<?php

class Accommodation_Model extends Booking_bridge {

    public $arrAvailableRooms,$params;

    public function __construct() {
        parent::__construct(0);
        
    }

    /* public function searchForm() {
        $action = URL . 'accommodation/results';
        $numChild[0] = "0";
        for ($i = 1; $i <= 14; $i++) {
            $numPeople[$i] = $i;
            $numChild[$i] = $i;
        }
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('search', 'GET', $action, $atributes);
        $form->add('hidden', 'price', '');
        $form->add('hidden', 'type', '2');
        $form->add('text', 'destination', '', array('placeholder' => 'DESTINATION name, city or country'));

        $form->add('label', 'label_adults', 'adults', 'ADULTS:');
        $obj = $form->add('select', 'adults', 2);
        $obj->add_options($numPeople, true);
        $form->add('label', 'label_children', 'children', 'CHILDREN:');
        $obj = $form->add('select', 'children', '');
        $obj->add_options($numChild, true);

        $form->add('text', 'price', '');
        $form->add('text', 'checkin','', array('placeholder' => 'CHECK IN'));
        $form->add('text', 'checkout','', array('placeholder' => 'CHECK OUT'));
//        $date = $form->add('date', 'checkin', '', array('placeholder' => 'CHECK IN'));
//        $date->set_rule(array(
//            'date' => array('error', 'Date is invalid!'),
//        ));
//        $date->disable_zebra_datepicker();
//        $date->format('d M, Y');
//        $date2 = $form->add('date', 'checkout', '', array('placeholder' => 'CHECK OUT'));
//        $date2->set_rule(array(
//            'date' => array('error', 'Date is invalid!'),
//        ));
//        $date2->format('d M, Y');
//        $date2->disable_zebra_datepicker();
        
        $obj = $form->add('radios', 'acitivity', $this->getOptions(), 1);
        $form->add('submit', '_btnsubmit', 'SEARCH EXPERIEENCE');

        if ($form->validate()) {
//            $_SESSION['checkin'] = $date->get_date();
//            $_SESSION['checkout'] = $date2->get_date();
        }
        return $form;
    }

    private function CheckAvailabilityForPeriod($room_id, $checkin_date, $checkout_date, $avail_rooms = 0) {
        $available_rooms = $avail_rooms;
        $available_until_approval = ModulesSettings::Get('booking', 'available_until_approval');

        // calculate total sum, according to week day prices
        $current_date = strtotime($checkin_date);
        $current_year = date('Y');
        $end = strtotime($checkout_date);
        $m_old = '';

        while ($current_date < $end) {
            $y = date('Y', $current_date);
            $m = date('m', $current_date);
            $d = date('d', $current_date);

            if ($m_old != $m) {
                $sql = 'SELECT * 
						FROM ' . DB_PREFIX . 'rooms_availabilities ra
						WHERE ra.room_id = ' . (int) $room_id . ' AND
							  ra.y = ' . (($y == $current_year) ? '0' : '1') . ' AND
							  ra.m = ' . (int) $m;

                $result = $this->db->select($sql);
            }

            if (sizeof($result) > 0) {
                ///echo '<br />'.$result[1].' Room ID: '.$room_id.' Day: '.$d.' Avail: '.$result[0]['d'.(int)$d];
                if ($result[0]['d' . (int) $d] <= 0) {
                    return 0;
                } else {
                    $current_date_formated = date('Y-m-d', $current_date);
                    // check maximal booked rooms for this day!!!
                    $sql = 'SELECT
                    SUM(' . DB_PREFIX . 'bookings_rooms.rooms) as total_booked_rooms
                    FROM ' . TABLE_BOOKINGS . '
                    INNER JOIN ' . DB_PREFIX . 'bookings_rooms ON ' . DB_PREFIX . 'bookings.booking_number = ' . DB_PREFIX . 'bookings_rooms.booking_number
                    WHERE
                        (' . (($available_until_approval == 'yes') ? '' : DB_PREFIX . 'bookings.status = 1 OR ') . ' ' . DB_PREFIX . 'bookings.status = 2) AND
                        ' . DB_PREFIX . 'bookings_rooms.room_id = ' . (int) $room_id . ' AND
                        (
                                (\'' . $current_date_formated . '\' >= checkin AND \'' . $current_date_formated . '\' < checkout) 
                                OR
                                (\'' . $current_date_formated . '\' = checkin AND \'' . $current_date_formated . '\' = checkout) 
                        )';
                    $result1 = $this->db->select($sql);
                    if (sizeof($result1) > 0) {
                        ///echo '<br>T: '.$result[0]['d'.(int)$d].' Reserved/B: '.$result1[0]['total_booked_rooms'];
                        if ($result1[0]['total_booked_rooms'] >= $result[0]['d' . (int) $d]) {
                            return 0;
                        } else {
                            $available_diff = $result[0]['d' . (int) $d] - $result1[0]['total_booked_rooms'];
                            if ($available_diff < $available_rooms) {
                                $available_rooms = $available_diff;
                            }
                        }
                    }
                }
            } else {
                return 0;
            }
            $m_old = $m;
            $current_date = strtotime('+1 day', $current_date);
        }
        return $available_rooms;
    }

   
    public function check_availability($params = array()) {
        $params=$this->getParams();
        $checkin_date = isset($params['checkin_date']) ? $params['checkin_date'] : '';
        $checkout_date = isset($params['checkout_date']) ? $params['checkout_date'] : '';
        $max_adults = isset($params['max_adults']) ? $params['max_adults'] : '';
        $max_children = isset($params['max_children']) ? $params['max_children'] : '';
        $room_id = isset($params['room_id']) ? $params['room_id'] : '';
        $hotel_sel_id = isset($params['hotel_sel_id']) ? $params['hotel_sel_id'] : '';
        $hotel_sel_loc_id = isset($params['hotel_sel_loc_id']) ? $params['hotel_sel_loc_id'] : '';

        $order_by_clause = (isset($params['sort_by'])) ? (($params['sort_by'] == '1-5') ? 'h.stars ASC' : 'h.stars DESC') : 'r.priority_order ASC';
        $hotel_where_clause = (!empty($hotel_sel_id)) ? 'h.id = ' . (int) $hotel_sel_id . ' AND ' : '';
        $hotel_where_clause .= (!empty($hotel_sel_loc_id)) ? 'h.hotel_location_id = ' . (int) $hotel_sel_loc_id . ' AND ' : '';

        $rooms_count = 0;
        $show_fully_booked_rooms = ModulesSettings::Get('booking', 'show_fully_booked_rooms');

        $sql = 'SELECT r.id, r.hotel_id, r.room_count,h.hotel_image,r.max_adults, r.max_children,r.room_count, hd.name, hd.description,rd.room_short_description,rd.room_type,rp.*
		FROM ' . DB_PREFIX . 'rooms r
		INNER JOIN ' . DB_PREFIX . 'hotels h ON r.hotel_id = h.id
                INNER JOIN ' . DB_PREFIX . 'hotels_description hd ON h.id = hd.hotel_id
                INNER JOIN ' . DB_PREFIX . 'rooms_description rd ON r.id = rd.room_id
                INNER JOIN ' . DB_PREFIX . 'rooms_prices rp ON r.id = rp.room_id
                WHERE 1=1 AND 
                ' . $hotel_where_clause . '
                h.is_active = 1 AND
                r.is_active = 1					
                ' . (($room_id != '') ? ' AND r.id=' . (int) $room_id : '') . /* '
                  '.(($max_adults != '') ? ' AND r.max_adults >= '.(int)$max_adults : '').'
                  '.(($max_children != '') ? ' AND r.max_children >= '.(int)$max_children : ''). *//*'
                GROUP BY r.id 
                ORDER BY ' . $order_by_clause;

        $rooms = $this->db->select($sql);
        if (sizeof($rooms) > 0) {
            // loop by rooms
            foreach ($rooms as $room) {
                //echo '<br />'.$room['id'].' '.$room['room_count'];
                // maximum available rooms in hotel for one day
                $maximal_rooms = (int) $room['room_count'];
                $max_booked_rooms = '0';
                $sql = 'SELECT MAX(' . DB_PREFIX . 'bookings_rooms.rooms) as max_booked_rooms
                FROM ' . DB_PREFIX . 'bookings
                INNER JOIN ' . DB_PREFIX . 'bookings_rooms ON ' . DB_PREFIX . 'bookings.booking_number = ' . DB_PREFIX . 'bookings_rooms.booking_number
                WHERE
                (' . DB_PREFIX . 'bookings.status = 1 OR ' . DB_PREFIX . 'bookings.status = 2) AND
                ' . DB_PREFIX . 'bookings_rooms.room_id = ' . (int) $room['id'] . ' AND
                (
                        (\'' . $checkin_date . '\' <= checkin AND \'' . $checkout_date . '\' > checkin) 
                        OR
                        (\'' . $checkin_date . '\' < checkout AND \'' . $checkout_date . '\' >= checkout)
                        OR
                        (\'' . $checkin_date . '\' >= checkin  AND \'' . $checkout_date . '\' < checkout)
                )';

                $rooms_booked = $this->db->select($sql);
                if (sizeof($rooms_booked) > 0) {
                    $max_booked_rooms = (int) $rooms_booked[0]['max_booked_rooms'];
                }

                // this is only a simple check if there is at least one room wirh available num > booked rooms
                $available_rooms = (int) ($maximal_rooms - $max_booked_rooms);
                // echo '<br> Room ID: '.$room['id'].' Max: '.$maximal_rooms.' Booked: '.$max_booked_rooms.' Av:'.$available_rooms;
                // this is advanced check that takes in account max availability for each spesific day is selected period of time
                $fully_booked_rooms = true;
                if ($available_rooms > 0) {
                    $available_rooms_updated = $this->CheckAvailabilityForPeriod($room['id'], $checkin_date, $checkout_date, $available_rooms);
                    $slots=($room['max_adults']+$room['max_children'])*$available_rooms_updated;
                    $tooMany=($available_rooms_updated*$room['max_adults']>=$max_adults && $available_rooms_updated*$room['max_children']>=$max_children)?false:true;
                    if ($available_rooms_updated && !$tooMany) {
                        $rooms_count++;
                        $room['available_rooms'] = $available_rooms_updated;
                        $room['slots'] = $slots;
                        $this->arrAvailableRooms[$room['hotel_id']][] = $room;
                        $fully_booked_rooms = false;
                    }
                }

//				if($show_fully_booked_rooms == 'yes' && $fully_booked_rooms){
//					$rooms_count++;
//					$this->arrAvailableRooms[$room['hotel_id']][] = array('id'=>$room['id'], 'available_rooms'=>'0');
//				}
            }
        }
        return $rooms_count;
    }

 /*   public function check_availabilityOLD() {
        list($checking['year'], $checking['month'], $checking['day']) = explode('-', $_SESSION['checkin']);
        list($checkout['year'], $checkout['month'], $checkout['day']) = explode('-', $_SESSION['checkout']);
        $params = Array(
            'from_year' => $checking['year'],
            'from_month' => $checking['month'],
            'from_day' => $checking['day'],
            'to_year' => $checkout['year'],
            'to_month' => $checkout['month'],
            'to_day' => $checkout['day'],
            'max_adults' => $_GET['adults'],
            'max_children' => $_GET['children'],
        );
        $language_id = strtolower(LANG);
        $checkin_date = $params['from_year'] . '-' . $params['from_month'] . '-' . $params['from_day'];
        $checkout_date = $params['to_year'] . '-' . $params['to_month'] . '-' . $params['to_day'];
        $max_adults = isset($params['max_adults']) ? $params['max_adults'] : '';
        $max_children = isset($params['max_children']) ? $params['max_children'] : '';
        $room_id = isset($params['room_id']) ? $params['room_id'] : '';
        $hotel_sel_id = isset($params['hotel_sel_id']) ? $params['hotel_sel_id'] : '';
        $hotel_sel_loc_id = isset($params['hotel_sel_loc_id']) ? $params['hotel_sel_loc_id'] : '';

        $order_by_clause = (isset($params['sort_by'])) ? (($params['sort_by'] == '1-5') ? 'h.stars ASC' : 'h.stars DESC') : 'r.priority_order ASC';
        $hotel_where_clause = (!empty($hotel_sel_id)) ? 'h.id = ' . (int) $hotel_sel_id . ' AND ' : '';
        $hotel_where_clause .= (!empty($hotel_sel_loc_id)) ? 'h.hotel_location_id = ' . (int) $hotel_sel_loc_id . ' AND ' : '';

        $rooms_count = 0;
        //$show_fully_booked_rooms = ModulesSettings::Get('booking', 'show_fully_booked_rooms');

        $sql = 'SELECT  r.hotel_id,r.max_children,r.max_adults,r.id,h.hotel_image,r.max_adults, r.max_children,r.room_count, hd.name, hd.description,rd.room_short_description,rd.room_type,rp.*
	FROM ' . TABLE_ROOMS . ' r
	INNER JOIN ' . TABLE_HOTELS . ' h ON r.hotel_id = h.id 
        INNER JOIN ' . TABLE_HOTELS_DESCRIPTION . ' hd ON h.id = hd.hotel_id
        INNER JOIN ' . TABLE_ROOMS_DESCRIPTION . ' rd ON r.id = rd.room_id
        INNER JOIN ' . DB_PREFIX . 'rooms_prices rp ON r.id = rp.room_id
	WHERE 1=1 AND 
        ' . $hotel_where_clause . '
        h.is_active = 1 AND
        rp.is_default = 1 AND
        r.is_active = 1					
        ' . (($room_id != '') ? ' AND r.id=' . (int) $room_id : '') . '
        ' . (($max_adults != '') ? ' AND r.max_adults >= ' . (int) $max_adults : '') . '
        ' . (($max_children != '') ? ' AND r.max_children >= ' . (int) $max_children : '') . '
        ' . (($language_id != '') ? ' AND rd.language_id = "' . $language_id . '"' : ' AND rd.language_id = "en"') . '
        ' . (($language_id != '') ? ' AND hd.language_id = "' . $language_id . '"' : ' AND hd.language_id = "en"') . ' AND 
        r.id not IN (select room_id from book_bookings_rooms rb WHERE  
            (
                (\'' . $checkin_date . '\' <= rb.checkin AND \'' . $checkout_date . '\' > rb.checkin) 
                OR
                (\'' . $checkin_date . '\' < rb.checkout AND \'' . $checkout_date . '\' >= rb.checkout)
                OR
                (\'' . $checkin_date . '\' >= rb.checkin  AND \'' . $checkout_date . '\' < rb.checkout)
            )
        ) ORDER BY ' . $order_by_clause;
        $rooms = $this->db->select($sql);
        $cont = 0;
        foreach ($rooms as $key => $val) {
            $hotel_id = $val['hotel_id'];
            if ($val['max_adults'] * 1 > 1000)
                break;
            foreach ($val as $keyH => $valH) {
                $grouparr[$hotel_id][$cont][$keyH] = $valH;
            }
            $cont++;
        }
        return $grouparr;
    }

  

public function getParams() {
        list($checking['year'], $checking['month'], $checking['day']) = explode('-', $_SESSION['checkin']);
        list($checkout['year'], $checkout['month'], $checkout['day']) = explode('-', $_SESSION['checkout']);
        $this->params = Array(
            'checkin_date'=>$_SESSION['checkin'],
            'checkout_date'=>$_SESSION['checkout'],
            'from_year' => $checking['year'],
            'from_month' => $checking['month'],
            'from_day' => $checking['day'],
            'to_year' => $checkout['year'],
            'to_month' => $checkout['month'],
            'to_day' => $checkout['day'],
            'max_adults' => $_GET['adults'],
            'max_children' => $_GET['children'],
        );
        return  $this->params;
    }
    public function getBookingInfo() {
        $booking = Array(
            'adults' => $_GET['adults'],
            'children' => $_GET['children'],
            'checkin' => $_SESSION['checkin'],
            'checkout' => $_SESSION['checkout'],
        );
        list($booking['from_year'], $booking['from_month'], $booking['from_day']) = explode('-', $_SESSION['checkin']);
        list($booking['to_year'], $booking['to_month'], $booking['to_day']) = explode('-', $_SESSION['checkout']);
        return $booking;
    }  *   */
    

    

}
