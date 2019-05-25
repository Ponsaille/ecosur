<?php

/*
   Ici c'est le fameux contrôleur (contient la logique concernant les actions effectuées par l'utilisateur), une classe
   PHP (on est en POO n'oublions pas) permettant de mettre en place des réactions en fonction des actions de
   l'utilisateur sur une de nos pages sur la page d'accueil si personne n'est connecté. Ca permet de faire les
   redirections vers les vues plus facilement.

   Merci d'ajouter une description de chaque fonction en annotation avant cette dernière
 */

namespace App\Controllers;



use App\Model\FAQ;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class StaticController extends Controller
{

    /**
     * Permet de renvoyer vers la page d'accueil (on adapte la variable $titre)
     * @return mixed
     */
    public function home()
    {
        $title = "Accueil";
        return $this->view('public/index', compact('title'));
    }

    public function faq()
    {
        $title = "FAQ";
        $faqs = FAQ::get();
        return $this->view('public/faq', compact('title', 'faqs'));
    }

    public function sendMail(){


        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Paramétrer le Mailer pour utiliser SMTP 
            $mail->Host = 'smtp.gmail.com';                             // Spécifier le serveur SMTP
            $mail->SMTPAuth = true;                                     // Activer authentication SMTP
            $mail->Username = 'app.g7c@gmail.com';                      // Votre adresse email d'envoi
            $mail->Password = 'lafeteestfinie';                         // Le mot de passe de cette adresse email
            $mail->SMTPSecure = 'ssl';                                  // Accepter SSL
            $mail->Port = 465;


            //Recipients
            $mail->setFrom($_POST['email'], 'client');
            $mail->addAddress('app.g7c@gmail.com');     // Add a recipient
            

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'mail contact index';
            $mail->Body    = $_POST['body'];

            $mail->send();

            $title= "Message envoyé";
            $this->view('public/sentmail', compact('title'));
        } catch (Exception $e) {
            $title= "Erreur";
            $this->view('public/emailnotsent', compact('title'));
        }
    }

      
    
}
