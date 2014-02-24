<?php

class Suggestions_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function formGroup($type, $id) {
        $action = ($type == 'add') ? URL . LANG . '/suggestions/addG' : URL . LANG . '/suggestions/editG/' . $id;
        if ($type == 'edit')
            $value = $this->getGroupInfo($id);
        $form = new Zebra_Form('addProject', 'POST', $action);
        if ($type != 'header') {

            $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
            $obj = $form->add('select', 'visibility', '');
            $obj->add_options(array(
                'public' => 'Public',
                'private' => 'Private',
                    ), $value['visibility']);
        }
        $form->add('label', 'label_type', 'type', 'Type:');
        $obj = $form->add('select', 'type', $header['type'], array('autocomplete' => 'off'));
        $obj->add_options(array(
            "experience" => "Experience",
            "accommodation" => "Accommodation",
                ), true);

        foreach ($this->_langs as $lng) {
            if ($type == 'edit')
                $value = $this->getGroupInfo($id, $lng);
            $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Name ' . $lng);
            $obj = $form->add('text', 'name_' . $lng, $value['name'], array('autocomplete' => 'off'));
            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, $value['content'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function formImage($type = 'add', $id = null, $group) {
        $action = ($type == 'add') ? URL . LANG . '/suggestions/add/' . $group : URL . LANG . '/suggestions/edit/' . $id . '/' . $group;
        if ($type == 'edit')
            $value = $this->getImageInfo($id);
        $form = new Zebra_Form('addProject', 'POST', $action);

        $obj = $form->add('hidden', 'type', $header['type']);
        $obj = $form->add('hidden', 'header', 0);
        $form->add('label', 'label_url', 'url', 'URL ');
        $obj = $form->add('text', 'url', $value['url'], array('autocomplete' => 'off'));

        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', '');
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
                ), $value['visibility']);

        foreach ($this->_langs as $lng) {
            if ($type == 'edit')
                $value = $this->getImageInfo($id, $lng);
            $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Name ' . $lng);
            $obj = $form->add('text', 'name_' . $lng, $value['name'], array('autocomplete' => 'off'));
            $obj = $form->add('label', 'label_content_' . $lng, 'content_' . $lng, 'Content ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'content_' . $lng, $value['content'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }
        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getGroupInfo($group, $lang = 'en') {
        return $this->db->selectOne('SELECT *,s.*,s.id as id FROM suggestions_groups s JOIN suggestions_groups_description sd ON sd.suggestions_group_id=s.id WHERE s.id=:group  AND sd.language_id=:lang ORDER by position', array('group' => $group, 'lang' => $lang));
    }

    public function getSuggestionsGroupsList($lang = 'en') {
        return $this->db->select('SELECT * FROM suggestions_groups s JOIN suggestions_groups_description sd ON sd.suggestions_group_id=s.id WHERE sd.language_id=:lang ORDER BY position', array('lang' => $lang));
    }

    public function getSuggestionsList($lang = 'en') {
        return $this->db->select('SELECT * FROM suggestions s JOIN suggestions_description sd ON sd.suggestion_id=s.id WHERE s.header=1 AND sd.language_id=:lang ORDER BY position', array('lang' => $lang));
    }

    public function getSuggestionsByGroup($group, $lang = 'en') {
        return $this->db->select('SELECT *,p.created_at as imgdate,s.id as sugid,p.* FROM suggestions s JOIN suggestions_description sd ON sd.suggestion_id=s.id JOIN photos p ON s.photo_id=p.id WHERE s.group=:group  AND sd.language_id=:lang  AND header=0 ORDER by position', array('group' => $group, 'lang' => $lang));
    }

    public function getImageInfo($id, $lang = 'en') {
        return $this->db->selectOne('SELECT *,p.created_at as imgdate,p.* FROM suggestions s JOIN suggestions_description sd ON sd.suggestion_id=s.id JOIN photos p ON s.photo_id=p.id WHERE s.id=:id  AND sd.language_id=:lang  AND header=0 ORDER by position', array('id' => $id, 'lang' => $lang));
    }

    public function toTable($lista) {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Suggestion",
                "width" => "60%"
            ), array(
                "title" => "Template",
                "width" => "10%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $b['values'][] = array(
                "Section" => $value['name'],
                "Template" => $value['type'],
                "Options" => '<a href="' . URL . LANG . '/suggestions/view/' . $value['id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this page?\',\'suggestions/deleteAll/' . $value['id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function add($group = null, $img = null) {
        $group = $this->getGroupInfo($group);
        $data = array(
            'group' => $group['id'],
            'type' => $group['type'],
            'photo_id' => $img['id'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        $suggestion_id = $this->db->insert('suggestions', $data);
        unset($data);
        foreach ($this->_langs as $lng) {
            $data = array(
                'suggestion_id' => $suggestion_id,
                'language_id' => $lng,
            );
            $this->db->insert('suggestions_description', $data);
        }
        return $group;
    }

    public function edit($id) {
        $data = array(
            'visibility' => $_POST['visibility'],
            'updated_at' => $this->getTimeSQL(),
        );
        $suggestion_id = $this->db->update('suggestions', $data, "`id` = {$id}");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data = array(
                'content' => $_POST['content_' . $lng],
                'name' => $_POST['name_' . $lng],
                'url' => $_POST['url']
            );
            $exist = $this->db->select("SELECT * FROM suggestions_description WHERE suggestion_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('suggestions_description', $data, "`suggestion_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('suggestions_description', $data);
        }
        return $suggestion_id;
    }

    public function addG() {
        $data = array(
            'type' => $_POST['type'],
            'visibility' => $_POST['visibility'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        $suggestion_id = $this->db->insert('suggestions_groups', $data);
        unset($data);
        foreach ($this->_langs as $lng) {
            $data = array(
                'name' => $_POST['name_' . $lng],
                'content' => $_POST['content_' . $lng],
                'suggestions_group_id' => $suggestion_id,
                'language_id' => $lng,
            );
            $this->db->insert('suggestions_groups_description', $data);
        }
        return $group;
    }

    public function editG($id) {
        $data = array(
            'type' => $_POST['type'],
            'visibility' => $_POST['visibility'],
            'updated_at' => $this->getTimeSQL(),
        );
        $suggestion_id = $this->db->update('suggestions_groups', $data, "`id` = {$id}");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data = array(
                'content' => $_POST['content_' . $lng],
                'name' => $_POST['name_' . $lng],
                'language_id' => $lng,
                'suggestions_group_id' => $id,
            );
            $exist = $this->db->select("SELECT * FROM suggestions_groups_description WHERE suggestions_group_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('suggestions_groups_description', $data, "`suggestions_group_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('suggestions_groups_description', $data);
        }
        return $suggestion_id;
    }

    public function delete($id) {
        $this->db->delete('suggestions', "`id` = {$id}");
        $this->db->delete('suggestions_description', "`suggestion_id` = {$id}");
        //$modelo = $this->getModel($id);
        //Logs::set("Ha borrado el modelo " . $id . " " . $modelo[0]['name']);
    }

    public function deleteAll($group) {
        $sug = $this->db->select('SELECT * FROM suggestions s WHERE s.group=:group', array('group' => $group));
        foreach ($sug as $single)
            $this->db->delete('suggestions_description', "`suggestion_id` = {$single['id']}");
        $this->db->delete('suggestions', "`group` = {$group}");

        //$modelo = $this->getModel($id);
        //Logs::set("Ha borrado el modelo " . $id . " " . $modelo[0]['name']);
    }

    public function sort() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('suggestions', $data, "`id` = '{$value}'");
        }
        exit;
    }

    public function sortGroups() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('suggestions', $data, "`group` = '{$value}' AND `header` = '1'");
        }
        exit;
    }

}
