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
    /**
     * Permet de renvoyer vers le dashboard de base de l'utilisateur (on adapte la variable $titre)
     * @return mixed
     */
    public function index()
    {
        $users = Users::get();

        return $this->view('users', compact('users'));
    }

}