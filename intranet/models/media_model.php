<?php

class Media_Model extends Model {

    public $pag;

    public function __construct() {
        parent::__construct();
        $this->wherepag = ' WHERE 1=1 ';
    }

    public function formImage($id = null) {

        $action = ($id == null) ? URL . LANG . '/media/editImage' : URL . LANG . '/media/editImage/' . $id;
        if ($id != null)
            $value = $this->getImageInfo;

        $form = new Zebra_Form('addProject', 'POST', $action);
        $pathinfo = pathinfo($value['img']);
        $form->add('hidden', '_add', 'page');
        $form->add('hidden', 'model_id', $value['model_id']);
        $form->add('hidden', 'originalName', $value['img']);
        $form->add('hidden', 'fileExt', $pathinfo['extension']);

        $form->add('label', 'label_caption', 'caption', 'Caption');
        $obj = $form->add('text', 'caption', $value['caption'], array('autocomplete' => 'off'));

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getImageInfo($id) {
        return $this->db->selectOne('SELECT * FROM photos p JOIN gallery_photos mp ON(p.id=mp.photo_id) WHERE p.id = :id', array('id' => $id));
    }

    public function getGalleryList($pag, $maxpp, $order = 'created_at', $lang = LANG) {
        $min = $pag * $maxpp - $maxpp;
        return $this->db->select("SELECT * FROM photos a JOIN gallery_photos b ON a.id=b.photo_id " . $this->wherepag . " ORDER by " . $order . " LIMIT " . $min . "," . $maxpp);
    }

    public function toTable($lista, $order) {
        $order = explode(' ', $order);
        $orden = (strtolower($order[1]) == 'desc') ? ' ASC' : ' DESC';
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Image",
                "link" => URL . LANG . '/media/lista/' . $this->pag . '/name' . $orden,
                "width" => "5%"
            ), array(
                "title" => "Caption",
                "link" => URL . LANG . '/media/lista/' . $this->pag . '/email' . $orden,
                "width" => "5%"
            ), array(
                "title" => "URL",
                "link" => URL . LANG . '/media/lista/' . $this->pag . '/email' . $orden,
                "width" => "40%"
            ), array(
                "title" => "Created",
                "link" => URL . LANG . '/media/lista/' . $this->pag . '/created_at' . $orden,
                "width" => "10%"
            ), array(
                "title" => "Options",
                "link" => "#",
                "width" => "5%"
        ));
        foreach ($lista as $key => $value) {
            $b['values'][] = array(
                        "Image" => '<img height="80" src="' . URL . UPLOAD . $this->getRouteImg($value['img_date']) . 'thumb_250x250_'.$value['file_name'] . '">',
                        "Caption" => $value['caption'],
                        "URL" => WEB . 'uploads/' . $this->getRouteImg($value['img_date']) . $value['file_name'],
                        "Created" => $this->getTimeStamp($value['img_date']),
                        "Options" => '<a href="' . URL . 'media/view/' . $value['photo_id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Are you sure you want to delete?\', \'media/delete/' . $value['photo_id'] . ' \');"></button>'
            );
        }
        return $b;
    }

    public function editImage($id) {
        $data = array(
            'caption' => $_POST['caption'],
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('photos', $data, "`id` = '{$id}'");
    }

    public function delete($id) {
        $img = $this->getImageInfo($id);
        @unlink(ROOT . UPLOAD . $this->getRouteImg($img['img_date']) . $img['file_name']);
        $this->db->delete('photos', "`id` = {$id}");
        $this->db->delete('gallery_photos', "`photo_id` = {$id}");
    }

    public function addPhoto($img) {
        $data = array(
            'photo_id' => $img['id'],
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        return $this->db->insert('gallery_photos', $data);
    }

}
