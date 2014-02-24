<?php

class Page_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function contactForm() {
        $user = $this->getUser();
        $action = URL . '/page/sendcontact';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('contactForm', 'POST', $action, $atributes);
        $form->add('label', 'label_company', 'company', 'Company:');
        $form->add('text', 'company', '', array('autocomplete' => 'off', 'placeholder' => 'Company name'));

        $form->add('label', 'label_name', 'name', 'Name:');
        $form->add('text', 'name', $user['first_name'].' '.$user['last_name'], array('autocomplete' => 'off', 'placeholder' => 'Name'));

        $form->add('label', 'label_email', 'email', 'Email:');
        $form->add('text', 'email', $user['email'], array('autocomplete' => 'off', 'placeholder' => 'Contact e-mail', 'email' => array('error', 'Email address seems to be invalid!')));

        $form->add('label', 'label_phone', 'phone', 'Phone:');
        $form->add('text', 'phone', $user['phone'], array('autocomplete' => 'off', 'placeholder' => 'Contact phone'));

        $form->add('label', 'label_city', 'city', 'City:');
        $form->add('text', 'city', $user['city'], array('autocomplete' => 'off', 'placeholder' => 'City of the booker'));

        $form->add('label', 'label_country', 'country', 'Country:');
        $form->add('text', 'country', $user['country'], array('autocomplete' => 'off', 'placeholder' => 'Country of the booker'));

        $form->add('label', 'label_request', 'request', 'Please write your requests:');
        $obj = $form->add('textarea', 'request', '', array('required' => array('error', 'Message is required!')));
        
        $form->add('label', 'label_terms', 'terms_1', 'I accept the legal conditions');
        $obj = $form->add('radios', 'terms', array(
            '1' =>  '1',
        ), false,array('required' => array('error', 'Terms is required!')));

        $form->add('submit', '_btnsubmit', 'SEND');

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

}
