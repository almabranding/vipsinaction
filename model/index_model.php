<?php

class Index_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function getAuctions($id = null, $lang = LANG) {
        $time=time();
        if ($id == null){
              $futuras=$this->db->select('SELECT *,p2.img_date as featured_img_date,p2.file_name as featured_file_name,p.img_date as img_date,p.file_name as file_name FROM ' . BID_PREFIX . 'auctions a JOIN ' . BID_PREFIX . 'auctions_description b ON b.auction_id=a.id JOIN photos p ON p.id=a.photo_id JOIN photos p2 ON p2.id=a.featured_id WHERE b.language_id=:lang AND a.featured="y" and a.visibility="public" AND ends>'.$time.'  AND starts<'.$time.' ORDER by  ends ASC', array('lang'=>$lang));
              $pasadas=$this->db->select('SELECT *,p2.img_date as featured_img_date,p2.file_name as featured_file_name,p.img_date as img_date,p.file_name as file_name FROM ' . BID_PREFIX . 'auctions a JOIN ' . BID_PREFIX . 'auctions_description b ON b.auction_id=a.id JOIN photos p ON p.id=a.photo_id JOIN photos p2 ON p2.id=a.featured_id WHERE b.language_id=:lang AND a.featured="y" and a.visibility="public" AND ends<'.$time.' AND starts<'.$time.'  ORDER by ends ASC', array('lang'=>$lang));
              return array_merge($futuras,$pasadas);
        }
        else
            return $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'auctions a JOIN ' . BID_PREFIX . 'auctions_description b ON b.auction_id=a.id WHERE a.id=:id AND b.language_id=:lang', array('id' => $id,'lang'=>$lang));
    }
    public function getBanner($lang = LANG) {
       return $this->db->select('SELECT * FROM banners s JOIN banners_description sd ON sd.banner_id=s.id JOIN photos p ON s.photo_id=p.id WHERE sd.language_id=:lang AND s.visibility="public" ORDER by position LIMIT 0,4', array('lang' => $lang));

    }
    

}