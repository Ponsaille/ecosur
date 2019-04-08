<?php

/*
   Ici c'est le fameux contrôleur (contient la logique concernant les actions effectuées par l'utilisateur), une classe
   PHP (on est en POO n'oublions pas) permettant de mettre en place des réactions en fonction des actions de
   l'utilisateur sur une de nos pages sur la page d'accueil si personne n'est connecté. Ca permet de faire les
   redirections vers les vues plus facilement.

   Merci d'ajouter une description de chaque fonction en annotation avant cette dernière
 */

namespace App\Controllers;

class StaticController extends Controller
{

    /**
     * Permet de renvoyer vers la page d'accueil (on adapte la variable $titre)
     * @return mixed
     */
    public function home()
    {
        $title = "Accueil";
        return $this->view('index', compact('title'));
    }

}