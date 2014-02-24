<?php

class Index_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function getAuctions($lang = LANG){
        foreach($this->getSections() as $section){
            $sectionsImg[$section['id']]=$this->getImageById($section['photo_id']);
        }
        return $sectionsImg;
    }
    public function getBanner($lang = LANG) {
        foreach($this->getSections() as $section){
            $description[$section['id']]=$this->db->selectOne("SELECT * FROM home_sections_description WHERE home_sections_id=" . $section['id'] . ' AND language_id="' . $lang . '"');
        }
        return $description;
    }
    

}