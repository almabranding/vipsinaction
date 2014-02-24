<?php

class Test_Model extends Model {

    public $pag, $wherepag;

    public function __construct() {
        parent::__construct();
        $this->wherepag = (Session::get('role') == 1 || Session::get('role') == 6) ? "WHERE user_id!=0" : "WHERE user_id=" . Session::get('userid');
    }

    public function deliverForm($package) {
        $pack = $this->getPackage($package);
        $action = URL . LANG . '/test/sendPackage/' . $package;
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );

        $form = new Zebra_Form('sendPackage', 'POST', $action, $atributes);

        $form->add('hidden', '_add', 'package');
        $form->add('hidden', 'idpackage', $package);

        $form->add('label', 'label_name', 'name', 'Name');
        $form->add('text', 'name', $pack[0]['name'], array('autocomplete' => 'off'));

        $form->add('label', 'label_contacts', 'contacts', 'Contacts');
        $obj = $form->add('select', 'contacts', '', array('autocomplete' => 'off'));
        foreach ($this->getContacts() as $key => $value) {
            $obt[$value['email']] = ($value['name']) ? $value['name'] . ', ' . $value['email'] : $value['email'];
        }
        if ($obt)
            $obj->add_options($obt);
        unset($obt);

        $form->add('label', 'label_recipients', 'recipients', 'Recipients');
        $form->add('textarea', 'recipients', '', array('autocomplete' => 'off', 'required' => array('error', 'Recipients is required!')));

        $form->add('label', 'label_subject', 'subject', 'Subject');
        $form->add('text', 'subject', '', array('autocomplete' => 'off'));


        $obj = $form->add('label', 'label_comment', 'comment', 'Message');
        $obj->set_attributes(array(
            'style' => 'float:none',
        ));
        $obj = $form->add('textarea', 'comment', '', array('autocomplete' => 'off'));
        $obj->set_attributes(array(
            'class' => 'wysiwyg',
        ));

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getContacts() {
        return $this->db->select("SELECT * FROM contacts " . $this->wherepag . " ORDER by name,email");
    }

    public function getPackagesList($pag, $maxpp, $order = 'updated_at ASC') {
        $min = $pag * $maxpp - $maxpp;
        return $this->db->select("SELECT * FROM packages " . $this->wherepag . " ORDER by " . $order . " LIMIT " . $min . "," . $maxpp);
    }

    public function isDelivered($package) {
        return $this->db->select("SELECT * FROM package_deliveries WHERE package_id=" . $package);
    }

    public function getDelivers($pag, $maxpp, $order = 'created_at DESC') {
        $min = $pag * $maxpp - $maxpp;
        return $this->db->select("SELECT * FROM package_deliveries " . $this->wherepag . " ORDER by " . $order . " LIMIT " . $min . "," . $maxpp);
    }

