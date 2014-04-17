<?php

class MailHelper extends Model {

    public $_from = "Mycausa.com <contact@mycausa.com>";
    public $_admin = ADMINMAIL;

    public function __construct() {
        parent::__construct();
        $this->loadLang();
        include 'Mail.php';
        include 'Mail/mime.php';
    }
    public function sendContact($values) {
        $tpl = file_get_contents(ROOT . 'views/templates/gift-mail.html');
        $data = array(
            'mail_hola' => $this->lang['mail_hola'],
            'link' => '',
            'name' => $values['name'],
            'content' => $this->lang['mail_contact'].$values['subject'].':<br><br>'.$values['message'].$this->lang['mail_contact2'].'<a href="mailto:'.$values['email'].'">'.$values['email'].'<a>',
            'title' => $this->lang['contact_done'],
            'link_msg' => '',
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );

        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($values['email']), 'Mycausa: ' . $this->lang['contact_done'],$this->_admin);
    }
    public function sendCrowdfounding($values) {
        $tpl = file_get_contents(ROOT . 'views/templates/gift-mail.html');
        $data = array(
            'mail_hola' => $this->lang['mail_hola'],
            'link' => '',
            'name' => $values['name'],
            'content' => $this->lang['mail_crowdfounding'],
            'title' => $this->lang['crowd_done'],
            'link_msg' => '',
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );

        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($values['email']), 'Mycausa: ' . $this->lang['crowdfounding_delivered']);
        
        $tpl = file_get_contents(ROOT . 'views/templates/gift-mail.html');
        $data = array(
            'mail_hola' => '',
            'link' => '',
            'name' => '',
            'content' => $this->lang['crowd_content_1'].$values['name'].' '.$values['email'].$this->lang['crowd_content_2'].$values['ong'].$this->lang['crowd_content_3'].$values['donacion'].$this->lang['crowd_content_4'].$values['deseo'],
            'title' => $this->lang['crowd_done'],
            'link_msg' => '',
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );

        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($this->_admin), 'Mycausa: ' . $this->lang['crowdfounding_delivered']);
    }
    public function sendGift($values) {
        $tpl = file_get_contents(ROOT . 'views/templates/gift-mail.html');
        $data = array(
            'mail_hola' => $this->lang['mail_hola'],
            'link' => '',
            'name' => $values['name'].',',
            'content' => $this->lang['mail_gift'],
            'title' => $this->lang['gift_delivered'],
            'link_msg' => '',
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );

        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($values['email']), 'Mycausa: ' . $this->lang['gift_delivered']);
        
        $tpl = file_get_contents(ROOT . 'views/templates/gift-mail.html');
        $data = array(
            'mail_hola' => '',
            'link' => '',
            'name' => '',
            'content' => $this->lang['gift_content_1'].$values['name'].' '.$values['email'].$this->lang['gift_content_2'].$values['donacion'].$this->lang['gift_content_3'].$values['deseo'],
            'title' => $this->lang['gift_delivered'],
            'link_msg' => '',
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );

        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($this->_admin), 'Mycausa: ' . $this->lang['gift_delivered']);
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
            'content2' => $this->lang['mail_confirm_msg2'] . ' ' . $user['email'] . '<br><a style="color:#e75f0c" href="' . $remember . '">' . $this->lang['mail_confirm_forgot'] . '</a>',
            'title' => $this->lang['mail_confirm_title'],
            'link_msg' => $this->lang['mail_confirm_click'],
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );

        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($user['email']), 'Mycausa: ' . $this->lang['confirmation_mail']);
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
            'content2' => $this->lang['mail_confirm_msg2'] . ' ' . $user['email'] . '<br>',
            'title' => $this->lang['mail_changeP_title'],
            'link_msg' => $this->lang['mail_changeP_click'],
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($user['email']), 'Mycausa: ' . $this->lang['reset_password']);
    }

    public function sendRebid($user, $auction) {
        $link = URL . 'auction/view/' . $auction['auction_id'] . '/' . $auction['name'];
        $tpl = file_get_contents(ROOT . 'views/templates/superada-mail.html');
        $current_bid = number_format(($auction['current_bid'] != 0) ? $auction['current_bid'] : $auction['minimum_bid'], 2, ',', '.');
        $time = $this->getRemaingTime($auction['ends']);
        if ($time) {
            $countDown = $time->d . ' ' . $this->lang['dias'] . ', ' . $time->h . ' ' . $this->lang['horas'] . ' ' . $this->lang['and'] . ' ' . $time->i . ' ' . $this->lang['minutos'];
        } else {
            $countDown = $this->lang['auction_ended'];
        }
        $content2 = "<div style='display: inline-block;vertical-align: top;width: 30%;'>
                <img style='display: block;height: auto;width: 100%;' src='" . UPLOAD . Model::getRouteImg($auction['img_date']) . $auction['file_name'] . "'>
            </div><div style='display: inline-block;margin-left: 2%;vertical-align: top;width: 68%;'>
                <ul style='list-style: none outside none;'>
                    <li  style='margin:0;padding:0;font-size:25;font-weight:bold;margin-bottom:10px;'>" . $auction['name'] . "</li>
                    <li  style='margin:0;padding:0'>" . $this->lang['my_puja'] . ": <span class='bold'>" . number_format($auction['maxbid'], 2, ',', '.') . "€</span></li>
                    <li  style='margin:0;padding:0'>" . $this->lang['actual_offer'] . ": <span class='bold'>" . $current_bid . "€</span></li>
                    <li  style='margin:0;padding:0'>" . $this->lang['Quedan'] . ": <span class'bold'>" . $countDown . "</span></li>
                </ul>
            </div><br>
            <p><a style='color:#e75f0c;font-size:14px;text-decoration:none;' href='http://mycausa.com/auction/view/" . $auction['auction_id'] . "/" . $auction['name'] . "'>" . $this->lang['volver_a_pujar'] . "</a></p>";
        $data = array(
            'mail_hola' => $this->lang['mail_hola'],
            'link' => $link,
            'name' => $user['first_name'],
            'content' => $this->lang['mail_rebid_msg'],
            'content2' => $content2,
            'title' => $this->lang['mail_rebid_title'],
            'link_msg' => '',
            'more_info' => $this->lang['mail_more_info'],
            'mail_legal' => $this->lang['mail_legal']
        );
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($user['email']), 'Mycausa: ' . $this->lang['superado_puja']);
    }

    public function sendMail($html, $list, $titulo, $Bcc = false, $from = null) {
        $from = ($from) ? $from : $this->_from;
        foreach ($list as $para) {
            $text = '';
            $crlf = "\n";
            $hdrs = array(
                'From' => $from,
                'Reply-To' => $from,
                'Subject' => $titulo
            );
            $hdrs['bcc'] = ($Bcc) ? $Bcc : '';
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
