<?php

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $sth = $this->db->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE 
                user_name = :user_name AND password = :password");
        $sth->execute(array(
            ':user_name' => $_POST['login'],
            ':password' => md5(HASH_GENERAL_KEY . $_POST['password'])
            
        ));
        $data = $sth->fetch();
        $count =  $sth->rowCount();
        if ($count > 0) {
            // login
            Session::init();
            Session::set('account_type', $data['account_type']);
            Session::set('loggedIn', true);
            Session::set('userid', $data['id']);
            Session::set('WEBID_LOGGED_IN',$data['id']);
            Session::set('WEBID_LOGGED_NUMBER',strspn( md5(HASH_GENERAL_KEY . $_POST['password']), $data['hash']));
            Session::set('WEBID_LOGGED_PASS',md5(HASH_GENERAL_KEY . $_POST['password']));
            header('location: '.URL.'pages/lista');
        } else {
            header('location: '.URL);
        }
        
    }
    public function out()
    {
        Session::set('role', '');
        Session::set('loggedIn', false);
        Session::set('userid', '');
        header('location: '.URL);
        Session::destroy();
        
    }
    
}