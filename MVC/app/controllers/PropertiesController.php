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
        return $this->view('users/__ajout-reussi', compact('title'));
    }

    public function newRoom()
    {
        Properties::storeRoom($_POST, $_GET);

        $title = "Pièce bien ajoutée";
        return $this->view('users/__ajout-reussi', compact('title'));
    }

    public function editProperty()
    {

        try {
            Properties::edit($_POST, $_GET["idDomicile"]);
            static::redirect('gestion');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteProperty() {
        try {
            Properties::delete($_GET["idDomicile"]);
            static::redirect('gestion');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function editRoom()
    {
        try {
            Properties::editOneRoom($_POST, $_GET["idPiece"]);
            static::redirect('gestion');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteRoom() {
        try {
            Properties::deleteOneRoom($_GET["idPiece"]);
            static::redirect('gestion');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
