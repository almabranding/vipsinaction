<?php

class MailHelper extends Model {

    public function __construct() {
        parent::__construct();
        $this->loadLang();
                include 'Mail.php';
        include 'Mail/mime.php';
    }

    public function getConfirmationMail($user) {
        $hash = Hash::create('sha256', $user['id'], HASH_PASSWORD_KEY);
        $link = URL . 'user/activate?id=' . $user[id] . '&hash=' . $hash;
        $mensaje = 'Bienvenido a terrae, por favor confirma este mail.';
        $tpl = file_get_contents(ROOT . 'views/templates/confirmation-mail.html');
        $tpl = str_replace('{{content}}', $mensaje, $tpl);
        $tpl = str_replace('{{link}}', $link, $tpl);
        $tpl = str_replace('{{name}}', $user['name'], $tpl);
        $this->sendMail($tpl, array($user['email']), 'Terrae: Confirmation mail');
    }

    public function getRememberMail($user) {
        $hash = Hash::create('sha256', $user['id'], HASH_PASSWORD_KEY);
        $link = URL . 'user/resetpassword?id=' . $user[id] . '&hash=' . $hash;
        $mensaje = 'Has solicitado restablecer tu contraseña, por favor haz click en el siguiente enlace.';
        $tpl = file_get_contents(ROOT . 'views/templates/confirmation-mail.html');
        $tpl = str_replace('{{content}}', $mensaje, $tpl);
        $tpl = str_replace('{{link}}', $link, $tpl);
        $tpl = str_replace('{{name}}', $user['name'], $tpl);
        $this->sendMail($tpl, array($user['email']), 'Terrae: Reset password');
    }

    public function sendMail($html, $list, $titulo, $from = 'info@terrae.com') {


//        $mensaje = stripslashes($_POST['comment']);
//
//        $headers = "MIME-Version: 1.0\r\n";
//        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
//        $headers .= "From: " . strip_tags($from) . "\r\n";
//        $headers .= "Reply-To: " . strip_tags($from) . "\r\n";

        foreach ($list as $para) {
            $text = 'Example';
            $crlf = "\n";
            $hdrs = array(
                'From' => strip_tags($from),
                'to' => $para,
                'Reply-To' => strip_tags($from),
                'Subject' => $titulo
            );
            $mime = new Mail_mime(array('eol' => $crlf));

            $mime->setTXTBody($text);
            $mime->setHTMLBody($html);

            $body = $mime->get();
            $headers = $mime->headers($hdrs);

            $mail = & Mail::factory('mail');
            $mail->send($para, $headers, $body);
        }
    }

    public function getBookingMail($booking, $user) {
        $tpl = file_get_contents(ROOT . 'views/templates/booking-mail.html');
        $total = 0;
        foreach ($booking as $key => $book) {
            $total+=$book['price'];
            $data = array(
                'name' => $book['name'] . ' - ' . $book['room_type'],
                'checkin_date' => $book['checkin_date'],
                'checkout_date' => $book['checkout_date'],
                'places' => $book['max_adults'] . ' Adults ' . $book['max_children'] . ' children ',
                'price' => $book['price'] . '  €',
            );
            $concept.= '<table bgcolor="fffefd" align="center" width="680" style="padding:20px;margin-bottom: 2px;">
                <tr>
                    <td>CONCEPT:</td>
                    <td>' . $data['name'] . '</td>
                </tr>
                 <tr>
                    <td>CHECK IN:</td>
                    <td>' . $this->lang[date('l', strtotime($data['checkin_date']))] . ', ' . Model::getTime($data['checkin_date']) . '</td>
                </tr>
                <tr>
                    <td>CHECK OUT:</td>
                    <td>' . $this->lang[date('l', strtotime($data['checkout_date']))] . ', ' . Model::getTime($data['checkout_date']) . '</td>
                </tr>
                <tr>
                    <td>Nº PLACES:</td>
                    <td>' . $data['places'] . '</td>
                </tr>
                <tr>
                    <td>AMOUNT:</td>
                    <td>' . $data['price'] . '</td>
                </tr>
               
            </table>';
        }
        unset($data);
        $data = array(
            'first_name' => $user['fist_name'],
            'last_name' => $user['last_name'],
            'phone' => $user['phone'],
            'city' => $user['city'],
            'country' => $user['country'],
            'email' => $user['email'],
            'concept' => $concept,
            'total' => $total . ' €',
            'subject' => 'Terrae: Reservation complete'
        );
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }

        $this->sendMail($tpl, array($user['email']), $data['subject']);
    }

    public function getGiftMail($attr) {
        $tpl = file_get_contents(ROOT . 'views/templates/booking-mail.html');
        $total=$attr['price'];
        $data = array(
            'name' => $attr['name'],
            'price' => $attr['price'] . '  €',
        );
        $concept.= '<table bgcolor="fffefd" align="center" width="680" style="padding:20px;margin-bottom: 2px;">
                <tr>
                    <td>CONCEPT:</td>
                    <td>' . $data['name'] . '</td>
                </tr>
                 <tr>
                    <td>CHECK IN:</td>
                    <td> - </td>
                </tr>
                <tr>
                    <td>CHECK OUT:</td>
                    <td> - </td>
                </tr>
                <tr>
                    <td>Nº PLACES:</td>
                    <td> - </td>
                </tr>
                <tr>
                    <td>AMOUNT:</td>
                    <td>' . $data['price'] . '</td>
                </tr>
               
            </table>';

        unset($data);
        $data = array(
            'first_name' => $attr['first_name'],
            'last_name' => $attr['last_name'],
            'phone' => $attr['phone'],
            'city' => $attr['city'],
            'country' => $attr['country'],
            'email' => $attr['email'],
            'concept' => $concept,
            'total' => $total . ' €',
            'subject' => 'Terrae: Reservation complete'
        );
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($data['email']), $data['subject']);
        
        
        $tpl = file_get_contents(ROOT . 'views/templates/booking-mail.html');
        unset($data);
        $concept= '<table bgcolor="fffefd" align="center" width="680" style="padding:20px;margin-bottom: 2px;">
                <tr>
                    <td>CONCEPT:</td>
                    <td>' . $data['name'] . '</td>
                </tr>
                <tr>
                  <td>YOUR GIFT CODE:</td>
               <td>'.$attr['code'].'</td>
                </tr>
               <td> GET YOUR GIFT:</td>
               <td><a href="http://terrae.com.mialias.net/gift/chose-a-gift">http://terrae.com.mialias.net/gift/chose-a-gift</a></td>
                </tr>
            </table>';
        $data = array(
            'first_name' => $attr['rec_first_name'],
            'last_name' => $attr['rec_last_name'],
            'phone' => $attr['rec_phone'],
            'city' => $attr['rec_city'],
            'country' => $attr['rec_country'],
            'email' => $attr['rec_email'],
            'concept' => $concept,
            'total' => 'FREE!!',
            'subject' => 'Terrae: You recived a gift from '.$attr['first_name'].' '.$attr['last_name']
        );
        
        foreach ($data as $key => $string) {
            $tpl = str_replace('{{' . $key . '}}', $string, $tpl);
        }
        $this->sendMail($tpl, array($data['email']), $data['subject']);
        
        
    }

}
