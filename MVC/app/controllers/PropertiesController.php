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
use \Exception;
use \App\Model\Properties;

class PropertiesController extends Controller
{
    public function newProperty()
    {

        Properties::store($_POST);

        $title = "Propriété bien ajoutée";
        return $this->view('users/__propriete-ajoutee', compact('title'));
    }
}
