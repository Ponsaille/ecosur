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

use \App\Model\Users;


class UsersController extends Controller
{
    public function inscription() {
        Users::store($_POST);
        die('You\'re inscription was sucessfull !');
    }

    public function connection() {
        if(!(array_key_exists('email', $_POST) && array_key_exists('password', $_POST))) {
            die("Email and passwords are required");
        }
        $user = Users::findByEmail($_POST['email']);

        if(!$user) {
            die("This user doesn't exist");
        }

        if($user->password == $_POST['password']) {
            $_SESSION['user_id'] = $user->idPersonne;
            die('All ok');
        } else {
            die('Wrong password');
        }
    }

    public function disconnect() {
        session_destroy();

        static::redirect('');
    }
}