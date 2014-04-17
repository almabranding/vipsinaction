<?php

class Page_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function contactForm() {
        if (Session::get('loggedIn'))
            $user = Session::get('user');
        $action = URL . 'page/view/sendcontact';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('contactForm', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'contact', '1');
        $form->add('label', 'label_name', 'name', $this->lang['first_name'] . ':');
        $obj = $form->add('text', 'name', ($user) ? $user['first_name'] . ' ' . $user['second_name'] : '', array('autocomplete' => 'off', 'placeholder' => $this->lang['first_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['first_name'] . ' ' . $this->lang['is required'] . '!'),
        ));


        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', ($user) ? $user['email'] : '', array('autocomplete' => 'off', 'placeholder' => $this->lang['correo_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));


        $form->add('label', 'label_subject', 'subject', $this->lang['Subject']);
        $obj = $form->add('select', 'subject', '', array('other' => true));
        $obj->add_options(array(
            $this->lang['about_auction'] => $this->lang['about_auction'],
            $this->lang['web_problem'] => $this->lang['web_problem']
        ));
        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="' . URL . 'terms" target="_blank">' . $this->lang['Acuerdo de usuario'] . '</a>',
        ));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['please_accept']),
        ));
        $form->add('label', 'label_message', 'message', $this->lang['Mensaje']);

        $obj = $form->add('textarea', 'message', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['contact_message_box']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['Mensaje'] . ' ' . $this->lang['is required'] . '!'),
        ));
        $form->add('submit', '_btnsubmit', $this->lang['enviar']);

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

    public function donationForm() {
        if (Session::get('loggedIn'))
            $user = Session::get('user');
        $action = URL . 'page/preparecrowdfunding';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('crowdfoundingForm', 'GET', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'crowdfounding', '1');
        $form->add('label', 'label_deseo', 'deseo', $this->lang['donacion_para'] . ':');
        $obj = $form->add('textarea', 'deseo', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['donacion_porque']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['este_campo'] . ' ' . $this->lang['is required'] . '!'),
        ));

        foreach ($this->getColaborators(3) as $aux) {
            $ong[$aux['name']] = $aux['name'];
        }
        $form->add('label', 'label_ong', 'ong', $this->lang['elige_ong']);
        $obj = $form->add('select', 'ong', '', array('other' => true));
        $obj->add_options($ong, true);


        $form->add('label', 'label_donacion', 'donacion', $this->lang['importe_donar'] . ':');
        $obj = $form->add('text', 'donacion', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['escribe_cantidad']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['donacion'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_name', 'name', $this->lang['nombre_apellido'] . ':');
        $obj = $form->add('text', 'name', ($user) ? $user['first_name'] . ' ' . $user['second_name'] : '', array('autocomplete' => 'off', 'placeholder' => $this->lang['nombre_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['nombre_apellido'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', ($user) ? $user['email'] : '', array('autocomplete' => 'off', 'placeholder' => $this->lang['correo_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));


        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="' . URL . 'terms" target="_blank">' . $this->lang['Acuerdo de usuario'] . '</a>',
        ));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['please_accept']),
        ));

        $form->add('submit', '_btnsubmit', $this->lang['enviar']);

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

    public function giftForm() {
        if (Session::get('loggedIn'))
            $user = Session::get('user');
        $action = URL . 'page/view/dogift';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('giftForm', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'gift', '1');
        $form->add('label', 'label_deseo', 'deseo', $this->lang['gustaria_hacer'] . ':');
        $obj = $form->add('textarea', 'deseo', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['explica_deseo']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['first_name'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_donacion', 'donacion', $this->lang['cuanto_donar'] . ':');
        $obj = $form->add('text', 'donacion', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['escribe_cantidad']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['donacion'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_name', 'name', $this->lang['nombre_apellido'] . ':');
        $obj = $form->add('text', 'name', ($user) ? $user['first_name'] . ' ' . $user['second_name'] : '', array('autocomplete' => 'off', 'placeholder' => $this->lang['nombre_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['nombre_apellido'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', ($user) ? $user['email'] : '', array('autocomplete' => 'off', 'placeholder' => $this->lang['correo_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));


        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="' . URL . 'terms" target="_blank">' . $this->lang['Acuerdo de usuario'] . '</a>',
        ));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['please_accept']),
        ));

        $form->add('submit', '_btnsubmit', $this->lang['enviar']);

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

    public function sendGift() {
        if ($_POST['gift']) {
            $data = array(
                'donacion' => $_POST['donacion'],
                'deseo' => $_POST['deseo'],
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'created_at' => $this->getTimeSQL(),
                'updated_at' => $this->getTimeSQL()
            );
            $id = $this->db->insert('gift', $data);
        }
        if (!$_POST['gift'] || $id == 0)
            throw new Exception($this->lang['algun_error']);
        else {
            $data['id'] = $id;
            $mail = new MailHelper();
            $mail->sendGift($data);
        }
        return true;
    }

    public function sendCrowdfounding() {
        if ($_POST['crowdfounding']) {
            $data = array(
                'donacion' => $_POST['donacion'],
                'deseo' => $_POST['deseo'],
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'ong' => $_POST['ong'],
                'created_at' => $this->getTimeSQL(),
                'updated_at' => $this->getTimeSQL()
            );
            $id = $this->db->insert('crowdfounding', $data);
        }
        if (!$_POST['crowdfounding'] || $id == 0)
            throw new Exception($this->lang['algun_error']);
        else {
            $data['id'] = $id;
            $mail = new MailHelper();
            $mail->sendCrowdfounding($data);
        }
        return true;
    }

    public function sendContact() {
        if ($_POST['contact']) {
            $data = array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
                'created_at' => $this->getTimeSQL(),
                'updated_at' => $this->getTimeSQL()
            );
            $id = $this->db->insert('contact', $data);
        }
        if (!$_POST['contact'] || $id == 0)
            throw new Exception($this->lang['algun_error']);
        else {
            $data['id'] = $id;
            $mail = new MailHelper();
            $mail->sendContact($data);
        }
        return true;
    }

    public function getArticle($name = null, $lang = LANG) {
        if ($name == null)
            return $this->db->select("SELECT * FROM " . DB_PREFIX . "pages p JOIN " . DB_PREFIX . "pages_description pd ON pd.page_id=p.id WHERE pd.language_id=:lang", array('lang' => $lang));
        else
            return $this->db->selectOne("SELECT * FROM " . DB_PREFIX . "pages p JOIN " . DB_PREFIX . "pages_description pd ON pd.page_id=p.id WHERE pd.name LIKE :name AND pd.language_id=:lang", array('name' => $name, 'lang' => $lang));
    }

    public function getReviews($id = null, $lang = LANG) {
        if ($id == null)
            return $this->db->select("SELECT * FROM reviews d JOIN reviews_description dd on dd.review_id=d.id JOIN photos p ON p.id=d.photo_id  WHERE  language_id=:lang", array('lang' => $lang));
        else
            return $this->db->selectOne("SELECT * FROM reviews d JOIN reviews_description dd on dd.review_id=d.id WHERE d.id=:id AND language_id=:lang", array('id' => $id, 'lang' => $lang));
    }

    public function getColaborators($type, $lang = LANG) {
        return $this->db->select("SELECT * FROM donantes d JOIN donantes_description dd on dd.donantes_id=d.id WHERE  language_id=:lang AND type=:type", array('type' => $type, 'lang' => $lang));
    }

    public function crowdfundingForm() {
        $donacion = (isset($_GET['donacion'])) ? $_GET['donacion'] : null;
        $deseo = (isset($_GET['deseo'])) ? $_GET['deseo'] : null;
        $email = (isset($_GET['email'])) ? $_GET['email'] : null;
        $name = (isset($_GET['name'])) ? $_GET['name'] : null;
        $ong = (isset($_GET['ong'])) ? $_GET['ong'] : null;
        $card = (isset($_GET['card'])) ? $_GET['card'] : null;

        if (Session::get('loggedIn')) {
            $user = Session::get('user');
            $user_id = $user['id'];
            if ($card)
                $card_data = $this->getCards($user_id, $card);
        }
        $action = URL . 'page/docrowdfunding';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('confirmCrowd', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'crowdfounding', 1);
        $form->add('hidden', 'user_id', $user_id);
        $form->add('hidden', 'donacion', $donacion);
        $form->add('hidden', 'deseo', $deseo);
        $form->add('hidden', 'email', $email);
        $form->add('hidden', 'name', $name);
        $form->add('hidden', 'ong', $ong);

        $form->add('label', 'label_cardsaved', 'cardsaved', $this->lang['tarjeta_guardada'] . ':');
        $obj = $form->add('select', 'cardsaved', $card_data['id'], array('autocomplete' => 'off', 'placeholder' => $this->lang['tarjeta_guardada']));
        foreach ($this->getCards($user_id) as $card) {
            $obt[$card['id']] = $card['name'];
        }
        if ($obt)
            $obj->add_options($obt, false);
        unset($obt);

        $form->add('label', 'label_cardholder', 'cardholder', $this->lang['card_holder'] . ':');
        $obj = $form->add('text', 'cardholder', $card_data['holder'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Cardholder_fullname']));

        $obj->set_rule(array(
            'required' => array('error', $this->lang['card_holder'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_cardnumber', 'cardnumber', $this->lang['card_number'] . ':');
        $obj = $form->add('text', 'cardnumber', $card_data['number'], array('autocomplete' => 'off', 'placeholder' => $this->lang['card_number']));

        $obj->set_rule(array(
            'required' => array('error', $this->lang['card_number'] . ' ' . $this->lang['is required'] . '!'),
        ));
        $form->add('label', 'label_cardtype', 'cardtype', $this->lang['card_type'] . ':');
        $obj = $form->add('select', 'cardtype', $card_data['type'], array('autocomplete' => 'off', 'placeholder' => $this->lang['card_type']));
        $obt['visa'] = 'Visa';
        $obt['mastercard'] = 'Master Card';
        $obj->add_options($obt, true);
        unset($obt);

        $form->add('label', 'label_expire', 'expire', $this->lang['card_date'] . ':');
        $obj = $form->add('select', 'month', $card_data['month'], array('autocomplete' => 'off', 'placeholder' => $this->lang['month']));
        $obt[''] = '';
        for ($i = 1; $i <= 12; $i++) {
            $obt[$i] = $i;
        }
        $obj->add_options($obt, true);
        $obj->set_rule(array(
            'required' => array('error', $this->lang['month'] . ' ' . $this->lang['is required'] . '!'),
        ));
        unset($obt);
        $obj = $form->add('select', 'year', $card_data['year'], array('autocomplete' => 'off', 'placeholder' => $this->lang['year']));
        $obt[''] = '';
        for ($i = date('Y'); $i < date('Y') + 10; $i++) {
            $obt[$i] = $i;
        }
        $obj->add_options($obt, true);
        $obj->set_rule(array(
            'required' => array('error', $this->lang['year'] . ' ' . $this->lang['is required'] . '!'),
        ));
        unset($obt);

        $form->add('label', 'label_cvv', 'cvv', $this->lang['cvv'] . ':');
        $obj = $form->add('text', 'cvv', $card_data['cvv'], array('autocomplete' => 'off', 'placeholder' => $this->lang['cvv']));
        $obj->set_rule(array(
            'length' => array(3, 4, 'error', ''),
            'required' => array('error', 'CVV ' . $this->lang['is required'] . '!'),
        ));
        $form->add('label', 'label_card_name', 'card_name', $this->lang['nombre_tarjeta'] . ':');
        $obj = $form->add('text', 'card_name', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['nombre_tarjeta']));

        $obj = $form->add('checkboxes', 'card[]', array(
            'save_card' => $this->lang['save_card_data'],
        ));

        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="' . URL . 'terms" target="_blank">' . $this->lang['Acuerdo de usuario'] . '</a>',
        ));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['please_accept']),
        ));
        $form->add('submit', '_btnsubmit', $this->lang['confirma_crowd']);

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

    public function saveCard() {
        $data = array(
            'name' => $_POST['card_name'],
            'holder' => $_POST['cardholder'],
            'month' => $_POST['month'],
            'year' => $_POST['year'],
            'cvv' => $_POST['cvv'],
            'number' => $_POST['cardnumber'],
            'type' => $_POST['cardtype'],
            'user_id' => $_POST['user_id'],
            'date_created' => $this->getTimeSQL(),
        );
        $saved = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "cards WHERE name =:name and user_id=:id", array('name' => $_POST['card_name'], 'id' => $_POST['user_id']));
        if ($saved)
            $result = $this->db->update(BID_PREFIX . 'cards', $data, "`id` = '{$saved['id']}'");
        else
            $result = $this->db->insert(BID_PREFIX . 'cards', $data);
        if (!$result)
            throw new Exception($this->lang['algun_error']);
        return $result;
    }

    public function getCards($user_id, $card_id = null) {
        if ($card_id == null)
            return $this->db->select("SELECT * FROM " . BID_PREFIX . "cards WHERE user_id=:id ORDER BY name", array('id' => $user_id));
        else
            return $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "cards WHERE user_id=:user_id AND id=:card_id ORDER BY name", array('user_id' => $user_id, 'card_id' => $card_id));
    }

}
