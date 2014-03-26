<?php

class MailHelper extends Model {
    public $_from="Mycausa.com <contact@mycausa.com>";
    public $_admin='dan@almabranding.com';
    public function __construct() {
        parent::__construct();
        $this->loadLang();
                include 'Mail.php';
        include 'Mail/mime.php';
    }

    public function getConfirmationMail($user) {
        $hash = Hash::create('sha256', $user['id'], HASH_PASSWORD_KEY);
        $link = URL . 'user/activate?id=' . $user['id'] . '&hash=' . $hash;
        $remember = URL . 'user/remember?id=' . $user['id'];
        $tpl = file_get_contents(ROOT . 'views/templates/confirmation-mail.html');
        $data = array(
            'mail_hola' => $this->lang['mail_hola'],
            'link' => $link,
            'name' => $user['first_name'],
            'content' => $this->lang['mail_confirm_msg'],
            'content2' => $this->lang['mail_confirm_msg2'].' '.$user['email'].'<br><a style="color:#e75f0c" href="'.$remember.'">'.$this->lang['mail_confirm_forgot'].'</a>',
            'title' => $this->lang['mail_confirm_title'],
            'link_msg' => $this->lang['mail_confirm_click'],
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal'=>$this->lang['mail_legal']
        );
        
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($user['email']), 'Mycausa: '.$this->lang['confirmation_mail']);
    }

    public function getChangePasswordMail($user) {
        $hash = Hash::create('sha256', $user['id'], HASH_PASSWORD_KEY);
        $link = URL . 'user/resetpassword?id=' . $user[id] . '&hash=' . $hash;
        $tpl = file_get_contents(ROOT . 'views/templates/confirmation-mail.html');
        $data = array(
            'mail_hola' => $this->lang['mail_hola'],
            'link' => $link,
            'name' => $user['first_name'],
            'content' => $this->lang['mail_changeP_msg'],
            'content2' => $this->lang['mail_confirm_msg2'].' '.$user['email'].'<br>',
            'title' => $this->lang['mail_changeP_title'],
            'link_msg' => $this->lang['mail_changeP_click'],
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal'=>$this->lang['mail_legal']
        );
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($user['email']), 'Mycausa: '.$this->lang['reset_password']);
    }
    public function sendRebid($user,$auction) {
        $link = URL.'auction/view/'.$auction['auction_id'].'/'.$auction['name'];
        $tpl = file_get_contents(ROOT . 'views/templates/confirmation-mail.html');
        $data = array(
            'mail_hola' => $this->lang['mail_hola'],
            'link' => $link,
            'name' => $user['first_name'],
            'content' => $this->lang['mail_rebid_msg'].'<a href="'.$link.'">'.$auction['name'].'</a>',
            'content2' => $this->lang['mail_confirm_msg2'].' '.$user['email'].'<br>',
            'title' => $this->lang['mail_rebid_title'],
            'link_msg' => $this->lang['mail_rebid_vuelve_puja'],
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal'=>$this->lang['mail_legal']
        );
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($user['email']), 'Mycausa: '.$this->lang['superado_puja']);
    }

    public function sendMail($html, $list, $titulo,$Bcc=false, $from = null) {
        $from=($from)?$from:$this->_from;
        foreach ($list as $para) {
            $text = '';
            $crlf = "\n";
            $hdrs = array(
                'From' => $from,
                'Reply-To' => $from,
                'Subject' => $titulo
            );
            $hdrs['bcc']=($Bcc)?$Bcc:'';
            $mime = new Mail_mime(array('eol' => $crlf));

            $mime->setTXTBody($text);
            $mime->setHTMLBody($html);

            $body = $mime->get();
            $headers = $mime->headers($hdrs);

            $mail = & Mail::factory('mail');
            $mail->send($para, $headers, $body);
        }
    }

   

}
