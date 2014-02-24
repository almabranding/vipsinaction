<?php

class Menu extends Model
{   
    public function __construct() 
    {
        parent::__construct();
    }
    public function getMenu($lang=LANG){
        return $this->db->select("SELECT md.url as url, md.name FROM menus m JOIN menus_description md ON md.menu_id=m.id WHERE language_id='".$lang."' ORDER by position");
    }
}