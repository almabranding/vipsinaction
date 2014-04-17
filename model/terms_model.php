<?php

class Terms_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function getTerms($name = 'terms', $lang = LANG) {
        return $this->db->selectOne("SELECT * FROM " . DB_PREFIX . "pages p JOIN " . DB_PREFIX . "pages_description pd ON pd.page_id=p.id WHERE pd.name LIKE :name AND pd.language_id=:lang", array('name' => $name, 'lang' => $lang));
    }

}
