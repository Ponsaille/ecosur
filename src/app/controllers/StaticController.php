<?php

/*
   Ici c'est le fameux contrôleur (contient la logique concernant les actions effectuées par l'utilisateur), une classe
   PHP (on est en POO n'oublions pas) permettant de mettre en place des réactions en fonction des actions de
   l'utilisateur sur une de nos pages sur la page d'accueil si personne n'est connecté. Ca permet de faire les
   redirections vers les vues plus facilement.

   Merci d'ajouter une description de chaque fonction en annotation avant cette dernière
 */

namespace App\Controllers;


use \App\Core\{App, Request};
use App\Model\{FAQ, Modifiables, RecuperationLink, Users};
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

      
    public function recuperation() {
        $title = 'Récupération de mail';

        $this->view('public/generateRecup', compact('title'));
    }

    public function sendRecuperationLink() {
        $email = $_POST['email'];
        $personne = Users::findByEmail($email);
        if($personne->idPersonne) {
            $token = RecuperationLink::generate($personne->idPersonne);
            $link = 'http://' . Request::host() . '/recuperation/2?idPersonne='.$personne->idPersonne.'&token='.$token;
            App::get('email')->send(
                'app.g7c@gmail.com', 
                $email, 
                'Récupération du mot de passe', 
                "Afin de récupérer votre mot de passe veuillez acceder au lien suivant: <br> <a href='$link'>$link</a>"
            );
        }
        $title = "Lien de récupération envoyé";
        $this->view('public/recuperationSent', compact('title'));
    }

    public function changeMdpView() {
        $key = $_GET['token'];
        $idPersonne = $_GET['idPersonne'];
        if(!RecuperationLink::exists($idPersonne, $key)) {
            $title = "Non autorisé";
            $this->view('errors/403', compact('title'));
        } else {
            $title = "Modifier votre mot de passe";
            $this->view('public/changePassword', compact('title', 'key', 'idPersonne'));
        }
    }

    public function changeMdp() {
        $key = $_GET['token'];
        $idPersonne = $_GET['idPersonne'];
        if(RecuperationLink::useKey($idPersonne, $key)) {
            if(Users::updatePassword($_POST['password'], $idPersonne)) {
                $user = Users::find($idPersonne);
                $_SESSION['user_id'] = $user->idPersonne;
                $_SESSION['user_type'] = $user->type;
                switch ($user->type) {
                    case 0:
                        $this->redirect('board');
                        break;
                    case 1:
                        $this->redirect('gestionnaire/board');
                        break;
                    case 2:
                        $this->redirect('webmaster');
                        break;
                    case 5:
                        $this->redirect('pdg');
                        break;
                    case 4:
                        $this->redirect('sav');
                        break;
                }
            }
        } else {
            $title = "Non autorisé";
            $this->view('errors/403', compact('title'));
        }
    }
}
