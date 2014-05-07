<?php

class Colaboradores_Model extends Model {

    public $arrAvailableRooms, $params;

    public function __construct() {
        parent::__construct();
    }
    public function getDonantesById($id = null, $lang = LANG) {
        $donantes = $this->db->select("SELECT * FROM " . DB_PREFIX . "donantes d JOIN " . DB_PREFIX . "donantes_description dd ON dd.donantes_id=d.id JOIN " . DB_PREFIX . "photos p ON p.id=d.photo_id WHERE dd.language_id=:lang AND d.id=:id", array('id' => $id, 'lang' => $lang));
        switch ($donantes[0]['type']) {
            case 1: $type = $this->lang['donantes'];
                break;
            case 2: $type=$this->lang['empresas'];
                break;
            case 3: $type=$this->lang['ong'];
                break;
        }
        $donantes[0]['type_name'] = $type;
        return $donantes;
    }
    public function getDonantesByName($name = null, $lang = LANG) {
        $type=$this->getDonantesType($name);
        $donantes = $this->db->select("SELECT * FROM " . DB_PREFIX . "donantes d JOIN " . DB_PREFIX . "donantes_description dd ON dd.donantes_id=d.id JOIN " . DB_PREFIX . "photos p ON p.id=d.photo_id WHERE dd.language_id=:lang AND d.type=:type", array('type' => $type, 'lang' => $lang));
        foreach ($donantes as $key => $donante) {
            $auction = $this->db->selectOne("SELECT SUM(current_bid) as current_bid FROM " . BID_PREFIX . "auctions WHERE donated=:donante OR `for`=:donante", array('donante' => $donante['donantes_id']));
            $donantes[$key]['current_bid'] = ($auction['current_bid']) ? $auction['current_bid'] : 0;
        }
        return $donantes;
    }
    public function getDonantesAuction($id,$lang=LANG) {
        $bid = $this->db->select("SELECT * FROM " . BID_PREFIX . "auctions a  JOIN photos p ON p.id=a.photo_id JOIN " . BID_PREFIX . "auctions_description ad on ad.auction_id=a.id  WHERE (a.donated=:id OR a.for=:id) and ad.language_id=:lang", array('id' => $id, 'lang' => $lang));
        foreach ($bid as $key => $value) {
            $max = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "proxybid WHERE itemid=:itemid ORDER BY bid DESC", array('itemid' => $value['auction_id']));
            $bid[$key]['max_bidder'] = $max['userid'];
        }
        return $bid;
    }
    public function getDonantesType($name){
        switch ($name) {
            case $this->lang['donantes']: $type = 1;
                break;
            case $this->lang['empresas']: $type = 2;
                break;
            case $this->lang['ong']: $type = 3;
                break;
        }
        return $type;
    }
}
