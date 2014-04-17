<?php

class Auction_Model extends Model {

    public $arrAvailableRooms, $params;

    public function __construct() {
        parent::__construct();
    }

    /* public function auctionForm() {
      $card = (isset($_GET['card'])) ? $_GET['card'] : null;
      $auction_id = (isset($_GET['auction_id'])) ? $_GET['auction_id'] : null;
      $user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : null;
      $bid = (isset($_GET['bid'])) ? $_GET['bid'] : null;
      $user = Session::get('user');
      $auction = $this->getAuction($auction_id);
      if ($user_id != $user['id'])
      return false;
      if ($card)
      $card_data = $this->getCards($user_id, $card);
      $action = URL . 'auction/doBid';
      $atributes = array(
      'enctype' => 'multipart/form-data',
      );
      $form = new Zebra_Form('confirmBid', 'POST', $action, $atributes);
      switch (LANG) {
      case 'es': $form->language('espanol');
      break;
      }
      $form->add('hidden', 'auction_id', $auction_id);
      $form->add('hidden', 'user_id', $user_id);
      $form->add('hidden', 'dobid', 1);
      $form->add('hidden', 'bid', $bid);

      $form->add('label', 'label_cardsaved', 'cardsaved', $this->lang['tarjeta_guardada'] . ':');
      $obj = $form->add('select', 'cardsaved', $card_data['id'], array('autocomplete' => 'off', 'placeholder' => $this->lang['tarjeta_guardada']));
      foreach ($this->getCards($user_id) as $card) {
      $obt[$card['id']] = $card['name'];
      }
      if ($obt)
      $obj->add_options($obt, false);
      unset($obt);

      $form->add('label', 'label_cardholder', 'cardholder', $this->lang['card_holder'] . ':');
      $obj = $form->add('text', 'cardholder', $card_data['holder'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Cardholder_fullname']));

      $obj->set_rule(array(
      'required' => array('error', $this->lang['card_holder'] . ' ' . $this->lang['is required'] . '!'),
      ));

      $form->add('label', 'label_cardnumber', 'cardnumber', $this->lang['card_number'] . ':');
      $obj = $form->add('text', 'cardnumber', $card_data['number'], array('autocomplete' => 'off', 'placeholder' => $this->lang['card_number']));

      $obj->set_rule(array(
      'required' => array('error', $this->lang['card_number'] . ' ' . $this->lang['is required'] . '!'),
      ));
      $form->add('label', 'label_cardtype', 'cardtype', $this->lang['card_type'] . ':');
      $obj = $form->add('select', 'cardtype', $card_data['type'], array('autocomplete' => 'off', 'placeholder' => $this->lang['card_type']));
      $obt['visa'] = 'Visa';
      $obt['mastercard'] = 'Master Card';
      $obj->add_options($obt, true);
      unset($obt);

      $form->add('label', 'label_expire', 'expire', $this->lang['card_date'] . ':');
      $obj = $form->add('select', 'month', $card_data['month'], array('autocomplete' => 'off', 'placeholder' => $this->lang['month']));
      $obt[''] = '';
      for ($i = 1; $i <= 12; $i++) {
      $obt[$i] = $i;
      }
      $obj->add_options($obt, true);
      $obj->set_rule(array(
      'required' => array('error', $this->lang['month'] . ' ' . $this->lang['is required'] . '!'),
      ));
      unset($obt);
      $obj = $form->add('select', 'year', $card_data['year'], array('autocomplete' => 'off', 'placeholder' => $this->lang['year']));
      $obt[''] = '';
      for ($i = date('Y'); $i < date('Y') + 10; $i++) {
      $obt[$i] = $i;
      }
      $obj->add_options($obt, true);
      $obj->set_rule(array(
      'required' => array('error', $this->lang['year'] . ' ' . $this->lang['is required'] . '!'),
      ));
      unset($obt);

      $form->add('label', 'label_cvv', 'cvv', $this->lang['cvv'] . ':');
      $obj = $form->add('text', 'cvv', $card_data['cvv'], array('autocomplete' => 'off', 'placeholder' => $this->lang['cvv']));
      $obj->set_rule(array(
      'length' => array(3, 4, 'error', ''),
      'required' => array('error', 'CVV ' . $this->lang['is required'] . '!'),
      ));
      $form->add('label', 'label_card_name', 'card_name', $this->lang['nombre_tarjeta'] . ':');
      $obj = $form->add('text', 'card_name', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['nombre_tarjeta']));

      $obj = $form->add('checkboxes', 'card[]', array(
      'save_card' => $this->lang['save_card_data'],
      ));

      $obj = $form->add('checkboxes', 'extra[]', array(
      'acuerdo' => $this->lang['leido_acepto'] . ' <a href="'.URL.'terms" target="_blank">' . $this->lang['Acuerdo de usuario'] . '</a>',
      ));
      $obj->set_rule(array(
      'required' => array('error', $this->lang['please_accept']),
      ));
      $form->add('submit', '_btnsubmit', $this->lang['confirma_puja']);

      if ($form->validate()) {
      show_results();
      }
      return $form;
      }
     */

