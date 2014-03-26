<?php

class Login extends Model {

    public $_idmodel;
    public $_model;

    public function __construct() {
        parent::__construct();
        $this->loadLang();
    }

    public function signupForm() {
        $action = (!$user) ? URL . LANG . '/user/create' : URL . '/user/edit';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('signup', 'POST', $action, $atributes);
        $form->add('hidden', 'accounttype', 'user');
        $form->add('label', 'label_firstname', 'firstname', $this->lang['first_name']);
        $obj = $form->add('text', 'firstname', $user['first_name'], array('autocomplete' => 'off', 'placeholder' => $this->lang['first_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['first_name'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_lastname', 'lastname', $this->lang['last_name']);
        $obj = $form->add('text', 'lastname', $user['last_name'], array('autocomplete' => 'off', 'placeholder' => $this->lang['last_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['last_name'] . ' ' . $this->lang['is required'] . '!'),
        ));
        $form->add('label', 'label_email', 'email', $this->lang['Email address']);
        $obj = $form->add('text', 'email', $user['email'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Email address']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['Email address'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));
        $form->add('label', 'label_nick', 'nick', $this->lang['user_name'].' ('.$this->lang['solo_cambia_once'].')');
        $obj = $form->add('text', 'nick', $user['nick'], array('autocomplete' => 'off', 'placeholder' => $this->lang['user_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['user_name'] . ' ' . $this->lang['is required'] . '!'),
            'length' => array(6, 20, 'error', $this->lang['user_length'])
        ));
        
        $rule['required'] = array('error', $this->lang['password'] . ' is required!');
        $rule['length'] = array(6, 10, 'error', $this->lang['password_length']);
        $form->add('label', 'label_user_password', 'user_password', $this->lang['chose password']);
        $obj = $form->add('password', 'user_password', '', array('placeholder' => $this->lang['min 6 chars']));
        $obj->set_rule($rule);

        // "confirm password"
        $form->add('label', 'label_confirm_password', 'confirm_password', $this->lang['confirm password']);
        $obj = $form->add('password', 'confirm_password', '', array('autocomplete' => 'off'));
        $obj->set_rule(array(
            'compare' => array('user_password', 'error', $this->lang['password not confirmed'])
        ));
        $obj = $form->add('checkboxes', 'extra[]', array(
            'acuerdo' => $this->lang['leido_acepto'] . ' <a href="#">' . $this->lang['Acuerdo de usuario'] . '</a>',
            'noticias' => $this->lang['recibir_noticias'],
        ));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['please_accept']),
        ));

        $form->add('submit', '_btnsubmit', (!$user) ? $this->lang['register'] : $this->lang['save']);

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

   

     public function loginForm() {
        $action = URL . 'user/login';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('login-form', 'POST', $action, $atributes);
        $form->add('hidden', 'accounttype', 'user');

        $form->add('label', 'label_email', 'email', $this->lang['direccion_email']);
        $obj = $form->add('text', 'email', '');
        $obj->set_rule(array(
            'email' => array('error', $this->lang['email_valid']),
            'required' => array('error', $this->lang['email'] . ' ' . $this->lang['is required'] . '!'),
        ));
        $form->add('label', 'label_password', 'password', $this->lang['password']);
        $obj = $form->add('password', 'password', '');
        $obj->set_rule(array(
            'required' => array('error', $this->lang['password'] . ' ' . $this->lang['is required'] . '!'),
            'length' => array(6, 10, 'error', $this->lang['password_length']),
        ));

        $form->add('submit', '_btnsubmitLogin', $this->lang['entrar']);
        $form->validate();
        return $form;
    }

  
    public function loadLang($name = null) {
        $langPath = 'lang/' . LANG . '/';
        require $langPath . 'default.php';
        $path = $langPath . $name . '.php';
        if (file_exists($path)) {
            require $path;
        }
        $this->lang = $lang;
    }

}
