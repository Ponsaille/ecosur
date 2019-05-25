<?php

/*
   Ici c'est le fameux contrôleur (contient la logique concernant les actions effectuées par l'utilisateur), une classe
   PHP (on est en POO n'oublions pas) permettant de mettre en place des réactions en fonction des actions de
   l'utilisateur sur une de nos pages si l'utilisateur est connecté. Ca permet de faire les redirections vers les vues
   plus facilement.

   Merci d'ajouter une description de chaque fonction en annotation avant cette dernière
 */

namespace App\Controllers;

use \App\Core\App;
use App\Model\Pannes;
use App\Model\Properties;
use App\Model\Station;
use \App\Model\Users;
use \Exception;


class UsersController extends Controller
{
    public function inscription()
    {
        Users::store($_POST);

        $user = Users::findByEmail($_POST['email']);

        $_SESSION['user_id'] = $user->idPersonne;
        $_SESSION['user_type'] = $user->type;

        $title = "Inscription réussie";
        return $this->view('users/__inscription-reussie', compact('title'));
    }

    public function connection()
    {
        if (!(array_key_exists('email', $_POST) && array_key_exists('password', $_POST))) {
            $title = "Informations manquantes";
            return $this->view('users/__info-manquantes', compact('title'));
        }

        $user = Users::findByEmail($_POST['email']);

        if (!$user) {
            $title = "Utilisateur inconnu";
            return $this->view('users/__user-inconnu', compact('title'));
        }

        if (password_verify($_POST['password'], $user->password)) {
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
        } else {
            $title = "Mot de passe erroné";
            return $this->view('users/__mauvais-mdp', compact('title'));
        }
    }

}
