<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $token;
    public $nombre;

    public function __construct($email, $token, $nombre){
        $this->email = $email;
        $this->token = $token;
        $this->nombre = $nombre;
    
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '9abee675358a74';
        $mail->Password = '7bf63fd8fb3b46';

        $mail->setFrom('contactos@desdeidaca.com');
        $mail->addAddress('contactos@asdasdsaasd.com', 'asdasdsaasd.com');
        $mail->Subject = 'Confirmación de registro';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre ."</strong> tu registro ha sido confirmado. Por favor, haga click en el siguiente enlace para completar tu registro </p>";
        $contenido .= "<p><a href='http://localhost/proyecto_idaca/public/confirmar-registro?token=". $this->token ."'>COMPLETAR REGISTRO</a></p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        
         $mail->send();

    }
    
}