<?php

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $sth = $this->db->prepare("SELECT * FROM book_accounts WHERE 
                user_name = :user_name AND password = :password");
        $sth->execute(array(
            ':user_name' => $_POST['login'],
            ':password' => md5($_POST['password'])
           //':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
        ));
        $data = $sth->fetch();
        $count =  $sth->rowCount();
        if ($count > 0) {
            // login
            Session::init();
            Session::set('account_type', $data['account_type']);
            Session::set('loggedIn', true);
            Session::set('userid', $data['id']);
            $_SESSION[INSTALLATION_KEY]['session_preferred_language'] = $data['preferred_language'];
            $_SESSION[INSTALLATION_KEY]['session_account_logged'] = 'terrae.com.mialias.net/intranet/PHPHotel/'.$data['id'];
            $_SESSION[INSTALLATION_KEY]['session_account_id'] =  $data['id'];
            $_SESSION[INSTALLATION_KEY]['session_account_type'] =  $data['account_type'];
            
            header('location: '.URL.LANG.'/home');
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