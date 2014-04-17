<?php

class Users_Model extends Model {

    public $pag;

    public function __construct() {
        parent::__construct();
    }

    public function usersForm($id = null) {
        $action = ($id == null) ? URL . 'users/create' : URL . 'users/edit/' . $id;
        if ($id != null)
            $users = $this->getUsers($id);
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('addUser', 'POST', $action, $atributes);

        $form->add('hidden', '_add', 'contacts');
        $form->add('label', 'label_first_name', 'first_name', 'First name');
        $form->add('text', 'first_name', $users['first_name'], array('autocomplete' => 'off'));

        $form->add('label', 'label_last_name', 'last_name', 'Last name');
        $form->add('text', 'last_name', $users['last_name'], array('autocomplete' => 'off'));

        $form->add('label', 'label_email', 'email', 'Mail');
        $obj = $form->add('text', 'email', $users['email'], array('autocomplete' => 'off'));


        $form->add('label', 'label_nick', 'nick', 'Nick');
        $obj = $form->add('text', 'nick', $users['nick']);

        $form->add('label', 'label_phone', 'phone', 'Phone');
        $obj = $form->add('text', 'phone', $users['email']);

        $form->add('label', 'label_add_street', 'add_street', 'Address');
        $obj = $form->add('text', 'add_street', $users['add_street']);

        $form->add('label', 'label_add_number', 'add_number', 'Numero');
        $obj = $form->add('text', 'add_number', $users['add_number']);

        $form->add('label', 'label_add_flat', 'add_flat', 'Piso');
        $obj = $form->add('text', 'add_flat', $users['add_flat']);

        $form->add('label', 'label_add_door', 'add_door', 'Door');
        $obj = $form->add('text', 'add_door', $users['add_door']);

        $form->add('label', 'label_add_stairs', 'add_stairs', 'Stairs');
        $obj = $form->add('text', 'add_stairs', $users['add_stairs']);

        $form->add('label', 'label_add_city', 'add_city', 'City');
        $obj = $form->add('text', 'add_city', $users['add_city']);

        $form->add('label', 'label_zip', 'zip', 'ZIP');
        $obj = $form->add('text', 'zip', $users['zip']);


        $form->add('label', 'label_password', 'password', 'Choose a password');
        $obj = $form->add('password', 'password');

        if ($type == 'add') {
            $obj->set_rule(array(
                'required' => array('error', 'Password is required!'),
                'length' => array(6, 20, 'error', 'The password must have between 6 and 10 characters'),
            ));
        } else {
            $obj->set_rule(array(
                'length' => array(4, 20, 'error', 'The password must have between 4 and 10 characters'),
            ));
        }
        $form->add('note', 'note_password', 'password', 'Password must be have between 6 and 10 characters.');
        $form->add('label', 'label_confirm_password', 'confirm_password', 'Confirm password');
        $obj = $form->add('password', 'confirm_password');
        $obj->set_rule(array(
            'compare' => array('password', 'error', 'Password not confirmed correctly!')
        ));

        $form->add('label', 'label_is_active', 'is_active', 'State:');
        $form->add('checkboxes', 'is_active', array(
            '1' => 'Active',
                ), $users['is_active']);

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }

    public function getUsers($id = null, $orderBy = null) {
        if (!$id)
            return $this->db->select("SELECT * FROM " . BID_PREFIX . "users ORDER BY " . $orderBy);
        return $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "users WHERE id=:id", array('id' => $id));
    }

    public function usersToTable($lista, $order) {
        $order = explode(' ', $order);
        $orden = (strtolower($order[1]) == 'desc') ? ' ASC' : ' DESC';
        $b['sort'] = true;
        $b['title'] = array(
            array(
                "title" => "Id",
                "link" => URL . LANG . '/users/lista/' . $this->pag . '/id' . $orden,
                "width" => "auto"
            ), array(
                "title" => "Nick",
                "link" => URL . LANG . '/users/lista/' . $this->pag . '/nick' . $orden,
                "width" => "auto"
            ), array(
                "title" => "name",
                "link" => URL . LANG . '/users/lista/' . $this->pag . '/first_name' . $orden,
                "width" => "auto"
            ), array(
                "title" => "Email",
                "link" => URL . LANG . '/users/lista/' . $this->pag . '/email' . $orden,
                "width" => "auto"
            ), array(
                "title" => "Options",
                "link" => "#",
                "width" => "auto"
        ));
        foreach ($lista as $key => $value) {
            $b['values'][] = array(
                "id" => $value['id'],
                "nick" => $value['nick'],
                "name" => $value['first_name'] . ' ' . $value['last_name'],
                "email" => $value['email'],
                "Options" => '<a href="' . URL . 'users/view/' . $value['id'] . '"><button title="Edit" type="button" class="edit"></button></a>'
            );
        }
        return $b;
    }

    public function create() {
        $data = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'role' => $_POST['role']
        );
        if (isset($_POST['password']) && $_POST['password'] != '')
            $data['password'] = Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY);
        return $this->db->insert('users', $data);
    }

    public function edit($id) {
        $status = ($_POST['state'] = 1) ? 'active' : 'passive';
        $data = array(
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'nick' => $_POST['nick'],
            'phone' => $_POST['phone'],
            'add_street' => $_POST['add_street'],
            'add_number' => $_POST['add_number'],
            'add_flat' => $_POST['add_flat'],
            'add_door' => $_POST['add_door'],
            'add_stairs' => $_POST['add_stairs'],
            'add_city' => $_POST['add_city'],
            'zip' => $_POST['zip'],
            'email' => $_POST['email'],
            'is_active' => $_POST['is_active'],
        );
        if (isset($_POST['password']) && $_POST['password'] != '')
            $data['password'] = md5($_POST['password']);
        $this->db->update(BID_PREFIX.'users', $data, "`id` = '{$id}'");
    }

    public function delete($id) {
        $this->db->delete(BID_PREFIX.'users', "`id` = {$id}");
    }
    public function getReport($id = null,$orderBy,$lang=LANG) {
        $this->_id=$id;
        return $this->db->select('SELECT * FROM ' . BID_PREFIX . 'bids a JOIN ' . BID_PREFIX . 'auctions_description b ON b.auction_id=a.auction JOIN ' . BID_PREFIX . 'users c ON c.id=a.bidder WHERE a.bidder=:id AND b.language_id=:lang ORDER BY auction,bidwhen', array('id' => $id,'lang'=>$lang));
    }
    public function reporttoTable($lista,$orderBy) {
        $order=  explode(' ', $orderBy);
        $orden=(strtolower($order[1])=='desc')?' ASC':' DESC';
        $b['sort'] = false;
        $b['title'] = array(
            array(
                "title" => "auction",
                "width" => "auto"
            ), array(
                "title" => "bid",
                "width" => "auto"
            ), array(
                "title" => "time",
                "width" => "auto"
        ));
        foreach ($lista as $key => $value) {
            $b['values'][] = array(
                "auction" => $value['name'],
                "bid" => $value['bid'],
                "time" =>  date('d-m-Y, H:i:s',$value['bidwhen'])
            );
        }
        return $b;
    }

}
