<?php

class Page_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function contactForm() {
        $user = $this->getUser();
        $action = (!$user) ? URL . LANG . '/user/create' : URL . '/user/edit';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('contact', 'POST', $action, $atributes);
        switch (LANG){
            case 'es': $form->language('espanol');break;
        }
        $form->add('hidden', 'accounttype', 'user');
        $form->add('label', 'label_name', 'name', $this->lang['first_name'] . ':');
        $obj = $form->add('text', 'name', $user['name'], array('autocomplete' => 'off', 'placeholder' => $this->lang['first_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['first_name'] . ' ' . $this->lang['is required'] . '!'),
        ));


        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', $user['email'], array('autocomplete' => 'off', 'placeholder' => $this->lang['correo_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));


        $form->add('label', 'label_subject', 'subject', $this->lang['Subject']);
        $obj = $form->add('select', 'subject', '', array('other' => true));
        $obj->add_options(array(
            $this->lang['about_auction'],
            $this->lang['web_problem']
        ));
$obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="#">' . $this->lang['Acuerdo de usuario'] . '</a>',
        ));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['please_accept']),
        ));
        $form->add('label', 'label_message', 'message', $this->lang['Mensaje']);
        
        $obj = $form->add('textarea', 'message','', array('autocomplete' => 'off', 'placeholder' => $this->lang['contact_message_box']));
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
        $action =URL . LANG . '/page/dodonation';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('contact', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'accounttype', 'user');
        $form->add('label', 'label_deseo', 'deseo', $this->lang['donacion_para'] . ':');
        $obj = $form->add('textarea', 'deseo', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['donacion_porque']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['este_campo'] . ' ' . $this->lang['is required'] . '!'),
        ));
        
        foreach($this->getColaborators(3) as $aux){
            $ong[$aux['id']]=$aux['name'];
        }
        $form->add('label', 'label_ong', 'ong', $this->lang['elige_ong']);
        $obj = $form->add('select', 'ong', '', array('other' => true));
        $obj->add_options($ong,true);
        
        
        $form->add('label', 'label_donacion', 'donacion', $this->lang['importe_donar'] . ':');
        $obj = $form->add('text', 'donacion', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['escribe_cantidad']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['donacion'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_nombre', 'nombre', $this->lang['nombre_apellido'] . ':');
        $obj = $form->add('text', 'nombre', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['nombre_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['nombre_apellido'] . ' ' . $this->lang['is required'] . '!'),
        ));
        
        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['correo_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));


        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="#">' . $this->lang['Acuerdo de usuario'] . '</a>',
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
        $action =URL . LANG . '/page/dogift';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('contact', 'POST', $action, $atributes);
        switch (LANG) {
            case 'es': $form->language('espanol');
                break;
        }
        $form->add('hidden', 'accounttype', 'user');
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

        $form->add('label', 'label_nombre', 'nombre', $this->lang['nombre_apellido'] . ':');
        $obj = $form->add('text', 'nombre', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['nombre_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['nombre_apellido'] . ' ' . $this->lang['is required'] . '!'),
        ));
        
        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', $user['email'], array('autocomplete' => 'off', 'placeholder' => $this->lang['correo_para_responder']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));


        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="#">' . $this->lang['Acuerdo de usuario'] . '</a>',
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
            return $this->db->select("SELECT * FROM donantes d JOIN donantes_description dd on dd.donantes_id=d.id WHERE  language_id=:lang AND type=:type", array('type' => $type,'lang' => $lang));
        
    }

}