    public function deliversToTable($lista, $order = 'name asc') {
        $order = explode(' ', $order);
        $orden = (strtolower($order[1]) == 'desc') ? ' ASC' : ' DESC';
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Id",
                "link" => URL . LANG . '/packages/delivers/' . $this->pag . '/id' . $orden,
                "width" => "5%"
            ), array(
                "title" => "Deliver Name",
                "link" => URL . LANG . '/packages/delivers/' . $this->pag . '/name' . $orden,
                "width" => "20%"
            ),
            array(
                "title" => "Package name",
                "link" => "#",
                "width" => "15%"
            ),
            array(
                "title" => "Type",
                "link" => "#",
                "width" => "10%"
            ), array(
                "title" => "Recipients",
                "link" => URL . LANG . '/packages/delivers/' . $this->pag . '/recipients' . $orden,
                "width" => "20%"
            ), array(
                "title" => "Date",
                "link" => URL . LANG . '/packages/delivers/' . $this->pag . '/created_at' . $orden,
                "width" => "12%"
            ), array(
                "title" => "Checked",
                "link" => URL . LANG . '/packages/delivers/' . $this->pag . '/checked' . $orden,
                "width" => "1%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $package = $this->getPackage($value['package_id']);
            $package = $package[0];
            $type = ($package['type']) ? $package['type'] : 'booking';
            $b['values'][] = array(
                "id" => $value['id'],
                "Name" => $value['name'],
                "Package name" => $package['name'],
                "Package type" => $package['type'],
                "Recipients" => $value['recipients'],
                "Date" => $this->getTimeStamp($value['created_at']),
                "Checked" => ($value['checked']) ? 'SI' : 'NO',
                "Options" => '<a target="_blank" href="' . PACKAGE . urlencode($package['id'] . ' ' . $package['name']) . '/' . $type . '"><button title="Edit" type="button" class="edit"></button></a>'
            );
        }
        return $b;
    }

    public function packageToTable($lista, $order = 'name asc') {
        $order = explode(' ', $order);
        $orden = (strtolower($order[1]) == 'desc') ? ' ASC' : ' DESC';
        $b['sort'] = true;
        $b['noRow'] = true;
        $b['title'] = array(
            array(
                "title" => "Id",
                "link" => URL . LANG . '/packages/lista/' . $this->pag . '/id' . $orden,
                "width" => "5%"
            ), array(
                "title" => "Name",
                "link" => URL . LANG . '/packages/lista/' . $this->pag . '/name' . $orden,
                "width" => "10%"
            ), array(
                "title" => "Type",
                "link" => URL . LANG . '/packages/lista/' . $this->pag . '/type' . $orden,
                "width" => "10%"
            ), array(
                "title" => "Client",
                "link" => URL . LANG . '/packages/lista/' . $this->pag . '/client' . $orden,
                "width" => "30%"
            ), array(
                "title" => "Nº Models",
                "link" => "#",
                "width" => "1%"
            ), array(
                "title" => "Updated",
                "link" => URL . LANG . '/packages/lista/' . $this->pag . '/updated_at' . $orden,
                "width" => "20%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            //$nModels = $this->db->select("SELECT COUNT(*) as nModels FROM packed_models WHERE package_id = :id", array('id' => $value['id']));
            $b['classRow'][] = ($this->isDelivered($value['id'])) ? 'tableSelected' : '';
            $b['values'][] = array(
                "id" => $value['id'],
                "name" => $value['name'],
                "type" => $value['type'],
                "client" => $value['client'],
                "number" => $this->getNModels($value['id']),
                "updated" => $this->getTimeStamp($value['updated_at']),
                "Options" => '<a href="' . URL . LANG . '/packages/view/' . $value['id'] . '"><button type="button" title="Edit" class="edit"></button></a><a href="' . URL . LANG . '/packages/duplicate/' . $value['id'] . '"><button type="button" title="Duplicate" class="duplicate"></button></a><button type="button" title="Delete" class="delete" onclick="borrarPackList(\'' . $value['id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function getModel($id) {
        return $this->db->select('SELECT * FROM models WHERE id=' . $id);
    }

    public function modelsPackage($id) {
        return $this->db->select('SELECT * FROM models m Join packed_models pm on(m.id=pm.model_id) JOIN models_photos mp ON (pm.model_id=mp.model_id) JOIN photos p ON (mp.photo_id=p.id) WHERE pm.package_id = :id and mp.main=1 order by pm.position', array('id' => $id));
    }

    public function getNModels($id) {
        $nModels = $this->db->select('SELECT COUNT(*) as nModels FROM packed_models WHERE package_id = :id', array('id' => $id));
        return $nModels[0]['nModels'];
    }

    public function getPackageImages($id) {
        return $this->db->select('SELECT * FROM images WHERE page = :id ORDER by orden', array('id' => $id));
    }

    public function getClients() {
        return $this->db->select('SELECT DISTINCT(client) FROM packages ' . $this->wherepag . ' ORDER BY client ASC');
    }

    public function getPackage($id) {
        return $this->db->select('SELECT * FROM packages WHERE id=' . $id);
    }

    public function getModelPhoto($id) {
        $thumb = $this->db->select('SELECT * FROM models_photos WHERE model_id = :id ORDER BY position', array('id' => $id));
        return $thumb[0];
    }

    public function getPackages($pag, $maxpp) {
        $min = $pag * $maxpp - $maxpp;
        return $this->db->select('SELECT * FROM packages ORDER by name LIMIT ' . $min . ',' . $maxpp);
    }

    public function getAllPackages() {
        return $this->db->select('SELECT * FROM packages ORDER by name');
    }

    public function create() {
        $img = $this->upload('temp/', 'my_file_upload');
        $photo_id = $this->insertImg($img);
        $data = array(
            'name' => $_POST['name'],
            'client' => $_POST['client'],
            'user_id' => Session::get(userid),
            'type' => $_POST['type'],
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL()
        );
        $idPackage = $this->db->insert('packages', $data);
        return $idPackage;
    }

    public function duplicate($package_id) {
        $newPackage = $this->db->DuplicateRow('packages', 'id', $package_id);
        $res = $this->db->select("SELECT * FROM packed_models WHERE package_id = '" . $package_id . "'");
        foreach ($res as $row) {
            unset($data);
            foreach ($row as $key => $val) {
                if ($key != 'id')
                    $data[$key] = ($key == 'package_id') ? $newPackage : $val;
            }
            $this->db->insert('packed_models', $data);
        }
        return 0;
    }

    public function edit($id) {
        $img = $this->upload('temp/', 'my_file_upload');
        $photo_id = $this->insertImg($img);
        $data = array(
            'name' => $_POST['name'],
            'client' => $_POST['client'],
            'type' => $_POST['type'],
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update('packages', $data, "`id` = '{$id}'");
    }

    public function upload($sub = '', $name = 'pic') {
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

            if (!in_array($pathinfo['extension'], $allowed_img))
                exit;
            if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadDir . $file)) {
                $data['img'] = true;
                if ($pathinfo['extension'] == 'png') {
                    $this->png2jpg($uploadDir . $file, $uploadDir . $nameFile . '.jpg');
                    $file = $nameFile . '.jpg';
                }
                $data['file'] = $file;
                $data['nameFile'] = $nameFile;
                $data['file_size'] = filesize($uploadDir . $file);
                list($data['width'], $data['height'], $imgType, $atributos) = getimagesize($uploadDir . $file);
                $data['file_content_type'] = image_type_to_mime_type($imgType);
                return $data;
            }
        }
        return false;
    }

    public function png2jpg($originalFile, $outputFile, $quality = 100) {
        $image = imagecreatefrompng($originalFile);
        imagejpeg($image, $outputFile, $quality);
        unlink($originalFile);
        imagedestroy($image);
    }

    public function delete($id) {
        $this->db->delete('packed_models', "`package_id` = {$id}");
        $this->db->delete('packages', "`id` = {$id}");
    }

    public function addToPackage($package) {
        foreach ($_POST['check'] as $key => $value) {
            $exist = $this->db->select('SELECT * FROM packed_models WHERE package_id=' . $package . ' AND model_id=' . $value);
            if (!$exist) {
                $pos = $this->db->select('SELECT MAX(position) as position from packed_models WHERE package_id=' . $package);
                $pos = $pos[0]['position'] + 1;
                $data = array(
                    'package_id' => $package,
                    'model_id' => $value,
                    'position' => $pos,
                    'created_at' => $this->getTimeSQL()
                );
                $this->db->insert('packed_models', $data);
            }
        }
        exit;
    }

    public function deleteModel($package, $modelId) {
        $this->db->delete('packed_models', "`model_id` = {$modelId} AND `package_id` = {$package}");
    }

    public function sort() {
        foreach ($_POST['foo'] as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('packed_models', $data, "`model_id` = '{$value}' AND `package_id` = '{$_POST['id']}'");
        }
        exit;
    }

    public function sortByName($id) {
        $models = $this->db->select('SELECT * FROM packed_models pm JOIN models m on (pm.model_id=m.id) WHERE pm.package_id=' . $id . ' ORDER by m.name');
        foreach ($models as $key => $value) {
            $data = array(
                'position' => $key
            );
            $this->db->update('packed_models', $data, "`model_id` = '{$value['model_id']}' AND `package_id` = '{$id}'");
        }
    }

    public function deleteModels() {
        foreach ($_POST['check'] as $key => $value) {
            $package = explode("_", $value);
            $this->db->delete('packed_models', "`package_id` = {$package[0]} AND `model_id` = {$package[1]}");
        }
        exit;
    }

    public function getAllModels($order = 'name') {
        return $this->db->select('SELECT * FROM models ORDER by ' . $order);
    }

    public function getResultSearch() {
        $models = null;
        if ($_POST['name'] != '') {
            $models = explode(", ", $_POST['name']);
            $sql = 'SELECT p.id,p.name,p.client,p.updated_at FROM packages p join packed_models pm ON (p.id=pm.package_id) join models m ON (pm.model_id=m.id) ' . $this->wherepag . ' AND (';
            foreach ($models as $key => $value) {
                $sql.=' m.name LIKE "%' . $value . '%" OR';
            }
            $sql = substr($sql, 0, -3);
            $sql.=') AND';
        } else
            $sql = 'SELECT p.id,p.name,p.client,p.updated_at FROM packages p ' . $this->wherepag . ' AND';
        if ($_POST['package'] != '') {
            $sql.=' p.name LIKE "%' . $_POST['package'] . '%" AND';
        }
        if ($_POST['client'] != '') {
            $sql.=' p.client="' . $_POST['client'] . '" AND';
        }
        if ($_POST['date'] != '') {
            $sql.=' p.updated_at LIKE "%' . $_POST['dateFormated'] . '%" AND';
        }
        $sql = substr($sql, 0, -3);
        $sql.=' ORDER by name';
        return $this->db->select($sql);
    }

    public function getUser($id) {
        return $this->db->select('SELECT * FROM users WHERE id=' . $id);
    }

    public function sendPackage() {
        $package = $this->getPackage($_POST['idpackage']);
        $type = ($package[0]['type']) ? $package[0]['type'] : 'selection';
        $user = $this->getUser(Session::get('userid'));
        $user = $user[0];
        $mailSight = $user['email'];
        $titulo = ($_POST['subject'] == '') ? 'Sight-Management' : 'Sight-Management: ' . $_POST['subject'];
        $mensaje = stripslashes($_POST['comment']);

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "From: " . strip_tags($mailSight) . "\r\n";
        $headers .= "Reply-To: " . strip_tags($mailSight) . "\r\n";
        //$headers .= "X-Mailer:PHP/".phpversion()."\n"; 
        //$headers .= "X-Mailer: Microsoft Office Outlook, Build 11.0.5510\r\n"; 

        if ($mensaje == '')
            $mensaje = 'This package was sent to you by ' . $user['firstname'] . ' ' . $user['lastname'];
        $dest = explode(",", $_POST['recipients']);
        foreach ($dest as $para) {

            $sth = $this->db->select("SELECT * FROM contacts WHERE email = :email and user_id=:user_id", array('email' => $para, 'user_id' => Session::get('userid')));
            if (!$sth) {
                $data = array(
                    'email' => $para,
                    'created_at' => $this->getTimeSQL(),
                    'updated_at' => $this->getTimeSQL(),
                    'user_id' => Session::get('userid')
                );
                $this->db->insert('contacts', $data);
            }
            $images = '';
            $data = array(
                'recipients' => $para,
                'package_id' => $package[0]['id'],
                'user_id' => Session::get('userid'),
                'subject' => $_POST['subject'],
                'name' => $_POST['name'],
                'body' => $mensaje,
                'created_at' => $this->getTimeSQL(),
            );
            $deliver_id = $this->db->insert('package_deliveries', $data);
            $pakLink = PACKAGE . urlencode(str_replace('&', 'and', $package[0]['id'] . ' ' . $deliver_id . ' ' . $_POST['name'])) . '/' . $type;
            foreach ($this->modelsPackage($package[0]['id']) as $key => $value) {
                if ($key < 4)
                    $images.='<td><a href="' . $pakLink . '"><img height="200" src="http://sight-management.com/uploads/models/' . Model::idToRute($value['photo_id']) . $value['file_file_name'] . '"/></a></td>';
            }
            $tpl = file_get_contents('packageTemplate.html');
            $tpl = str_replace('{{content}}', $mensaje, $tpl);
            $tpl = str_replace('{{name}}', $_POST['name'], $tpl);
            $tpl = str_replace('{{images}}', $images, $tpl);
            $tpl = str_replace('{{link}}', $pakLink, $tpl);



            include 'Mail.php';
            include 'Mail/mime.php';

            $text = 'Text version of email';
            $crlf = "\n";
            $hdrs = array(
                'From' => strip_tags($mailSight),
                'to' => $para,
                'Subject' => $titulo
            );
            $mime = new Mail_mime(array('eol' => $crlf));

            $mime->setTXTBody($text);
            $mime->setHTMLBody($tpl);

            $body = $mime->get();
            $headers = $mime->headers($hdrs);

            $mail = & Mail::factory('mail');
            $mail->send($para, $headers, $body);
        }
    }

    public function insertImg($img) {
        if (!$img)
            return 0;
        $photo_id = $this->db->insert('photos', array(
            'file_file_name' => $img['file'],
            'file_content_type' => $img['file_content_type'],
            'file_file_size' => $img['file_file_size'],
            'width' => $img['width'],
            'height' => $img['height'],
            'selected_at_packager' => 1,
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
            'file_updated_at' => $this->getTimeSQL()
        ));
        /* $this->db->insert('models_photos', array(
          'photo_id' => $photo_id,
          'visibility' => 'public',
          'model_id' => $modelId,
          )); */
        $rute = 'models/';
        $rute.=$this->idToRute($photo_id);
        if (!is_dir(UPLOAD . $rute . 'original'))
            mkdir(UPLOAD . $rute . 'original/', 0777, true);
        copy(UPLOAD . 'temp/' . $img['file'], UPLOAD . $rute . 'original/' . $img['file']);
        $thumb = new thumb();
        $thumb->loadImage(UPLOAD . $rute . 'original/' . $img['file']);
        $thumb->resize(500, 'height');
        $thumb->save(UPLOAD . $rute . $img['file']);
        $thumb->crop(162, 215);
        $thumb->save(UPLOAD . $rute . 'thumb_' . $img['file']);
        unlink(UPLOAD . 'temp/' . $img['file']);
        return $photo_id;
    }

}
