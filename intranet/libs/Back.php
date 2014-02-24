<?php

class Back extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function isImage($photo_id) {
        /*
        $model = new Model();
        $images = $model->db->select("SELECT * FROM models_photos mp JOIN photos p ON(mp.photo_id=p.id) where p.id=" . $photo_id);
        foreach ($images as $value) {
            $rute = ROOT . '../uploads/models/';
            $rute.=$model->idToRute($photo_id);
            if (!file_exists($rute . 'original/' . $value['file_file_name'])){
                if (!is_dir($rute . 'original/'))
                    mkdir($rute . 'original/', 0777, true);
                $content = file_get_contents('http://models.sight-management.com/system/files/' . $model->idToRute($photo_id) . 'original/' . $value['file_file_name']);
                $fp = fopen( $rute . 'original/' . $value['file_file_name'], "w");
                fwrite($fp, $content);
                fclose($fp);
            }
            //copy('http://models.sight-management.com/system/files/'.$model->idToRute($photo_id),)

            if (!file_exists($rute . 'thumb_' . $value['file_file_name']) || !file_exists($rute . $value['file_file_name'])) {
                $thumb = new thumb();
                $thumb->loadImage($rute . 'original/' . $value['file_file_name']);
                $thumb->resize(500, 'height');
                $thumb->save($rute . $value['file_file_name']);
                $thumb->resize(210, 'height');
                //$thumb->crop(162, 215,'left');
                $thumb->save($rute . 'thumb_' . $value['file_file_name']);
                $thumb->destroy();
                unset($thumb);
            }
        }
         * */
    }

}