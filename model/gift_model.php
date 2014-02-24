<?php

class Gift_Model extends Model {

    public $arrAvailableRooms, $params;

    public function __construct() {
        parent::__construct();
    }

    public function giftForm() {
        $action = URL . 'booking/giftconfirmation';
        $numChild[0] = "0";
        for ($i = 1; $i <= 14; $i++) {
            $numPeople[$i] = $i;
            $numChild[$i] = $i;
        }
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('giftForm', 'POST', $action, $atributes);

        $form->add('label', 'label_first_name', 'first_name', $this->lang['firstname'].':');
        $form->add('text', 'first_name', '', array('placeholder' => $this->lang['Firstname of the booker']));
        $form->add('label', 'label_last_name', 'last_name', $this->lang['lastname'].':');
        $form->add('text', 'last_name', '', array('placeholder' => $this->lang['Lastname of the booker']));
        $form->add('label', 'label_email', 'email', $this->lang['email'].':');
        $form->add('text', 'email', '', array('placeholder' => $this->lang['Contact e-mail']));
        $form->add('label', 'label_message', 'message', $this->lang['Whant to write a message with your gift']);
        $form->add('text', 'message', '', array('placeholder' => $this->lang['Write your message here']));
        $form->add('submit', '_btnsubmit', $this->lang['buy now']);
        if ($form->validate()) {
            
        }
        return $form;
    }

    public function getGiftList($idgift=null,$lang = LANG) {
        if($idgift==null)return $this->db->select("SELECT * FROM gift_group g JOIN gift_group_description gd ON gd.gift_id=g.id WHERE gd.language_id=:lang", array('lang' => $lang));
        else return $this->db->selectOne("SELECT * FROM gift_group g JOIN gift_group_description gd ON gd.gift_id=g.id WHERE gd.gift_id=:id AND gd.language_id=:lang", array('id' => $id,'lang' => $lang));
    }

    public function getGifProducts($type = 'all', $lang = LANG) {
        $WHERE = 'WHERE gd.language_id="' . $lang . '" ';
        $WHERE.='AND ggd.language_id="' . $lang . '" ';
        $WHERE.=($type != 'all') ? ' AND ggd.name="' . $type . '"' : '';
        $pructs=$this->db->select("SELECT *,ggd.name as gname FROM gift g JOIN gift_group gg ON gg.id=g.group JOIN gift_group_description ggd ON ggd.gift_id=gg.id JOIN gift_description gd ON gd.gift_id=g.id " . $WHERE);
        foreach($pructs as $key=>$product){
            $gallery=$this->db->select("SELECT * FROM gift_photos gp JOIN photos p ON p.id=gp.photo_id WHERE gp.gift_id=:id",array('id'=>$product['gift_id']));
            $return[$key]=$product;
            $return[$key]['gallery']=$gallery;
        }
        return $return;
    }
    public function getGiftInfo($id = null, $lang = LANG) {
        $WHERE = 'WHERE gd.language_id="' . $lang . '" ';
        $WHERE.='AND ggd.language_id="' . $lang . '" ';
        $WHERE.=($id != 'all') ? ' AND g.id="' . $id . '"' : '';
        $pructs=$this->db->selectOne("SELECT *,ggd.name as ggname,gd.name as gname FROM gift g JOIN gift_group gg ON gg.id=g.group JOIN gift_group_description ggd ON ggd.gift_id=gg.id JOIN gift_description gd ON gd.gift_id=g.id " . $WHERE);
        $result = array(
            'id' => $pructs['gift_id'],
            'name' => $pructs['gname'],
            'places' => $pructs['places'],
            'description' => $pructs['description'],
            'author_picture' => $pructs['author_picture'],
            'author_name' => $pructs['author_name'],
            'map_code' => $pructs['map_code'],
            'policies' => $pructs['policies'],
        );
        $gallery=$this->db->select("SELECT * FROM gift_photos gp JOIN photos p ON p.id=gp.photo_id WHERE gp.gift_id=:id",array('id'=>$pructs['gift_id']));
        foreach($gallery as $key=>$img){
            $result['gallery'][$key+1]=UPLOAD.Model::getRouteImg($img['created_at']).$img['file_name'];
        }
        return $result;
    }
    
    public function getGiftRooms($id){
        $sql = 'SELECT  r.id as room_id,r.room_type as room_type,h.id as hotel_id  
                FROM  gift g
                INNER JOIN ' . DB_PREFIX . 'rooms r ON (r.id = g.accommodation OR r.id = g.experience)
                INNER JOIN ' . DB_PREFIX . 'hotels h ON h.id = r.hotel_id
                    INNER JOIN ' . DB_PREFIX . 'rooms_description rd ON rd.id = r.id
                        INNER JOIN ' . DB_PREFIX . 'hotels_description hd ON hd.id = h.id
                WHERE g.id = '.$id;	
        return $this->db->select($sql);
    }
   /* public function getGifProducts($type = 'all', $lang = LANG) {
        $WHERE = 'WHERE gd.language_id="' . $lang . '" ';
        $WHERE.='AND rd.language_id="' . $lang . '" ';
        $WHERE.='AND hd.language_id="' . $lang . '" ';
        $WHERE.='AND ggd.language_id="' . $lang . '" ';
        $WHERE.=($type != 'all') ? ' AND ggd.name="' . $type . '"' : '';
        return $this->db->select("SELECT *,rd.room_type as rname,hd.name as hname,gd.name as gname FROM " . DB_PREFIX . "rooms r JOIN gift g ON r.gift=g.id JOIN gift_group gg ON gg.id=g.group  JOIN gift_group_description ggd ON ggd.gift_id=gg.id JOIN gift_description gd ON gd.gift_id=g.id JOIN " . DB_PREFIX . "hotels h ON h.id=r.hotel_id JOIN " . DB_PREFIX . "rooms_description rd ON rd.room_id=r.id JOIN " . DB_PREFIX . "hotels_description hd ON hd.hotel_id=h.id " . $WHERE);
    }*/

}
