<?php
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charsert=UTF-8");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';


$mail = new PHPMailer(true);

try {
        //Server settings
        // $mail->SMTPDebug = 2;    //Sirve como guía para detectar errores de envió
        $mail->CharSet = 'UTF-8';

        $mail->isSMTP();

        $mail->Host       = 'smtp.flockmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'oliver.velazquez@corsec.com.mx';                     // SMTP username
        $mail->Password   = 'Oliver#123';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //PARA PHP 5.6 Y POSTERIOR
        $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );

        //Recipients
        $mail->setFrom('oliver.velazquez@corsec.com.mx', 'Encabezado de Correo');
        // $mail->addAddress($correoLista);
        // $mail->addAddress($correo);     //Correo de Salida
        $mail->addAddress('oliver885@hotmail.com');     //Correo de Salida
        // $mail->addBCC('oliver.velazquez@corsec.com.mx');
        // $mail->addBCC('erika.salgado@corsec.com.mx');
        // $mail->addBCC('SUribe@elementcorp.com');
        // $mail->addAttachment('logoCorsec.png');  //Archivo Adjunto

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->msgHTML(file_get_contents('ejemplo.html'), __DIR__);     //Se envio archivo en HTML pero $mail->Body debe estar desactivado
        $mail->Subject = 'Titulo de Correo';
        // $mail->Body    = '<h1>Ejemplo de Correo</h1>';

    $mail->send();
    echo 'Message COOL! todo bien!';
} catch (Exception $e) {
    echo "No se pudo enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}



?>