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


class ErrorController extends Controller
{

    public function noURI()
    {
        $title = "404 Not Found";
        http_response_code(404);
        return $this->view('errors/404', compact('title'));
    }

    public function internalError()
    {
        $title = "500 Internal Server Error";
        http_response_code(500);
        return $this->view('errors/500', compact('title'));
    }

}
