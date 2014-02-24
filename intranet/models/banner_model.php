<?php

class Banner_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function formImage($type = 'add', $id = null, $group) {
        $action = ($type == 'add') ? URL . LANG . '/banner/add/' . $group : URL . LANG . '/banner/edit/' . $id . '/' . $group;
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

    public function formGroup($id = null) {
        $action = ($id == null) ? URL . 'banner/addGroup/' : URL . 'banner/editGroup/' . $id . '/';
        if ($id != null)
            $value = $this->getBannerGroups($id);
        $form = new Zebra_Form('addProject', 'POST', $action);

        $form->add('label', 'label_name', 'name', 'Name:');
        $form->add('text', 'name', $value['name'], array('autocomplete' => 'off'));

        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $value['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
                ), true);

        $form->add('label', 'label_type', 'type', 'Type:');
        $obj = $form->add('select', 'type', $value['type']);
        foreach ($this->getType() as $key => $type) {
            $option[$key] = $type;
        }
        $obj->add_options($option, true);
        unset($option);
        
        $form->add('label', 'label_section', 'section', 'Section:');
        $obj = $form->add('select', 'section', $value['section_id']);
        foreach ($this->getSections() as $key => $section) {
            $option[$section['home_sections_id']] = $section['name'];
        }
        $obj->add_options($option, true);
        unset($option);

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getBannerGroups($id = null) {
        if ($id == null)
            return $this->db->select('SELECT * FROM  banners_group ORDER by section_id');
        else
            return $this->db->selectOne('SELECT * FROM  banners_group WHERE id=:id ORDER by position', array('id' => $id));
    }

    public function getBannerByGroup($group, $lang = 'en') {
        return $this->db->select('SELECT *,p.created_at as imgdate,s.id as sugid,p.* FROM banners s JOIN banners_description sd ON sd.banner_id=s.id JOIN photos p ON s.photo_id=p.id WHERE s.group LIKE :group  AND sd.language_id=:lang ORDER by position', array('group' => $group, 'lang' => $lang));
    }

    public function getImageInfo($id, $lang = 'en') {
        return $this->db->selectOne('SELECT *,p.created_at as imgdate,p.* FROM banners s JOIN banners_description sd ON sd.banner_id=s.id JOIN photos p ON s.photo_id=p.id WHERE s.id=:id  AND sd.language_id=:lang  ORDER by position', array('id' => $id, 'lang' => $lang));
    }

    public function toTable($lista) {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Name",
                "width" => "20%"
            ),array(
                "title" => "Section",
                "width" => "20%"
            ),array(
                "title" => "Type",
                "width" => "20%"
            ), array(
                "title  " => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $section=$this->getSections($value['section_id']);
            $b['values'][] = array(
                "Name" => $value['name'],
                "Section" => $section['name'],
                "Type" => $this->getType($value['type']),
                "Options" => '<a href="' . URL . LANG . '/banner/view/' . $value['id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this page?\',\'banner/deleteGroup/' . $value['id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function addGroup() {
        $data = array(
            'name' => $_POST['name'],
            'section_id' => $_POST['section'],
            'type' => $_POST['type'],
            'visibility' => $_POST['visibility'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        return $this->db->insert('banners_group', $data);;
    }

    public function editGroup($id) {
         $data = array(
            'name' => $_POST['name'],
            'section_id' => $_POST['section'],
            'type' => $_POST['type'],
            'visibility' => $_POST['visibility'],
            'updated_at' => $this->getTimeSQL(),
        );
        return $this->db->update('banners_group', $data, "`id` = {$id}");
    }

    public function deleteGroup($id) {
        $this->db->delete('banners_group', "`id` = {$id}");
    }

    public function add($group = null, $img = null) {
        $data = array(
            'group' => $group,
            'photo_id' => $img['id'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        $suggestion_id = $this->db->insert('banners', $data);
        unset($data);
        foreach ($this->_langs as $lng) {
            $data = array(
                'banner_id' => $suggestion_id,
                'language_id' => $lng,
            );
            $this->db->insert('banners_description', $data);
        }
        return $group;
    }

    public function edit($id) {
        $data = array(
            'visibility' => $_POST['visibility'],
            'updated_at' => $this->getTimeSQL(),
        );
        $suggestion_id = $this->db->update('banners', $data, "`id` = {$id}");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data = array(
                'content' => $_POST['content_' . $lng],
                'name' => $_POST['name_' . $lng],
                'url' => $_POST['url']
            );
            $exist = $this->db->select("SELECT * FROM banners_description WHERE banner_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('banners_description', $data, "`banner_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('banners_description', $data);
        }
        return $suggestion_id;
    }

    public function delete($id) {
        $this->db->delete('banners', "`id` = {$id}");
        $this->db->delete('banners_description', "`banner_id` = {$id}");
    }

    public function deleteAll($group) {
        $sug = $this->db->select('SELECT * FROM banners s WHERE s.group=:group', array('group' => $group));
        foreach ($sug as $single)
            $this->db->delete('banners_description', "`banner_id` = {$single['id']}");
        $this->db->delete('banners', "`group` = {$group}");
    }

    public function sort() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('banners', $data, "`id` = '{$value}'");
        }
        exit;
    }

}
