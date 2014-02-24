<?php

class upload extends Model {
    private $img;
    private $result;
    public function upload($sub = 'temp/', $name = 'pic',$result=true) {
        parent::__construct();
        $this->result=$result;
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc');
        $allowed_img = array('jpg', 'jpeg', 'png', 'gif');
        if (!is_dir(UPLOAD))
            mkdir(UPLOAD);
        $uploadDir = UPLOAD . $sub . '/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir);
        if (array_key_exists($name, $_FILES) && $_FILES[$name]['error'] == 0) {
            $pathinfo = pathinfo($_FILES[$name]["name"]);
            $nameFile = (file_exists($uploadDir . $_FILES[$name]["name"])) ? $pathinfo['filename'] . '_' . rand() : $pathinfo['filename'];
            $file = $nameFile . '.' . $pathinfo['extension'];
            if (($_FILES[$name]['size'])>FILESIZE*1048576)
                $this->exit_status('Demasiado grande');
            if (!in_array($pathinfo['extension'], $allowed_img))
                $this->exit_status('Only ' . implode(',', $allowed_ext) . ' files are allowed!');
            if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadDir . $file)) {
                //$data = $this->createThumbs($file, $uploadDir, $uploadDir, $thumbWidth);
                $data['img'] = true;
                if ($pathinfo['extension'] == 'png') {
                    $this->png2jpg($uploadDir . $file, $uploadDir . $nameFile . '.jpg');
                    $file = $nameFile . '.jpg';
                }
                $this->exit_status('File was uploaded successfuly!');
                $data['file'] = $file;
                $data['nameFile'] = $nameFile;
                $data['file_size'] = filesize($uploadDir . $file);
                list($data['width'], $data['height'], $imgType, $atributos) = getimagesize($uploadDir . $file);
                $data['file_content_type'] = image_type_to_mime_type($imgType);
                $this->img=$this->insertImg($data);
                return 1;
            }
        }

        $this->exit_status('Something went wrong with your upload!');
    }
    public function getImg(){
        return $this->img;
    }
    function exit_status($str) {
        if($this->result)echo json_encode(array('status' => $str));
    }

    public function crop() {
        $original = $_POST['original'];
        $filename = $_POST['filename'];
        $filepath = UPLOAD . $_POST['filefolder'] . '/';
        $rel = $_POST['rel'];
        $targ_w = $_POST['w'] * $rel;
        $targ_h = $_POST['h'] * $rel;
        $src = $filepath . $original;
        $dst = $filepath . $filename;
        $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

        $img_r = imagecreatefromjpeg($src);
        imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'] * $rel, $_POST['y'] * $rel, $targ_w, $targ_h, $_POST['w'] * $rel, $_POST['h'] * $rel);
        imagejpeg($dst_r, $dst, 100);
        if(!$_POST['thumbnail']){
            $thumb = new thumb();
            $thumb->loadImage($filepath . $filename);
            $thumb->resize(500, 'height');
            $thumb->save($filepath . $filename);
        }
        //$this->createThumbs($filename,$filepath, $filepath, $thumbWidth );
    }

    public function insertImg($img) {
        $data = array(
            'file_name' => $img['file'],
            'file_content_type' => $img['file_content_type'],
            'file_size' => $img['file_file_size'],
            'width' => $img['width'],
            'height' => $img['height'],
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL()
        );
        $photo_id = $this->db->insert('photos', $data);
        $rute = $this->getRouteImg($data['created_at']);
        if (!is_dir(UPLOAD . $rute . 'original'))
            mkdir(UPLOAD . $rute . 'original/', 0777, true);
        copy(UPLOAD . 'temp/' . $img['file'], UPLOAD . $rute . 'original/' . $img['file']);
        $thumb = new thumb();
        $thumb->loadImage(UPLOAD . $rute . 'original/' . $img['file']);
        //$thumb->resize(500, 'height');
        $thumb->save(UPLOAD . $rute . $img['file']);
        $thumb->crop(162, 215);
        $thumb->save(UPLOAD . $rute . 'thumb_' . $img['file']);
        unlink(UPLOAD . 'temp/' . $img['file']);
        $data['id']=$photo_id;
        return $data;
    }
    
    
    public function png2jpg($originalFile, $outputFile, $quality = 100) {
        $image = imagecreatefrompng($originalFile);
        imagejpeg($image, $outputFile, $quality);
        unlink($originalFile);
        imagedestroy($image);
    }

   
}