<?php

/*
   Ici c'est le fameux contrôleur (contient la logique concernant les actions effectuées par l'utilisateur), une classe
   PHP (on est en POO n'oublions pas) permettant de mettre en place des réactions en fonction des actions de
   l'utilisateur sur une de nos pages sur la page d'accueil si personne n'est connecté. Ca permet de faire les
   redirections vers les vues plus facilement.

   Merci d'ajouter une description de chaque fonction en annotation avant cette dernière
 */

namespace App\Controllers;


use \App\Core\App;
use App\Model\FAQ;
use App\Model\Modifiables;
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

    public function cgu()
    {
        $modifiables = Modifiables::get();
        $title = "Conditions Générales d'Utilisation";
        return $this->view('public/cgu', compact('title', 'modifiables'));
    }

    public function sendMail(){

        try {
            App::get('email')->send(
                'app.g7c@gmail.com', 
                'app.g7c@gmail.com', 
                'mail contact index', 
                'Vous avez été contacté par: ' . $_POST['email'] . $_POST['body']
            );

            $title= "Message envoyé";
            $this->view('public/sentmail', compact('title'));
        } catch (Exception $e) {
            die($e->getMessage());
            $title= "Erreur";
            $this->view('public/emailnotsent', compact('title'));
        }
    }

      
    
}
