<?php

class Models_Model extends Model {

    public 
            $_orden = 'name', 
            $_where,
            $_selection,
            $_alphabetic,
            $_sectionClass,
            $_flipbook;

    public function __construct() {
        parent::__construct();
    }

    public function getModels() {
        if($this->_selection){
            switch ($this->_selection){
                case 'featured':
                    $this->_where.=' AND m.featured=1 ';
                    break;
                default :
                    $letters=  explode('-', $this->_selection);
                    if($letters[1]!='Z')$letters[1]++;
                    $this->_where.=' AND (m.name BETWEEN "'.$letters[0].'%" AND "'.$letters[1].'%" ';
                    if($letters[1]=='Z')$this->_where.=' OR m.name like "Z%"';
                    $this->_where.=')';
            }
        }else{
            if($this->_alphabetic)$this->_where.=' AND m.name BETWEEN "a%" AND "d%" ';
        }
        $this->_where.=' AND mp.main=1 and m.show_in_headsheet=1 AND m.active=1 ';
        return $this->db->select('SELECT * FROM models m JOIN models_photos mp on(m.id=mp.model_id) join photos p on(mp.photo_id=p.id) ' . $this->_where . ' ORDER by ' . $this->_orden);
    }

    public function getModelsSearch() {
        $this->_where.=' AND active=1 ';
        $models = $this->db->select('SELECT * FROM models '.$this->_where.' ORDER by ' . $this->_orden);
        $modelSearch = array();
        foreach ($models as $key => $model) {
            $modelSearch[] =
                    array(
                        'value' => URL.LANG.'/gallery/model/' . $model['id'] . '-' . $model['name'],
                        'label' => $model['name'],
            );
        }
        return $modelSearch;
    }
    public function getModelThumb($id) {
       $photo=$this->db->select('SELECT * FROM models_photos a jOIN photos b ON (b.id=a.photo_id) WHERE a.model_id=:id and main=1;', array('id' => $id));
       $photo=$photo[0];
       $id=str_pad($photo['photo_id'], 9, "0", STR_PAD_LEFT);
       $folder=str_split($id,3);
       foreach($folder as $value){
           $photo['rute'].=$value.'/';
       }
       $photo['rute'].='original/';
       return $photo;
    }

}