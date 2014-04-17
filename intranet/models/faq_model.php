<?php

class Faq_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function formFaq($id = null) {
        $action = ($id == null) ? URL . 'faq/add/' : URL . 'faq/edit/' . $id . '/';
        if ($id != null)
            $value = $this->getFaq($id);
        $form = new Zebra_Form('faq', 'POST', $action);

        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $value['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
                ), true);

        foreach ($this->_langs as $lng) {
            if ($id != null)
                $element = $this->getFaq($id, $lng);
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

    public function getFaq($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select('SELECT * FROM faq s JOIN faq_description sd ON sd.faq_id=s.id WHERE sd.language_id=:lang ORDER by position', array('lang' => $lang));
        else
            return $this->db->selectOne('SELECT * FROM faq s JOIN faq_description sd ON sd.faq_id=s.id WHERE s.id=:id AND sd.language_id=:lang', array('id' => $id, 'lang' => $lang));
    }

    public function toTable($lista) {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Name",
                "width" => "10%"
            ), array(
                "title" => "Info",
                "width" => "60%"
            ), array(
                "title  " => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $b['values'][] = array(
                "Name" => $value['name'],
                "Info" => htmlentities(substr($value['content'], 0, 150)),
                "Options" => '<a href="' . URL . LANG . '/faq/view/' . $value['faq_id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this faq?\',\'faq/delete/' . $value['faq_id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function add() {
        $data = array(
            'visibility' => $_POST['visibility'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        $id = $this->db->insert('faq', $data);
        unset($data);
        $data['faq_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $this->db->insert('faq_description', $data);
        }
        return $id;
    }

    public function edit($id) {
        $data = array(
            'url' => $_POST['url'],
            'visibility' => $_POST['visibility'],
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('banners', $data, "`id` = '{$id}'");
        unset($data);
        $data['faq_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $exist = $this->db->select("SELECT * FROM faq_description WHERE faq_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('faq_description', $data, "`faq_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('faq_description', $data);
        }
    }

    public function delete($id) {
        $this->db->delete('faq', "`id` = {$id}");
        $this->db->delete('faq_description', "`faq_id` = {$id}");
    }

    public function sort() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('faq', $data, "`id` = '{$value}'");
        }
        exit;
    }

}