    public function code_request() {
        $card = (isset($_GET['card'])) ? $_GET['card'] : null;
        $code = (isset($_GET['code'])) ? $_GET['code'] : null;
        $auction_id = (isset($_GET['auction_id'])) ? $_GET['auction_id'] : null;
        $user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : null;
        $bid = (isset($_GET['bid'])) ? $_GET['bid'] : null;
        $user = Session::get('user');
        $auction = $this->getAuction($auction_id);
        if ($user_id != $user['id'])
            return false;

        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('code_req', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }

        $form->add('hidden', 'auction_id', $auction_id);
        $form->add('hidden', 'user_id', $user_id);
        $form->add('hidden', 'dobid', 1);
        $form->add('hidden', 'bid', $bid);

        $form->add('label', 'label_prefix', 'prefix', $this->lang['prefix'] . ':');
        $obj = $form->add('select', 'prefix', '', array('autocomplete' => 'off', 'placeholder' => ''));
        foreach ($this->getPrefix() as $card) {
            $obt[$card['number']] = $card['number'];
        }
        if ($obt)
            $obj->add_options($obt, true);
        unset($obt);

        $form->add('label', 'label_num_tel', 'num_tel', $this->lang['num_tel'] . ':');
        $obj = $form->add('text', 'num_tel', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['num_tel']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['num_tel'] . ' ' . $this->lang['is required'] . '!'),
        ));
        $obj = $form->add('submit', '_btnsubmit', $this->lang['sol_cod_tel']);

        if ($form->validate())
            show_results();
        return $form;
    }

    public function code_verification() {
        $code = (isset($_GET['code'])) ? $_GET['code'] : null;
        $auction_id = (isset($_GET['auction_id'])) ? $_GET['auction_id'] : null;
        $user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : null;
        $bid = (isset($_GET['bid'])) ? $_GET['bid'] : null;
        $user = Session::get('user');
        $auction = $this->getAuction($auction_id);
        if ($user_id != $user['id'])
            return false;
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('code_ver', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'auction_id', $auction_id);
        $form->add('hidden', 'user_id', $user_id);
        $form->add('hidden', 'dobid', 1);
        $form->add('hidden', 'bid', $bid);

        if(!$this->resultVerif)
        $form->add('label', 'label_error', '', $this->lang['error_code']);
        $form->add('label', 'label_code', 'code', $this->lang['ver_cod'] . ':');
        $obj = $form->add('text', 'code', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['ver_cod']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['ver_cod'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $obj = $form->add('submit', '_btnsubmit', $this->lang['sol_ver_cod']);
        if ($form->validate()) {
            
        }
        return $form;
    }

    public function auctionForm() {
        $card = (isset($_GET['card'])) ? $_GET['card'] : null;
        $auction_id = (isset($_GET['auction_id'])) ? $_GET['auction_id'] : null;
        $user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : null;
        $bid = (isset($_GET['bid'])) ? $_GET['bid'] : null;
        $user = Session::get('user');
        $auction = $this->getAuction($auction_id);
        $code = $this->getCodes($user_id, $auction_id);
        if ($user_id != $user['id'])
            return false;

        $action = URL . 'auction/doBid';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('confirmBid', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'auction_id', $auction_id);
        $form->add('hidden', 'user_id', $user_id);
        $form->add('hidden', 'dobid', 1);
        $form->add('hidden', 'bid', $bid);

        $form->add('label', 'label_prefix', 'prefix', $this->lang['prefix'] . ':');
        $obj = $form->add('select', 'prefix', '', array('autocomplete' => 'off', 'placeholder' => ''));
        foreach ($this->getPrefix() as $card) {
            $obt[$card['number']] = $card['number'];
        }
        if ($obt)
            $obj->add_options($obt, true);
        unset($obt);

        $form->add('label', 'label_num_tel', 'num_tel', $this->lang['num_tel'] . ':');
        $obj = $form->add('text', 'num_tel', $card_data['number'], array('autocomplete' => 'off', 'placeholder' => $this->lang['num_tel']));


        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="' . URL . 'terms" target="_blank">' . $this->lang['Acuerdo de usuario'] . '</a>',
        ));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['please_accept']),
        ));
        $attr = array(
            'disabled' => 'disabled',
        );
        $obj = $form->add('submit', '_btnsubmit', $this->lang['confirma_puja'], ((!$code['verify'] == 1) ? $attr : ''));

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

    public function getAuction($id = null, $lang = LANG) {
        $time = time();
        if ($id == null)
            $auction = $this->db->select("SELECT * FROM " . BID_PREFIX . "auctions a JOIN " . BID_PREFIX . "auctions_description d ON d.auction_id=a.id JOIN photos p ON p.id=a.photo_id WHERE d.language_id=:lang AND starts<=$time", array('lang' => $lang));
        else {
            $auction = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "auctions a JOIN " . BID_PREFIX . "auctions_description d ON d.auction_id=a.id JOIN photos p ON p.id=a.photo_id WHERE a.id=:id AND d.language_id=:lang AND a.visibility='public' AND starts<=$time", array('id' => $id, 'lang' => $lang));
            if ($auction['ofrecido_id'] != '') {
                $ofrecido = $this->db->selectOne("SELECT a.img_date as ofrecido_date,a.file_name as file_ofrecido FROM photos a WHERE a.id=:id", array('id' => $auction['ofrecido_id']));
                if ($ofrecido)
                    $auction = array_merge($auction, $ofrecido);
            }
            if ($auction['donated'] != '') {
                $donated = $this->db->selectOne("SELECT dd1.name donated_name,dd1.donantes_id as donated_id FROM donantes_description dd1 JOIN donantes dd ON dd.id=dd1.donantes_id JOIN photos p ON p.id=dd.photo_id WHERE dd1.donantes_id=:id AND dd1.language_id=:lang", array('id' => $auction['donated'], 'lang' => $lang));
                if ($donated)
                    $auction = array_merge($auction, $donated);
            }
            if ($auction['for'] != '') {
                $for = $this->db->selectOne("SELECT dd2.name for_name,dd2.donantes_id as for_id, p.img_date as for_img_date, p.file_name as for_file_name FROM donantes_description dd2 JOIN donantes dd ON dd.id=dd2.donantes_id JOIN photos p ON p.id=dd.photo_id WHERE dd2.donantes_id=:id AND dd2.language_id=:lang", array('id' => $auction['for'], 'lang' => $lang));
                if ($for)
                    $auction = array_merge($auction, $for);
            }
        }
        if (!$auction)
            throw new Exception($this->lang['no_auction_found']);
        return $auction;
    }

    public function getCodes($user_id, $bid_id) {
        return $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "codes WHERE user_id=:user_id AND bid_id=:bid_id", array('user_id' => $user_id, 'bid_id' => $bid_id));
    }

    public function generateCode($user_id, $bid_id) {
        $tel = (isset($_POST['prefix'])) ? $_POST['prefix'] : '';
        $tel .=( (isset($_POST['num_tel'])) ? $_POST['num_tel'] : '');
        $length = 6;
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $data = array(
            'user_id' => $user_id,
            'bid_id' => $bid_id,
            'code' => $key,
            'tel' => $tel,
            'try' =>0,
            'date_created' => $this->getTimeSQL(),
            'verify' => 0
        );
        $exist = $this->getCodes($user_id, $bid_id);
        if ($exist)
            $this->db->update(BID_PREFIX . 'codes', $data, "`user_id` = '{$user_id}' AND `bid_id` = '{$bid_id}'");
        else
            $this->db->insert(BID_PREFIX . 'codes', $data);
        //$this->sendCode($tel, $key);
        return $key;
    }

    public function sendCode($tel, $code) {

        $dms = new dms_send;

//Autentificar
        $dms->autentificacion->idcli = "214357";
        $dms->autentificacion->username = "mayorec";
        $dms->autentificacion->passwd = "popo1234";


//Configurar envio
        $dms->remitente = "";

//Agregar mensajes
        $dms->mensajes->add("1", $tel, $this->lang["your_code"] . $code, 'Mycausa.com');
        $dms->send();
    }

    public function verifyCode($user_id, $bid_id) {
        $code = (isset($_POST['code'])) ? $_POST['code'] : '';
        $exist = $this->getCodes($user_id, $bid_id);
        if ($exist['code'] == strtolower($code)) {
            unset($data);
            $data = array(
                'verify' => 1
            );
            $this->db->update(BID_PREFIX . 'codes', $data, "`user_id` = '{$user_id}' AND `bid_id` = '{$bid_id}'");
            return true;
        }else{
            unset($data);
            $data = array(
                'try' => $exist['try']+1
            );
            $this->db->update(BID_PREFIX . 'codes', $data, "`user_id` = '{$user_id}' AND `bid_id` = '{$bid_id}'");
        }
        return false;
    }

    public function getPrefix($id = null) {
        if ($id == null)
            return $this->db->select("SELECT * FROM " . BID_PREFIX . "prefix ORDER BY position,name");
        else
            return $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "tels WHERE  id=:id ORDER BY name", array('id' => $id));
    }

    public function getTels($user_id, $card_id = null) {
        if ($card_id == null)
            return $this->db->select("SELECT * FROM " . BID_PREFIX . "tels WHERE user_id=:id ORDER BY name", array('id' => $user_id));
        else
            return $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "tels WHERE user_id=:user_id AND id=:tel_id ORDER BY name", array('user_id' => $user_id, 'tel_id' => $card_id));
    }

    public function getBids($auction) {
        $bids = $this->db->select("SELECT * FROM " . BID_PREFIX . "bids b JOIN " . BID_PREFIX . "users u ON u.id=b.bidder WHERE auction=:id ORDER BY bid DESC, b.id DESC", array('id' => $auction['auction_id']));
        $num_bids = sizeof($bids);
        $high_bid = $auction['current_bid'];
        $minimum_bid = $auction['minimum_bid'];
        $customincrement = $auction['increment'];
        $high_bid = ($num_bids == 0) ? $minimum_bid : $high_bid;

        if ($customincrement == 0) {
            // Get bid increment for current bid and calculate minimum bid
            $query = "SELECT increment FROM " . BID_PREFIX . "increments WHERE
			((low <= " . $high_bid . " AND high >= " . $high_bid . ") OR
			(low < " . $high_bid . " AND high < " . $high_bid . ")) ORDER BY increment DESC";
            $result_incr = $this->db->selectOne($query);
            if (sizeof($result_incr) != 0)
                $increment = $result_incr['increment'];
        }
        else {
            $increment = $customincrement;
        }
        if ($auction_type == 2) {
            $increment = 0;
        }

        if ($customincrement > 0) {
            $increment = $customincrement;
        }

        if ($num_bids == 0 || $auction_type == 2) {
            $next_bidp = $minimum_bid;
        } else {
            $next_bidp = $high_bid + $increment;
        }
        $bids['num_bids'] = $num_bids;
        $bids['customincrement'] = $customincrement;
        $bids['increment'] = $increment;
        $bids['next_bid'] = $this->input_money($next_bidp);
        return $bids;
    }

    public function Mybids($auction) {
        $user = Session::get('user');
        $bids = $this->db->select("SELECT * FROM " . BID_PREFIX . "bids b JOIN " . BID_PREFIX . "users u ON u.id=b.bidder WHERE auction=:id AND u.id=:user ORDER BY bid DESC, b.id DESC", array('id' => $auction['auction_id'], 'user' => $user['id']));
        return ($bids) ? true : false;
    }

    function get_increment($val, $input_check = true) {
        $query = "SELECT increment FROM " . BID_PREFIX . "increments 
			WHERE ((low <= " . $val . " AND high >= " . $val . ")
			OR (low < " . $val . " AND high < " . $val . ")) ORDER BY increment DESC";
        $res = $this->db->selectOne($query);
        return $res['increment'];
    }

    public function doBid() {
        $send_email = false;
        $usuario = Session::get('user');
        $id = $auction_id = $_POST['auction_id'];
        $bidder_id = $usuario['id'];
        $user = $usuario['id'];
        $bid = (isset($_POST['bid'])) ? $_POST['bid'] : 0;
        $NOW = time();
        $qty = (isset($_POST['qty'])) ? intval($_POST['qty']) : 1;
        $bidding_ended = false;
        $auction = $this->getAuction($auction_id);
        $bids = $this->getBids($auction);
        $high_bid = $bids[0]['bid'];
        $WINNING_BIDDER = $bids[0]['bidder'];
        $settings = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "settings");
        $next_bid = $bids['next_bid'];
        $increment = $bids['increment'];
        $current_bid = $auction['current_bid'];
        $customincrement = $bids['customincrement'];
        $message['error'] = '';
        $message['success'] = '';
        if ($settings['proxy_bidding'] == 'n') {
            /* // is it the highest bid?
              if ($current_bid < $bid) {
              // did you outbid someone?
              $query = "SELECT u.id FROM " . $DBPrefix . "bids b, " . $DBPrefix . "users u WHERE b.auction = " . $id . " AND b.bidder = u.id and u.suspended = 0 ORDER BY bid DESC";
              $result = mysql_query($query);
              $system->check_mysql($result, $query, __LINE__, __FILE__);
              if (mysql_num_rows($res) == 0 || mysql_result($res, 0) != $bidder_id) {
              $send_email = true;
              }
              $query = "UPDATE " . $DBPrefix . "auctions SET current_bid = " . $bid . ", num_bids = num_bids + 1 WHERE id = " . $id;
              $system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
              // Also update bids table
              $query = "INSERT INTO " . $DBPrefix . "bids VALUES (NULL, " . $id . ", " . $bidder_id . ", " . $bid . ", '" . $NOW . "', " . $qty . ")";
              $system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
              extend_auction($item_id, $c);
              $bidding_ended = true;
              } */
        } elseif ($WINNING_BIDDER == $bidder_id) {
            $query = "SELECT bid FROM " . BID_PREFIX . "proxybid p
					LEFT JOIN " . BID_PREFIX . "users u ON (p.userid = u.id)
					WHERE userid = " . $user . " AND itemid = " . $id . " ORDER BY bid DESC";
            $res = $this->db->selectOne($query);
            if (sizeof($res) > 0) {
                $WINNER_PROXYBID = $res['bid'];
                if ($WINNER_PROXYBID >= $bid) {
                    $errmsg = $this->lang["ya_eres_el_mayor"];
                } else {

                    $errmsg = $this->lang["has_superado_tupuja"];
                    // Just update proxy_bid
                    $query = "UPDATE " . BID_PREFIX . "proxybid SET bid = " . floatval($bid) . "
							  WHERE userid = " . $user . "
							  AND itemid = " . $id . " AND bid = " . $WINNER_PROXYBID;
                    $this->db->sqlControl($query);
                    $bidding_ended = true;
                }
            }
        }
        if (!$bidding_ended && !isset($errmsg) && $settings['proxy_bidding'] == 'y') {
            $query = "SELECT * FROM " . BID_PREFIX . "proxybid p, " . BID_PREFIX . "users u WHERE itemid = " . $id . " AND p.userid = u.id and u.suspended = 0 ORDER by bid DESC";
            $result = $this->db->select($query);

            if (sizeof($result) == 0) { // First bid
                $query = "INSERT INTO " . BID_PREFIX . "proxybid VALUES (" . intval($id) . "," . intval($bidder_id) . "," . floatval($bid) . ")";
                $this->db->sqlControl($query);
                // Only updates current bid if it is a new bidder, not the current one
                $query = "UPDATE " . BID_PREFIX . "auctions SET current_bid = " . floatval($next_bid) . ", num_bids = num_bids + 1 WHERE id = " . $id;
                $this->db->sqlControl($query);
                // Also update bids table
                $query = "INSERT INTO " . BID_PREFIX . "bids VALUES (NULL, " . $id . ", " . $bidder_id . ", " . floatval($next_bid) . ", '" . $NOW . "', " . $qty . ")";
                $this->db->sqlControl($query);
                $query = "UPDATE " . BID_PREFIX . "counters SET bids = (bids + 1)";
                $this->db->sqlControl($query);
            } else { // This is not the first bid
                $proxy_bidder_id = $result[0]['userid'];
                $proxy_max_bid = $result[0]['bid'];
                if ($proxy_max_bid < $bid) {
                    if ($proxy_bidder_id != $bidder_id) {
                        $send_email = true;
                    }
                    $next_bid = $proxy_max_bid + $increment;
                    if (($proxy_max_bid + $increment) > $bid) {
                        $next_bid = $bid;
                    }

                    $query = "INSERT INTO " . BID_PREFIX . "proxybid VALUES (" . $id . ", " . $bidder_id . ", " . floatval($bid) . ")";
                    $this->db->sqlControl($query);

                    $message['success'] = 'Felicidades, eres el mayor pujador';
                    // Fake bid to maintain a coherent history
                    if ($current_bid < $proxy_max_bid) {
                        $query = "INSERT INTO " . BID_PREFIX . "bids VALUES (NULL, " . $id . "," . $proxy_bidder_id . "," . floatval($proxy_max_bid) . ",'" . $NOW . "'," . $qty . ")";
                        $this->db->sqlControl($query);
                        $fakebids = 1;
                    } else {
                        $fakebids = 0;
                    }
                    // Update bids table
                    $query = "INSERT INTO " . BID_PREFIX . "bids VALUES (NULL, " . $id . ", " . $bidder_id . ", " . floatval($next_bid) . ", '" . $NOW . "', " . $qty . ")";
                    $this->db->sqlControl($query);
                    $query = "UPDATE " . BID_PREFIX . "counters SET bids = (bids + (1 + " . $fakebids . "))";
                    $this->db->sqlControl($query);
                    $query = "UPDATE " . BID_PREFIX . "auctions SET current_bid = " . $next_bid . ", num_bids = (num_bids + 1 + " . $fakebids . ") WHERE id = " . $id;
                    $this->db->sqlControl($query);
                }
                if ($proxy_max_bid == $bid) {
                    $cbid = $proxy_max_bid;
                    $errmsg = $this->lang["no_eres_el_mayor"];
                    // Update bids table
                    $query = "INSERT INTO " . BID_PREFIX . "bids VALUES (NULL, " . $id . ", " . $bidder_id . ", " . floatval($bid) . ", '" . $NOW . "', " . $qty . ")";
                    $this->db->sqlControl($query);
                    $query = "INSERT INTO " . BID_PREFIX . "bids VALUES (NULL, " . $id . ", " . $proxy_bidder_id . ", " . floatval($cbid) . ", '" . $NOW . "', " . $qty . ")";
                    $this->db->sqlControl($query);
                    $query = "UPDATE " . BID_PREFIX . "counters SET bids = (bids + 2)";
                    $this->db->sqlControl($query);
                    $query = "UPDATE " . BID_PREFIX . "auctions SET current_bid = " . floatval($cbid) . ", num_bids = num_bids + 2 WHERE id = " . $id;
                    $this->db->sqlControl($query);
                    if ($customincrement == 0) {
                        // get new increment
                        $increment = $this->get_increment($cbid);
                    } else {
                        $increment = $customincrement;
                    }
                    $next_bid = $cbid + $increment;
                }
                if ($proxy_max_bid > $bid) {
                    // Update bids table
                    $query = "INSERT INTO " . BID_PREFIX . "bids VALUES (NULL, " . $id . ", " . $bidder_id . ", " . floatval($bid) . ", '" . $NOW . "', " . $qty . ")";
                    $this->db->sqlControl($query);
                    if ($customincrement == 0) {
                        // get new increment
                        $increment = $this->get_increment($bid);
                    } else {
                        $increment = $customincrement;
                    }
                    if ($bid + $increment - $proxy_max_bid >= 0) {
                        $cbid = $proxy_max_bid;
                    } else {
                        $cbid = $bid + $increment;
                    }
                    $errmsg = $this->lang["no_eres_el_mayor"];
                    // Update bids table
                    $query = "INSERT INTO " . BID_PREFIX . "bids VALUES (NULL, " . $id . ", " . $proxy_bidder_id . ", " . floatval($cbid) . ", '" . $NOW . "', " . $qty . ")";
                    $this->db->sqlControl($query);
                    $query = "UPDATE " . BID_PREFIX . "counters SET bids = (bids + 2)";
                    $this->db->sqlControl($query);
                    $query = "UPDATE " . BID_PREFIX . "auctions SET current_bid = " . floatval($cbid) . ", num_bids = num_bids + 2 WHERE id = " . $id;
                    $this->db->sqlControl($query);
                    if ($customincrement == 0) {
                        // get new increment
                        $increment = $this->get_increment($cbid);
                    } else {
                        $increment = $customincrement;
                    }
                    $next_bid = $cbid + $increment;
                }
            }
        }
        Log::set('Bid on Item: ' . $id . ' by: ' . $bidder_id);
        if ($send_email) {
            $auction = $this->getAuction($auction_id);
            $auction['maxbid'] = $proxy_max_bid;
            $mail = new MailHelper();
            $mail->sendRebid($this->getUser($proxy_bidder_id), $auction);
        }
        $message['error'] = $errmsg;
        return $message;
    }

    public function getFavorites($auction_id, $user_id) {
        $exist = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'favorites WHERE auction_id=:auction_id AND user_id=:user_id', array('auction_id' => $auction_id, 'user_id' => $user_id));
        if ($exist) {
            $this->db->delete(BID_PREFIX . 'favorites', "`auction_id` = {$auction_id} AND `user_id` = {$user_id}");
            $exit[] = 2;
        } else {
            $data = array(
                'user_id' => $user_id,
                'auction_id' => $auction_id,
                'created_at' => $this->getTimeSQL()
            );
            $id = $this->db->insert(BID_PREFIX . 'favorites', $data);
            if ($id != 0)
                $exit[] = 1;
            else
                $exit[] = 0;
        }
        echo json_encode($exit);
    }

    public function getSearch($term, $lang = LANG) {
        $bid = $this->db->select("SELECT * FROM " . BID_PREFIX . "auctions a JOIN photos p ON p.id=a.photo_id JOIN " . BID_PREFIX . "auctions_description ad on ad.auction_id=a.id WHERE ad.name LIKE '%" . $term . "%' and ad.language_id=:lang", array('lang' => $lang));
        foreach ($bid as $key => $value) {
            $max = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "proxybid WHERE itemid=:itemid ORDER BY bid DESC", array('itemid' => $value['auction_id']));
            $bid[$key]['max_bidder'] = $max['userid'];
        };
        return $bid;
    }

    public function saveCard() {
        $data = array(
            'name' => $_POST['card_name'],
            'holder' => $_POST['cardholder'],
            'month' => $_POST['month'],
            'year' => $_POST['year'],
            'cvv' => $_POST['cvv'],
            'number' => $_POST['cardnumber'],
            'type' => $_POST['cardtype'],
            'user_id' => $_POST['user_id'],
            'date_created' => $this->getTimeSQL(),
        );
        $saved = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "cards WHERE name =:name and user_id=:id", array('name' => $_POST['card_name'], 'id' => $_POST['user_id']));
        if ($saved)
            $result = $this->db->update(BID_PREFIX . 'cards', $data, "`id` = '{$saved['id']}'");
        else
            $result = $this->db->insert(BID_PREFIX . 'cards', $data);
        if (!$result)
            throw new Exception($this->lang['no_auction_found']);
        return $result;
    }

}
