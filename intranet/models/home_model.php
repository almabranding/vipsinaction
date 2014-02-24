<?php

class Home_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function homeForm($id = 'null') {
        $action = ($id == null) ? URL . LANG . '/home/create' : URL . LANG . '/home/edit/' . $id;
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );

        $form = new Zebra_Form('addProject', 'POST', $action, $atributes);

        $obj = $form->add('file', 'my_file_upload');
        $obj->set_rule(array(
            'upload' => array(
                '/uploads/temp',
                ZEBRA_FORM_UPLOAD_RANDOM_NAMES,
                'error',
                'Could not upload file!',
            ),
            'filesize' => array(
                // maximum allowed file size (in bytes)
                '5024000',
                'error',
                'File size must not exceed 5Mb!'
            ),
            'filetype' => array(
                //allowed file types
                'jpg, jpeg, png',
                'error',
                'File must be a valid jpg file!'
            ),
        ));
        foreach ($this->_langs as $lng) {
            if ($id != null)
                $element = $this->getSections($id, $lng);
            $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Section name ' . $lng . ':');
            $form->add('text', 'name_' . $lng, $element['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));

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

    public function sort() {
        foreach ($_POST['sort'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('home_sections', $data, "`id` = '{$value}'");
        }
        exit;
    }

    public function create() {
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = $img['id'];
        $data = array(
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        $id = $this->db->insert('home_sections', $data);
        unset($data);
        foreach ($this->_langs as $lng) {
            $data['home_sections_id'] = $id;
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $this->db->insert('home_sections_description', $data);
        }

        return $idPackage;
    }

    public function edit($id) {
        $element = $this->getSections($id);
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = ($img != null) ? $img['id'] : $element['photo_id'];
        $data = array(
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('home_sections', $data, "`id` = '{$id}'");
        unset($data);
        foreach ($this->_langs as $lng) {
            $data['home_sections_id'] = $id;
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];

            $exist = $this->db->select("SELECT * FROM home_sections_description WHERE home_sections_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('home_sections_description', $data, "`home_sections_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('home_sections_description', $data);
        }
    }

    public function delete($id) {
        $this->db->delete('home_sections', "`id` = {$id}");
    }

    public function getSections($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select("SELECT *,s.id as id FROM home_sections s JOIN home_sections_description sd ON sd.home_sections_id=s.id WHERE sd.language_id=:lang ORDER by position", array("lang" => $lang));
        else
            return $this->db->selectOne("SELECT *,s.id as id FROM home_sections s JOIN home_sections_description sd ON sd.home_sections_id=s.id WHERE sd.language_id=:lang AND s.id=:id ORDER by position", array("id" => $id, "lang" => $lang));
    }

    public function toTable($lista) {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Section",
                "width" => "10%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $b['values'][] = array(
                "Section" => $value['name'],
                "Options" => '<a href="' . URL . LANG . '/home/view/' . $value['id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this section?\',\'home/delete/' . $value['id'] . '\');"></button>',
                "sortId" => $value['id'],
            );
        }
        return $b;
    }

}
