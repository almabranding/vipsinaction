<?php

class User_Model extends Model {

    public $_idmodel;
    public $_model;
    public $_where;
    public $_orderby;

    public function __construct() {
        parent::__construct();
        $this->_where = ' WHERE 1=1 ';
    }

    public function resetForm() {
        $action = URL . 'user/resetpassword/' . $_GET['id'];
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('resetForm', 'POST', $action, $atributes);
        $form->add('hidden', 'id', $_GET['id']);
        $form->add('hidden', 'hash', $_GET['hash']);

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
        $form->add('submit', '_btnsubmit', $this->lang['reset_password']);

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

    public function rememberForm() {
        $action = URL . 'user/remember/sent';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('remember', 'POST', $action, $atributes);

        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', '', array('autocomplete' => 'off', 'placeholder' => $this->lang['Contact e-mail']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));
        $form->add('submit', '_btnsubmit', 'Remember Password');

        if ($form->validate()) {
            show_results();
        }
        return $form;
    }

    public function userForm() {
        $userData = Session::get('user');
        $user = $this->getUserById($userData['id']);
        $action = URL . 'user/edit';
        $atributes = array(
            'enctype' => 'multipart/form-data',
        );
        $form = new Zebra_Form('userForm', 'POST', $action, $atributes);

        $form->add('hidden', 'user_id', $user['id']);
        $form->add('hidden', 'accounttype', 'user');
        $form->add('label', 'label_firstname', 'firstname', $this->lang['first_name'] . ':');
        $obj = $form->add('text', 'firstname', $user['first_name'], array('autocomplete' => 'off', 'placeholder' => $this->lang['first_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['first_name'] . ' ' . $this->lang['is required'] . '!'),
        ));

        $form->add('label', 'label_lastname', 'lastname', $this->lang['last_name'] . ':');
        $obj = $form->add('text', 'lastname', $user['last_name'], array('autocomplete' => 'off', 'placeholder' => $this->lang['last_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['last_name'] . ' ' . $this->lang['is required'] . '!'),
        ));
        $form->add('label', 'label_phone', 'phone', $this->lang['phone'] . ':');
        $obj = $form->add('text', 'phone', $user['phone'], array('autocomplete' => 'off', 'placeholder' => $this->lang['phone']));

        $form->add('label', 'label_email', 'email', $this->lang['direccion_email'] . ':');
        $obj = $form->add('text', 'email', $user['email'], array('autocomplete' => 'off', 'placeholder' => $this->lang['Contact e-mail']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['direccion_email'] . ' ' . $this->lang['is required'] . '!'),
            'email' => array('error', $this->lang['email_valid']),
        ));
        $solo1 = ($user['nick_changed'] == 0) ? ' (' . $this->lang['solo_cambia_once'] . ')' : '';
        $form->add('label', 'label_nick', 'nick', $this->lang['user_name'] . $solo1 . ':');
        $obj = $form->add('text', 'nick', ($user['nick_changed'] != 0) ? $user['nick'] : '', array('autocomplete' => 'off', 'placeholder' => $this->lang['user_name']));
        $obj->set_rule(array(
            'required' => array('error', $this->lang['user_name'] . ' ' . $this->lang['is required'] . '!'),
            'length' => array(4, 30, 'error', $this->lang['user_length'])
        ));
        if ($user['nick_changed'] != 0) {
            $obj->set_attributes(array(
                'readonly' => 'readonly',
            ));
        }
        $rule['length'] = array(6, 10, 'error', $this->lang['password_length']);
        $form->add('label', 'label_user_password', 'user_password', $this->lang['chose password'] . ':');
        $obj = $form->add('password', 'user_password', '');
        $obj->set_rule($rule);

        // "confirm password"
        $form->add('label', 'label_confirm_password', 'confirm_password', $this->lang['repeat_chose_new_password'] . ':');
        $obj = $form->add('password', 'confirm_password', '', array('autocomplete' => 'off'));
        $obj->set_rule(array(
            'compare' => array('user_password', 'error', $this->lang['password not confirmed'])
        ));
        $form->add('label', 'label_add_street', 'add_street', $this->lang['Street'] . ':');
        $obj = $form->add('text', 'add_street', $user['add_street'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_add_number', 'add_number', $this->lang['Number'] . ':');
        $obj = $form->add('text', 'add_number', $user['add_number'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_add_flat', 'add_flat', $this->lang['Piso'] . ':');
        $obj = $form->add('text', 'add_flat', $user['add_flat'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_add_door', 'add_door', $this->lang['Puerta'] . ':');
        $obj = $form->add('text', 'add_door', $user['add_door'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_add_stairs', 'add_stairs', $this->lang['Escalera'] . ':');
        $obj = $form->add('text', 'add_stairs', $user['add_stairs'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_add_zip', 'add_zip', $this->lang['zip_code'] . ':');
        $obj = $form->add('text', 'add_zip', $user['add_zip'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_add_city', 'add_city', $this->lang['City'] . ':');
        $obj = $form->add('text', 'add_city', $user['add_city'], array('autocomplete' => 'off', 'placeholder' => ''));


        $obj = $form->add('checkboxes', 'bill', array(
            '1' => $this->lang['bill_address_change'],
                ), $user['bill']);

        $form->add('label', 'label_bill_street', 'bill_street', $this->lang['Street'] . ':');
        $obj = $form->add('text', 'bill_street', $user['bill_street'], array('autocomplete' => 'off', 'placeholder' => ''));
        $obj->set_rule(array(
            'dependencies' => array(array(
                    'bill' => '1',
                )),
        ));

        $form->add('label', 'label_bill_number', 'bill_number', $this->lang['Number'] . ':');
        $obj = $form->add('text', 'bill_number', $user['bill_number'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_bill_flat', 'bill_flat', $this->lang['Piso'] . ':');
        $obj = $form->add('text', 'bill_flat', $user['bill_flat'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_bill_door', 'bill_door', $this->lang['Puerta'] . ':');
        $obj = $form->add('text', 'bill_door', $user['bill_door'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_bill_stairs', 'bill_stairs', $this->lang['Escalera'] . ':');
        $obj = $form->add('text', 'bill_stairs', $user['bill_stairs'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_bill_zip', 'bill_zip', $this->lang['zip_code'] . ':');
        $obj = $form->add('text', 'bill_zip', $user['bill_zip'], array('autocomplete' => 'off', 'placeholder' => ''));

        $form->add('label', 'label_bill_city', 'bill_city', $this->lang['City'] . ':');
        $obj = $form->add('text', 'bill_city', $user['bill_city'], array('autocomplete' => 'off', 'placeholder' => ''));


        $obj = $form->add('checkboxes', 'news', array(
            '1' => $this->lang['recibir_noticias'],
                ), $user['news']);

        $form->add('submit', '_btnsubmit', $this->lang['save']);

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

        $form->add('submit', '_btnsubmit', $this->lang['entrar']);
        $form->validate();
        return $form;
    }

    public function create($mail = true) {
        $isMail = $this->db->selectOne('SELECT id FROM ' . BID_PREFIX . 'users WHERE id!=:id AND email=:email', array('id' => $user['id'], 'email' => $_POST['email']));
        $isNick = $this->db->selectOne('SELECT id FROM ' . BID_PREFIX . 'users WHERE id!=:id AND nick=:nick', array('id' => $user['id'], 'nick' => $_POST['nick']));
        if ($isMail)
            return 1;
        if ($isNick)
            return 2;
        $data = array(
            'first_name' => $_POST['firstname'],
            'last_name' => $_POST['lastname'],
            'email' => $_POST['email'],
            'nick' => $_POST['nick'],
            'news' => $_POST['news'],
            'nick_changed' => 1,
            'date_created' => $this->getTimeSQL(),
            'date_updated' => $this->getTimeSQL(),
        );

        if (isset($_POST['user_password']) && $_POST['user_password'] != '')
            $data['password'] = md5($_POST['user_password']);
        else
            $data['password'] = rand();
        $userId = $this->db->insert(BID_PREFIX . 'users', $data);

        if ($mail)
            $this->sendConfirmationMail($userId);
        return $userId;
    }

    public function sendChangePasswordMail() {
        $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE email=:mail', array('mail' => $_POST['email']));
        $mail = new MailHelper();
        $mail->getChangePasswordMail($user);
    }

    public function controlMail() {
        $user = $this->getUserById($_POST['id']);
        if (isset($_POST['id']) && isset($_POST['hash'])) {
            $id = $_POST['id'];
            $hash = $_POST['hash'];
        } else if (isset($_GET['id']) && isset($_GET['hash'])) {
            $id = $_GET['id'];
            $hash = $_GET['hash'];
        }
        if (Hash::create('sha256', $id, HASH_PASSWORD_KEY) == $hash)
            return true;
        return false;
    }

    public function sendConfirmationMail($id) {
        $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE id=' . $id);
        $mail = new MailHelper();
        $mail->getConfirmationMail($user);
    }

    public function activate($id, $hash) {
        $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE id=' . $id);
        if ($hash == Hash::create('sha256', $user['id'], HASH_PASSWORD_KEY)) {
            $data = array('is_active' => 1,);
            $this->db->update(BID_PREFIX . 'users', $data, "`id` = '{$id}'");
            $user['is_active'] = 1;
            Session::set('is_active', true);
            Session::set('loggedIn', true);
            Session::set('user', $user);
        } else {

            $this->logout();
        }
        return true;
    }

    public function reset() {
        if (isset($_POST['user_password']) && $_POST['user_password'] != '')
            $data['password'] = md5($_POST['user_password']);
        return $this->db->update(BID_PREFIX . 'users', $data, "`id` = '{$_POST['id']}'");
    }

    public function edit() {
        $user = $this->getUserById($_POST['user_id']);
        $isMail = $this->db->selectOne('SELECT id FROM ' . BID_PREFIX . 'users WHERE id!=:id AND email=:email', array('id' => $user['id'], 'email' => $_POST['email']));
        $isNick = $this->db->selectOne('SELECT id FROM ' . BID_PREFIX . 'users WHERE id!=:id AND nick=:nick', array('id' => $user['id'], 'nick' => $_POST['nick']));

        if ($isMail)
            return 1;
        if ($isNick)
            return 2;
        $upload = new upload('temp/', 'user-file', false);
        $img = $upload->getImg();
        $photo_id = ($img != null) ? $img['id'] : $user['photo_id'];
        $data = array(
            'first_name' => $_POST['firstname'],
            'last_name' => $_POST['lastname'],
            'email' => $_POST['email'],
            'nick' => $_POST['nick'],
            'phone' => $_POST['phone'],
            'photo_id' => $photo_id,
            'add_street' => $_POST['add_street'],
            'add_number' => $_POST['add_number'],
            'add_flat' => $_POST['add_flat'],
            'add_door' => $_POST['add_door'],
            'add_stairs' => $_POST['add_stairs'],
            'add_zip' => $_POST['add_zip'],
            'add_city' => $_POST['add_city'],
            'bill' => $_POST['bill'],
            'bill_street' => $_POST['bill_street'],
            'bill_number' => $_POST['bill_number'],
            'bill_flat' => $_POST['bill_flat'],
            'bill_door' => $_POST['bill_door'],
            'bill_stairs' => $_POST['bill_stairs'],
            'bill_zip' => $_POST['bill_zip'],
            'bill_city' => $_POST['bill_city'],
            'bill_city' => $_POST['bill_city'],
            'news' => $_POST['news'],
            'nick_changed' => 1,
            'is_active' => ($user['email'] != $_POST['email']) ? '0' : '1',
            'date_updated' => $this->getTimeSQL(),
        );
        if (isset($_POST['user_password']) && $_POST['user_password'] != '')
            $data['password'] = md5($_POST['user_password']);
        $this->db->update(BID_PREFIX . 'users', $data, "`id` = '{$_POST['user_id']}'");
        $user = $this->getUserById($_POST['user_id']);
        if ($user) {
            Session::set('user', $user);
        } else
            $this->logout();
        if ($data['is_active'] == 0) {
            $this->sendConfirmationMail($_POST['user_id']);
            $this->logout();
            return 1;
        }
        return 0;
    }

    public function delete($id) {
        $this->db->delete(BID_PREFIX . 'users', "`id` = {$id}");
    }

    public function login() {
        $user = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "users WHERE email = :email AND password = :password", array(':email' => $_POST['email'], ':password' => md5($_POST['password'])));
        $user['img'] = $this->db->selectOne("SELECT * FROM photos WHERE id = :photo", array(':photo' => $user['photo_id']));
        if (!$user) {
            return 1;
        } else {
            Session::set('user', $user);
            Session::set('loggedIn', true);
            Session::set('is_active', true);
            if ($user['is_active'] == 0) {
                Session::set('is_active', false);
                return 2;
            }
            return 0;
        }
    }

    public function logout() {
        Session::set('user', '');
        Session::set('loggedIn', false);
        Session::set('is_active', false);
        Session::destroy();
        header('location: ' . URL);
    }

    public function getUser($nick = null) {
        if (Session::get('loggedIn') && $nick == null) {
            return Session::get('user');
        } else {
            return $this->db->selectOne('SELECT *,u.id as id FROM ' . BID_PREFIX . 'users u JOIN photos p ON p.id=u.photo_id   WHERE nick=:nick AND is_active=1', array('nick' => $nick));
        }
        return false;
    }

    public function getUserById($id = null, $is_active = false) {
        if (!$is_active) {
            return $this->db->selectOne('SELECT u.*,p.img_date,p.file_name FROM ' . BID_PREFIX . 'users u JOIN photos p ON p.id=u.photo_id WHERE u.id=:id', array('id' => $id));
        }
        if ($is_active) {
            return $this->db->selectOne('SELECT u.*,p.img_date,p.file_name FROM ' . BID_PREFIX . 'users u JOIN photos p ON p.id=u.photo_id WHERE u.id=:id AND is_active=:is_active', array('id' => $id, 'is_active' => $is_active));
        }
    }

    public function fbRegister() {
        $code = $_GET['code'];
        Session::set('fb_code', $code);
        $token_url = "https://graph.facebook.com/oauth/access_token?"
                . "client_id=" . APP_ID . "&redirect_uri=" . urlencode(APP_REDIRECT)
                . "&client_secret=" . APP_SECRET . "&code=" . $code . "&scope=publish_stream,email,user_about_me";

        $response = @file_get_contents($token_url);
        $params = null;
        parse_str($response, $params);
        Session::set('fb_token', $params['access_token']);
        $graph_url = "https://graph.facebook.com/me?access_token=" . $params['access_token'];
        $user_info = json_decode(@file_get_contents($graph_url));
        $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE facebook_id=:id', array('id' => $user_info->id));
        $nick = ($user_info->username != '') ? $user_info->username : $user_info->id;

        if (!$user && $params) {
            $data = array(
                'first_name' => $user_info->first_name,
                'last_name' => $user_info->last_name,
                'email' => $user_info->email,
                'nick' => $nick,
                'account_type' => 'customer',
                'facebook_id' => $user_info->id,
                'date_created' => $this->getTimeSQL(),
                'date_updated' => $this->getTimeSQL(),
                'is_active' => 1,
            );
            $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE email=:email', array('email' => $user_info->email));
            if ($user) {
                unset($data);
                $data = array(
                    'nick' => $nick,
                    'facebook_id' => $user_info->id,
                    'date_updated' => $this->getTimeSQL(),
                    'is_active' => 1,
                );
                $this->db->update(BID_PREFIX . 'users', $data, "`id` = '{$user['id']}'");
            } else {
                $userId = $this->db->insert(BID_PREFIX . 'users', $data);
            }
            $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE facebook_id=:facebook_id', array('facebook_id' => $user_info->id));
        }
        if ($user && $params) {
            Session::set('user', $user);
            Session::set('loggedIn', true);
        } else {
            $this->logout();
        }
        return $user;
    }

    public function checkRegister() {
        $id = (isset($_GET['user_id'])) ? $_GET['user_id'] : 0;
        $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE email=:email AND id!=:id', array('email' => $_GET['email'], 'id' => $id));
        if ($user)
            $error[] = 1;
        $user = $this->db->selectOne('SELECT * FROM ' . BID_PREFIX . 'users WHERE nick=:nick  AND id!=:id', array('nick' => $_GET['nick'], 'id' => $id));
        if ($user)
            $error[] = 2;
        echo json_encode($error);
    }

    public function getFavorites($lang = LANG) {
        $bid = $this->db->select("SELECT * FROM " . BID_PREFIX . "auctions a  JOIN photos p ON p.id=a.photo_id JOIN " . BID_PREFIX . "auctions_description ad on ad.auction_id=a.id JOIN " . BID_PREFIX . "favorites f ON f.auction_id=a.id $this->_where AND f.user_id=:user_id and ad.language_id=:lang $this->_orderby", array('user_id' => $this->user['id'], 'lang' => $lang));
        foreach ($bid as $key => $value) {
            $max = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "proxybid WHERE itemid=:itemid ORDER BY bid DESC", array('itemid' => $value['auction_id']));
            $bid[$key]['Mybids'] = $this->Mybids($value);
            $bid[$key]['max_bidder'] = $max['userid'];
        }
        return $bid;
    }

    public function Mybids($auction) {
        $user = Session::get('user');
        $bids = $this->db->select("SELECT * FROM " . BID_PREFIX . "bids b JOIN " . BID_PREFIX . "users u ON u.id=b.bidder WHERE auction=:id AND u.id=:user ORDER BY bid DESC, b.id DESC", array('id' => $auction['auction_id'], 'user' => $user['id']));
        return ($bids) ? true : false;
    }

    public function getBids() {
        $bid = $this->db->select("SELECT *,max(b.bid) as maxbid,u.id as user_id FROM " . BID_PREFIX . "bids b JOIN " . BID_PREFIX . "users u ON u.id=b.bidder JOIN " . BID_PREFIX . "auctions a on a.id=b.auction JOIN photos p ON p.id=a.photo_id JOIN " . BID_PREFIX . "auctions_description ad on ad.auction_id=a.id WHERE u.id=:user_id GROUP BY b.auction $this->_orderby", array('user_id' => $this->user['id']));
        foreach ($bid as $key => $value) {
            $max = $this->db->selectOne("SELECT * FROM " . BID_PREFIX . "proxybid WHERE itemid=:itemid ORDER BY bid DESC", array('itemid' => $value['auction_id']));
            $bid[$key]['max_bidder'] = $max['userid'];
            $bid[$key]['Mybids'] = $this->Mybids($value);
        }
        return $bid;
    }

    public function addNewsletter() {
        $data = array(
            'email' => $_POST['email'],
            'updated_at' => $this->getTimeSQL(),
            'created_at' => $this->getTimeSQL(),
        );
        $mail = $this->db->selectOne("SELECT * FROM " . DB_PREFIX . "newsletter WHERE email=:email", array('email' => $_POST['email']));
        if ($mail)
            throw new Exception($this->lang['mail_ya_existe']);
        $id = $this->db->insert(DB_PREFIX . 'newsletter', $data);
        if (!$id)
            throw new Exception($this->lang['algun_error']);
        return $id;
    }

}
