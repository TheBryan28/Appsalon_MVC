<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $url = $_SERVER['HTTP_HOST'] ===''? '/':$_SERVER['HTTP_HOST'];
         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['MAILGUN_SMTP_SERVER'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['MAILGUN_SMTP_PORT'];
         $mail->Username = $_ENV['MAILGUN_SMTP_LOGIN'];
         $mail->Password = $_ENV['MAILGUN_SMTP_PASSWORD'];
     
         $mail->setFrom('cuentas@appsalon.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Creado tu cuenta en App Salón, solo debes confirmarla presionando el siguiente enlace</p>";
         $contenido .= "<p>Presiona aquí: <a href='http://".$url."/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";        
         $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;
         //debuguear($contenido);
         //Enviar el mail
         $mail->send();

    }

    public function enviarInstrucciones() {
        $url = $_SERVER['HTTP_HOST'] ===''? '/':$_SERVER['HTTP_HOST'];
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAILGUN_SMTP_SERVER'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAILGUN_SMTP_PORT'];
        $mail->Username = $_ENV['MAILGUN_SMTP_LOGIN'];
        $mail->Password =  $_ENV['MAILGUN_SMTP_PASSWORD'];
    
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://".$url."/recuperar?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

            //Enviar el mail
        $mail->send();
    }
}