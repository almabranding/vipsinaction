<?php

class Reviews_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function reviewsForm($id = 'null') {
        $action = ($id == null) ? URL . LANG . '/reviews/create' : URL . LANG . '/reviews/edit/' . $id;

        $atributes = array(
            'enctype' => 'multipart/form-data',
        );

        $form = new Zebra_Form('addProject', 'POST', $action, $atributes);
        $element = $this->getReviews($id);

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
        
        $obj = $form->add('label', 'label_url', 'url', 'URL:');
        $obj = $form->add('text', 'url', $element['url'], array('autocomplete' => 'off', 'data-prefix' => 'http://'));


        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $element['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
                ), true);
        foreach ($this->_langs as $lng) {
            if ($id != null)
                $element = $this->getReviews($id, $lng);
            $obj = $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Name ' . $lng . ':');
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
    public function getReviews($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select("SELECT * FROM reviews d JOIN reviews_description dd on dd.review_id=d.id WHERE  language_id=:lang", array('lang' => $lang));
        else
            return $this->db->selectOne("SELECT * FROM reviews d JOIN reviews_description dd on dd.review_id=d.id WHERE d.id=:id AND language_id=:lang", array('id' => $id, 'lang' => $lang));
    }

    public function toTable($lista, $type = '') {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Image",
                "width" => "10%"
            ),array(
                "title" => "Name",
                "width" => "10%"
            ), array(
                "title" => "Info",
                "width" => "60%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $photo = ($value['photo_id']) ? $this->getPhoto($value['photo_id']) : false;
            $b['values'][] = array(                
                "img" => ($photo) ? '<img width="100" src="' . WEB . UPLOAD . '/' . $this->getRouteImg($photo['img_date']) . $photo['file_name'] . '">' : '',
                "Name" => $value['name'],
                "Info" => htmlentities(substr($value['content'], 0, 150)),
                "Options" => '<a href="' . URL . 'reviews/view' . $type . '/' . $value['review_id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this page?\',\'reviews/delete' . $type . '/' . $value['review_id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function create() {
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = $img['id'];
        $photo_id = ($img != null) ? $img['id'] : 1;
        $data = array(
            'visibility' => $_POST['visibility'],
            'url' => $_POST['url'],
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        $id = $this->db->insert('reviews', $data);
        unset($data);
        $data['review_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $this->db->insert('reviews_description', $data);
        }
        return $id;
    }

    public function edit($id) {
        $element = $this->getReviews($id);
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = ($img != null) ? $img['id'] : $element['photo_id'];
        $data = array(
            'url' => $_POST['url'],
            'visibility' => $_POST['visibility'],
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('reviews', $data, "`id` = '{$id}'");
        unset($data);
        $data['review_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['content'] = $_POST['content_' . $lng];
            $exist = $this->db->select("SELECT * FROM reviews_description WHERE review_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update('reviews_description', $data, "`review_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert('reviews_description', $data);
        }
    }

    public function delete($id) {
        $this->db->delete('reviews', "`id` = {$id}");
        $this->db->delete('reviews_description', "`review_id` = {$id}");
    }

}
