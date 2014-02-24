<?php

class Gift_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function typeForm($id = 'null') {
        $action = ($id == null) ? URL . LANG . '/gift/createType' : URL . LANG . '/gift/editType/' . $id;

        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('addType', 'POST', $action, $atributes);
        $element = $this->getType($id);
        $obj = $form->add('label', 'label_color', 'color', 'Color:');
        $obj = $form->add('text', 'color', ($element['color']) ? $element['color'] : '#000000', array('autocomplete' => 'off', 'required' => array('error', 'Color is required!')));
        $obj = $form->add('label', 'label_price', 'price', 'Price:');
        $obj = $form->add('text', 'price', $element['price'], array('autocomplete' => 'off', 'required' => array('error', 'Color is required!')));

        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $element['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
        ));
        
        foreach ($this->_langs as $lng) {
            if ($id != null)
                $element = $this->getType($id, $lng);
            $obj = $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Page name ' . $lng . ':');
            $obj = $form->add('text', 'name_' . $lng, $element['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));

            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, $element['content'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function giftForm($id = 'null') {
        $action = ($id == null) ? URL . LANG . '/gift/create' : URL . LANG . '/gift/edit/' . $id;

        $atributes = array(
            'enctype' => 'multipart/form-data',
        );

        $form = new Zebra_Form('addProject', 'POST', $action, $atributes);
        $element = $this->getGift($id);
        
        $form->add('label', 'label_accommodation', 'accommodation', 'Accommodation:');
        $obj = $form->add('select', 'accommodation', $element['accommodation']);
        foreach ( $this->getProducts('0') as $product){
            $options[$product['room_id']]=$product['name'].' - '.$product['room_type'];
        }
        $obj->add_options($options);
        
        unset($options);
        $form->add('label', 'label_experience', 'experience', 'Experience:');
        $obj = $form->add('select', 'experience', $element['experience']);
        foreach ($this->getProducts('1') as $product){
            $options[$product['room_id']]=$product['name'].' - '.$product['room_type'];
        }
        $obj->add_options($options);
        unset($options);
        
        unset($options);
        $form->add('label', 'label_group', 'group', 'Type:');
        $obj = $form->add('select', 'group', $element['group']);
        foreach ($this->getType() as $type){
            $options[$type['id']]=$type['name'];
        }
        $obj->add_options($options,true);
        unset($options);
        
        $form->add('label', 'label_places', 'places', 'Places:');
        $obj = $form->add('select', 'places', $element['places']);
        for ($i=1;$i<15;$i++){
            $options[$i]=$i;
        }
        $obj->add_options($options,true);
        
        $form->add('label', 'label_days', 'days', 'Days:');
        $obj = $form->add('select', 'days', $element['days']);
        $obj->add_options($options,true);
        
        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $element['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
        ),true);
        foreach ($this->_langs as $lng) {
            if ($id != null)
                $element = $this->getGift($id, $lng);
            $obj = $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Page name ' . $lng . ':');

            $obj = $form->add('text', 'name_' . $lng, $element['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));

            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, $element['content'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function sortType() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('pages', $data, "`photo_id` = '{$value}' AND `gift_id` = '{$_POST['id']}'");
        }
        exit;
    }

    public function createType() {
        $data = array(
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL(),
            'visibility' => $_POST['visibility'],
            'price' => $_POST['price']
        );
        $id = $this->db->insert('gift_group', $data);
        unset($data);
        $data['gift_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $this->db->insert('gift_group_description', $data);
        }
        return $id;
    }

    public function editType($id) {
        $data = array(
            'updated_at' => $this->getTimeSQL(),
            'visibility' => $_POST['visibility'],
            'price' => $_POST['price']
        );
        $this->db->update('gift_group', $data, "`id` = '{$id}'");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data['gift_id'] = $id;
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $exist = $this->db->select("SELECT * FROM gift_group_description WHERE gift_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('gift_group_description', $data, "`gift_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('gift_group_description', $data);
        }
    }

    public function deleteType($id) {
        $this->db->delete('gift_group', "`id` = {$id}");
        $this->db->delete('gift_group_description', "`gift_id` = {$id}");
    }

    public function getType($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select("SELECT *,g.id as id FROM gift_group g JOIN gift_group_description gd on gd.gift_id=g.id WHERE  language_id=:lang", array('lang' => $lang));
        else
            return $this->db->selectOne("SELECT *,g.id as id FROM gift_group g JOIN gift_group_description gd on gd.gift_id=g.id WHERE g.id=:id AND language_id=:lang", array('id' => $id, 'lang' => $lang));
    }

    public function getGift($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select("SELECT *,g.id as id FROM gift g JOIN gift_description gd on gd.gift_id=g.id WHERE language_id=:lang", array('lang' => $lang));
        else
            return $this->db->selectOne("SELECT *,g.id as id FROM gift g JOIN gift_description gd on gd.gift_id=g.id WHERE g.id=:id AND language_id=:lang", array('id' => $id, 'lang' => $lang));
    }
    public function getGallery($id = null, $lang = LANG) {
            return $this->db->select("SELECT *,p.created_at as img FROM gift_photos g JOIN photos p on g.photo_id=p.id WHERE g.gift_id=:id", array('id' => $id));
    }
    public function addImage($group = null, $img = null) {
        $data = array(
            'gift_id' => $group,
            'photo_id' => $img['id'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        return $this->db->insert('gift_photos', $data);
    }
    public function deleteImage($id) {
        $this->db->delete('gift_photos', "`id` = {$id}");
    }
    public function toTable($lista,$type='') {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Name",
                "width" => "60%"
            ),array(
                "title" => "Info",
                "width" => "60%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            if($type!=''){
                $grupo=$this->getType($value['id']);
                $info=$grupo['price'];
            }
            else{
                $grupo=$this->getType($value['group']);
                $info=$grupo['name'];
            }
            $b['values'][] = array(
                "Name" => $value['name'],
                "Info" => $info,
                "Options" => '<a href="' . URL . LANG . '/gift/view'.$type.'/' . $value['id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this page?\',\'gift/delete'.$type.'/' . $value['id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function create() {
        $data = array( 
            'accommodation' => $_POST['accommodation'],
            'experience' => $_POST['experience'],
            'visibility' => $_POST['visibility'],
            'places' => $_POST['places'],
            'days' => $_POST['days'],
            'group' => $_POST['group'],
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        $id = $this->db->insert('gift', $data);
        unset($data);
        $data['gift_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $this->db->insert('gift_description', $data);
        }
        return $id;
    }

    public function edit($id) {
        $data = array(
            'accommodation' => $_POST['accommodation'],
            'experience' => $_POST['experience'],
            'visibility' => $_POST['visibility'],
            'places' => $_POST['places'],
            'days' => $_POST['days'],
            'group' => $_POST['group'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('gift', $data, "`id` = '{$id}'");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data['page_id'] = $id;
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $exist = $this->db->select("SELECT * FROM gift_description WHERE gift_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('gift_description', $data, "`gift_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('gift_description', $data);
        }
    }

    public function delete($id) {
        $this->db->delete('gift', "`id` = {$id}");
        $this->db->delete('gift_description', "`gift_id` = {$id}");
    }

    public function getProducts($type, $lang = LANG) {
        $where = 'WHERE 1=1 AND ';
        if ($type != null)
            $where.='h.type=' . (int) $type.' AND ';
        return $this->db->select("SELECT * FROM " . DB_PREFIX . "rooms r JOIN " . DB_PREFIX . "hotels h ON r.hotel_id=h.id JOIN " . DB_PREFIX . "rooms_description rd ON rd.room_id=r.id JOIN " . DB_PREFIX . "hotels_description hd ON hd.hotel_id=h.id " . $where . " rd.`language_id`=:lang AND hd.`language_id`=:lang ORDER BY hd.name", array('lang' => $lang));
    }

}
