<?php

class Faq_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function getFAQ($lang = LANG) {
            return $this->db->select("SELECT * FROM faq a JOIN faq_description dd on dd.faq_id=a.id WHERE language_id=:lang ORDER by a.position", array('lang' => $lang));
        
    }

}
