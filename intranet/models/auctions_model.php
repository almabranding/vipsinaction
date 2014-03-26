<?php

class Auctions_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function formAuction($id = null) {
        $action = ($id == null) ? URL . 'auctions/add/' : URL . 'auctions/edit/' . $id . '/';
        if ($id != null)
            $value = $this->getAuctions($id);
        $form = new Zebra_Form('addProject', 'POST', $action);

        $form->add('label', 'label_my_file_upload', 'my_file_upload', 'Image:');
        $obj = $form->add('file', 'my_file_upload');
        $obj->set_rule(array(
            'upload' => array(
                UPLOAD,
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
        $form->add('label', 'label_donated', 'donated', 'Donado por:');
        $obj = $form->add('select', 'donated', $value['donated']);
        foreach($this->getColaborators() as $aux){
            $array[$aux['donantes_id']]=$aux['name'];
        }
        $obj->add_options($array, false);
        unset($array);
        $form->add('label', 'label_for', 'for', 'Para:');
        $obj = $form->add('select', 'for', $value['for']);
        foreach($this->getOng() as $aux){
            $array[$aux['donantes_id']]=$aux['name'];
        }
        $obj->add_options($array, false);
        $form->add('label', 'label_price', 'price', 'Real price:');
        $obj = $form->add('text', 'price', $value['price'], array('autocomplete' => 'off'));
        $form->add('label', 'label_minimum_bid', 'minimum_bid', 'Starting price:');
        $obj = $form->add('text', 'minimum_bid', $value['minimum_bid'], array('autocomplete' => 'off'));
        $obj->set_rule(array(
            'required' => array('error', 'Please select increment'),
        ));

        $obj = $form->add('label', 'label_increments', 'increments', 'Bid increment');
        $obj->set_attributes(array(
            'style' => 'float:none',
        ));
        $obj = $form->add('radios', 'increments', array(
            '1' => 'Use the built-in proportional increments table ',
            '2' => 'Use your custom fixed increment',
                ), '1');

        $obj = $form->add('label', 'label_increment', 'increment', 'Custom fixed');
        $form->add('text', 'increment', $value['increment'], array('autocomplete' => 'off'));
        $obj->set_rule(array(
            'dependencies' => array(array(
                    'increments' => '2',
                ), 'mycallback, 1'),
        ));


//        $obj = $form->add('label', 'label_buynow', 'buynow', 'Buy now');
//        $obj->set_attributes(array(
//            'style' => 'float:none',
//        ));
//        $obj = $form->add('radios', 'buynow', array(
//            'no' => 'No',
//            'yes' => 'Yes',
//                ), 'no');
//
//        $obj = $form->add('label', 'label_buy_now', 'buy_now', 'Buy Now');
//        $form->add('text', 'buy_now', $value['buy_now'], array('autocomplete' => 'off'));
//        $obj->set_rule(array(
//            'dependencies' => array(array(
//                    'buynow' => 'yes',
//                ), 'mycallback, 2'),
//        ));
//$form->add('text', 'buy_now', $value['buy_now'], array('autocomplete' => 'off'));
//        $obj->set_rule(array(
//            'dependencies' => array(array(
//                    'buynow' => 'yes',
//                ), 'mycallback, 2'),
//        ));

        $obj = $form->add('label', 'label_auctionStart', 'auctionStart', 'Acution Start');
        $obj->set_attributes(array(
            'style' => 'float:none',
        ));
        $obj = $form->add('checkboxes', 'startNow', array(
            'yes' => 'Start auction now',
        ),'yes');

        $obj = $form->add('label', 'label_auctionStart', 'auctionStart', 'Start auction at:');
        $obj->set_attributes(array(
            'style' => 'float:none',
        ));
        // "date"
        $form->add('label', 'label_date', 'date', 'Start date');
        $date = $form->add('date', 'date');
        $date->set_rule(array(
            'date' => array('error', 'Date is invalid!'),
        ));
        $date->format('d-m-Y');
        $form->add('label', 'label_time', 'time', 'Start time :');
        $obj = $form->add('time', 'time', '', array(
            'format' => 'hm',
        ));


        $form->add('label', 'label_duration', 'duration', 'Duration:');
        $obj = $form->add('select', 'duration', $value['duration']);
        unset($opt);
        foreach ($this->getDuration() as $duration) {
            $opt[$duration['days']] = $duration['description'];
        }
        $obj->add_options($opt, true);

        

        $obj = $form->add('label', 'label_shipping_cost', 'shipping_cost', 'Shipping cost');
        $form->add('text', 'shipping_cost', $value['shipping_cost'], array('autocomplete' => 'off'));

        $form->add('label', 'label_visibility', 'visibility', 'Visibility:');
        $obj = $form->add('select', 'visibility', $value['visibility']);
        $obj->add_options(array(
            'public' => 'Public',
            'private' => 'Private',
                ), true);

        $obj = $form->add('label', 'label_featured', 'featured', 'Featured');
        $obj->set_attributes(array(
            'style' => 'float:none',
        ));
        $obj = $form->add('checkboxes', 'featured', array(
            'y' => 'Do it featured',
                ), $value['featured']);
        foreach ($this->_langs as $lng) {
            if ($id != null)
                $element = $this->getAuctions($id, $lng);
            $obj = $form->add('label', 'label_name_' . $lng, 'name_' . $lng, 'Auction name ' . $lng . ':');
            $obj = $form->add('text', 'name_' . $lng, $element['name'], array('autocomplete' => 'off', 'required' => array('error', 'Name is required!')));

            $obj = $form->add('label', 'label_short_description_' . $lng, 'short_description_' . $lng, 'Short description ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'short_description_' . $lng, $element['short_description'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));

            $obj = $form->add('label', 'label_description_' . $lng, 'description_' . $lng, 'Description ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'description_' . $lng, $element['description'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));

            $obj = $form->add('label', 'label_legal_' . $lng, 'legal_' . $lng, 'Legal ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'legal_' . $lng, $element['legal'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));

            $obj = $form->add('label', 'label_envio_' . $lng, 'envio_' . $lng, 'Envio ' . $lng);
            $obj->set_attributes(array(
                'style' => 'float:none',
            ));
            $obj = $form->add('textarea', 'envio_' . $lng, $element['envio'], array('autocomplete' => 'off'));
            $obj->set_attributes(array(
                'class' => 'wysiwyg',
            ));
        }

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getColaborators($lang = LANG) {
        return $this->db->select("SELECT * FROM donantes d JOIN donantes_description dd on dd.donantes_id=d.id WHERE language_id=:lang AND (type=1 OR type=2)", array('lang' => $lang));
    }

    public function getOng($lang = LANG) {
        return $this->db->select("SELECT * FROM donantes d JOIN donantes_description dd on dd.donantes_id=d.id WHERE  language_id=:lang AND type=3", array('lang' => $lang));
    }

    public function getDuration($id = null) {
        if ($id == null)
            return $this->db->select('SELECT * FROM ' . BID_PREFIX . 'durations ORDER by days');
        else
            return $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'durations WHERE a.id=:id', array('id' => $id));
    }

    public function getAuctions($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select('SELECT * FROM ' . BID_PREFIX . 'auctions a JOIN ' . BID_PREFIX . 'auctions_description b ON b.auction_id=a.id WHERE b.language_id=:lang ORDER by ends ASC', array('lang' => $lang));
        else
            return $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'auctions a JOIN ' . BID_PREFIX . 'auctions_description b ON b.auction_id=a.id WHERE a.id=:id AND b.language_id=:lang', array('id' => $id, 'lang' => $lang));
    }

    public function toTable($lista) {
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "image",
                "width" => "10%"
            ), array(
                "title" => "name",
                "width" => "40%"
            ), array(
                "title" => "Options",
                "width" => "10%"
        ));
        foreach ($lista as $key => $value) {
            $photo = ($value['photo_id']) ? $this->getPhoto($value['photo_id']) : false;
            $b['values'][] = array(
                "image" => ($photo) ? '<img width="100" src="' . WEB . UPLOAD . '/' . $this->getRouteImg($photo['img_date']) . $photo['file_name'] . '">' : '',
                "name" => $value['name'],
                "Options" => '<a href="' . URL . LANG . '/auctions/view/' . $value['auction_id'] . '"><button title="Edit" type="button" class="edit"></button></a><button type="button" title="Delete" class="delete" onclick="secureMsg(\'Do you want to delete this auction?\',\'auctions/delete/' . $value['auction_id'] . '\');"></button>'
            );
        }
        return $b;
    }

    public function add() {
        list($date['day'], $date['month'], $date['year']) = explode('-', $_POST['date']);
        $time = strtotime($date['year'] . '-' . $date['month'] . '-' . $date['day']);
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = ($img != null) ? $img['id'] : 1;
        $increment = ($_POST['increments'] == 1) ? 0 : $_POST['increment'];
        $buynow = ($_POST['buynow'] == 'yes') ? $_POST['buy_now'] : 0;
        $starts = ($_POST['startNow'] == 'yes') ? time() : $time;
        $ends = $starts + ($_POST['duration'] * 1 * 24 * 60 * 60);
        $data = array(
            'donated' => $_POST['donated'],
            'for' => $_POST['for'],
            'minimum_bid' => $_POST['minimum_bid'],
            'increment' => $increment,
            'buy_now' => $buynow,
            'starts' => $starts,
            'duration' => $_POST['duration'],
            'price' => $_POST['price'],
            'ends' => $ends,
            'featured' => $_POST['featured'],
            'shipping' => $_POST['shipping_cost'],
            'visibility' => $_POST['visibility'],
            'photo_id' => $photo_id,
            'created_at' => $this->getTimeSQL(),
            'updated_at' => $this->getTimeSQL(),
        );
        $id = $this->db->insert(BID_PREFIX . 'auctions', $data);
        unset($data);
        $data['auction_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['subtitle'] = $_POST['subtitle_' . $lng];
            $data['legal'] = $_POST['legal_' . $lng];
            $data['envio'] = $_POST['envio_' . $lng];
            $data['description'] = $_POST['description_' . $lng];
            $data['short_description'] = $_POST['short_description_' . $lng];
            $this->db->insert(BID_PREFIX . 'auctions_description', $data);
        }
        return $id;
    }

    public function edit($id) {
        $element = $this->getAuctions($id);
        $upload = new upload('temp/', 'my_file_upload', false);
        $img = $upload->getImg();
        $photo_id = ($img != null) ? $img['id'] : $element['photo_id'];
        $data = array(
            //'minimum_bid' => $_POST['minimum_bid'],
            //'increment' => $increment,
            //'buy_now' => $buynow,
            //'starts' => $starts,
            //'ends' => $ends,
            'donated' => $_POST['donated'],
            'for' => $_POST['for'],
            'price' => $_POST['price'],
            'featured' => $_POST['featured'],
            'visibility' => $_POST['visibility'],
            'photo_id' => $photo_id,
            'updated_at' => $this->getTimeSQL(),
        );
        $this->db->update(BID_PREFIX . 'auctions', $data, "`id` = '{$id}'");
        unset($data);
        $data['auction_id'] = $id;
        foreach ($this->_langs as $lng) {
            $data['language_id'] = $lng;
            $data['name'] = $_POST['name_' . $lng];
            $data['subtitle'] = $_POST['subtitle_' . $lng];
            $data['legal'] = $_POST['legal_' . $lng];
            $data['envio'] = $_POST['envio_' . $lng];
            $data['description'] = $_POST['description_' . $lng];
            $data['short_description'] = $_POST['short_description_' . $lng];
            $exist = $this->db->select("SELECT * FROM " . BID_PREFIX . "auctions_description WHERE auction_id=" . $id . " AND `language_id`='" . $lng . "'");
            if (sizeof($exist))
                $this->db->update(BID_PREFIX . 'auctions_description', $data, "`auction_id` = '{$id}' AND `language_id` = '{$lng}'");
            else
                $this->db->insert(BID_PREFIX . 'auctions_description', $data);
        }
    }

    public function delete($id) {
        $this->db->delete(BID_PREFIX . 'auctions', "`id` = {$id}");
        $this->db->delete(BID_PREFIX . 'auctions_description', "`sauction_id` = {$id}");
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

}
