<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Méthode qui va nous donner le détail des routes
class Mail {
    protected $mail;
    
    public function __construct($params)
    {
        set_time_limit(120);
        $this->mail = new PHPMailer(true);

        //Server settings
        $this->mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $this->mail->isSMTP();                                            // Paramétrer le Mailer pour utiliser SMTP 
        $this->mail->Host = $params['host'];                              // Spécifier le serveur SMTP
        $this->mail->SMTPAuth = true;                                     // Activer authentication SMTP
        $this->mail->Username = $params['username'];                      // Votre adresse email d'envoi
        $this->mail->Password = $params['password'];                         // Le mot de passe de cette adresse email
        $this->mail->SMTPSecure = 'ssl';                                  // Accepter SSL
        $this->mail->Port = $params['port'];
    }

    public function send($from, $to, $subject, $body) {
        //Recipients
        $this->mail->setFrom($from, 'no-reply');
        $this->mail->addAddress($to);     // Add a recipient
        

        // Content
        $this->mail->isHTML(true);                                  // Set email format to HTML
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body;

        $this->mail->send();

        return true;
    }
}