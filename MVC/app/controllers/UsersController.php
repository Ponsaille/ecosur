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
use App\Model\Properties;
use App\Model\Station;
use \App\Model\Users;
use \Exception;


class UsersController extends Controller
{

    public function board()
    {
        $title = "Tableau de bord";
        return $this->view('users/users', compact('title'));
    }

    public function inscription()
    {

        Users::store($_POST);

        $user = Users::findByEmail($_POST['email']);

        $_SESSION['user_id'] = $user->idPersonne;

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
            switch($user->type) {
                case 0:
                    $this->redirect('board');
                    break;
                case 2:
                    $this->redirect('webmaster');
                    break;
                case 5:
                    $this->redirect('pdg');
                    break; 
            }
        } else {
            $title = "Mot de passe erroné";
            return $this->view('users/__mauvais-mdp', compact('title'));
        }
    }

    public function disconnect()
    {
        session_destroy();

        static::redirect('');
    }

    public function gestion()
    {
        $properties = Properties::findPropertiesByConnectedUser();

        $rooms = [];
        foreach ($properties as $property) {
            array_push($rooms, Properties::findRoomsByProperty($property->idDomicile));
        }

        $cemacs = [];
        foreach ($rooms as $room) {
            if ($room != null) {
                array_push($cemacs, Station::findCemacByRoom($room[0]->idPiece));
            }
        }

        $title = "Gestion";
        return $this->view('users/users-gestion', compact('title', 'properties', 'rooms', 'cemacs'));
    }
}
