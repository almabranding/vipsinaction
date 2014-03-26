<?php

class Banner_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function formBanner($id = null) {
        $action = ($id == null) ? URL . 'banner/add/' : URL . 'banner/edit/' . $id . '/';
        if ($id != null)
            $value = $this->getBanner($id);
        $form = new Zebra_Form('addProject', 'POST', $action);
        
        $form->add('label', 'label_my_file_upload', 'my_file_upload', 'Map image:');
        $obj = $form->add('file', 'my_file_upload');
        $obj->set_rule(array(
            'upload' => array(
                '/uploads/temp',
                ZEBRA_FORM_UPLOAD_RANDOM_NAMES,
                'error',
                'Could not upload file!',
            ),
            'filesize' => array(
                '2024000',
                'error',
                'File size must not exceed 2Mb!'
            ),
            'filetype' => array(
                'jpg, jpeg, png',
                'error',
                'File must be a valid jpg file!'
            ),
        ));

        $form->add('label', 'label_url', 'url', 'URL:');
        $form->add('text', 'url', $value['url'], array('autocomplete' => 'off'));

        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $value['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
                ), true);


        foreach ($this->_langs as $lng) {
            if ($id != null)
                $element = $this->getBanner($id, $lng);
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

    public function getBanner($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select('SELECT * FROM banners s JOIN banners_description sd ON sd.banner_id=s.id WHERE sd.language_id=:lang ORDER by position', array('lang' => $lang));
        else
            return $this->db->selectOne('SELECT * FROM banners s JOIN banners_description sd ON sd.banner_id=s.id WHERE s.id=:id AND sd.language_id=:lang', array('id' => $id, 'lang' => $lang));
    }

    public function getImageInfo($id, $lang = 'en') {
        return $this->db->selectOne('SELECT *,p.created_at as imgdate,p.* FROM banners s JOIN banners_description sd ON sd.banner_id=s.id JOIN photos p ON s.photo_id=p.id WHERE s.id=:id  AND sd.language_id=:lang  ORDER by position', array('id' => $id, 'lang' => $lang));
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
                "Options" => '<a href="' . URL . LANG . '/banner/view/' . $value['banner_id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this page?\',\'banner/delete/' . $value['banner_id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function add() {
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = $img['id'];
        $data = array(
            'url' => $_POST['url'],
            'visibility' => $_POST['visibility'],
            'photo_id' => $photo_id,
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        $id = $this->db->insert('banners', $data);
        unset($data);
        $data['banner_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $this->db->insert('banners_description', $data);
        }
        return $id;
    }

    public function edit($id) {
        $element = $this->getBanner($id);
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = ($img != null) ? $img['id'] : $element['photo_id'];
        $data = array(
            'url' => $_POST['url'],
            'visibility' => $_POST['visibility'],
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('banners', $data, "`id` = '{$id}'");
        unset($data);
        $data['banner_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $exist = $this->db->select("SELECT * FROM banners_description WHERE banner_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('banners_description', $data, "`banner_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('banners_description', $data);
        }
    }

    public function delete($id) {
        $this->db->delete('banners', "`id` = {$id}");
        $this->db->delete('banners_description', "`banner_id` = {$id}");
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
