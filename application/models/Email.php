<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Email extends CI_Model{
    public function email($email,$tanggal){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
        //Server settings
        $mail->SMTPDebug = 2; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send t
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'your gmail@gmail.com'; //SMTP username
        $mail->Password = 'your password'; //SMTP password
        $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use
        //pengirim
        $mail->setFrom('email@gmail.com', 'your company');
        $mail->addAddress($email); //Add a recipient
        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = "TMT";
        $mail->Body = 'Silahkan Lengkapi Persyaratan Kenaikan Gaji Anda. TMT terhitung tanggal '.$tanggal;
        $mail->AltBody = '';
        //$mail->AddEmbeddedImage('gambar/logo.png', 'logo'); //abaikan jika tidak ada logo
        //$mail->addAttachment('');
        $mail->send();
        echo 'Message has been sent';
        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


?>