<?php

namespace App\Controllers;

use \App\Core\App;
use \App\Model\Users;
use \Exception;

use App\Model\Modifiables;
use App\Model\TypeComposant;

class WebmasterController extends AuthController {
    function __construct()
    {
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type']!=2) {
            http_response_code(403);
            die($this->view('errors/403'));
        }
    }

    function index() {
        $title = "Webmaster";
        $modifiables = Modifiables::get();
        $typeComposants = TypeComposant::get();
        $this->view('users/webmaster', compact('title', 'modifiables', 'typeComposants'));
    }

    function modifiables() {
        if(!isset($_GET['id'])) {
            die("id manquant");
        }
        $modifiable = Modifiables::getById($_GET['id']);
        if(sizeof($modifiable) != 1) {
            die("modifiable non existant");
        }
        $modifiable = $modifiable[0];
        $title = $modifiable->titre;
        $this->view('users/modifiable', compact('title', 'modifiable'));
    }

    function editModifiables() {
        if(!isset($_GET['id'])) {
            die("id manquant");
        }
        try {
            Modifiables::update($_GET['id'], $_POST['contenu']);
            $this->redirect("webmaster/modifiables?id=".$_GET['id']);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    function addType() {
        try {
            TypeComposant::store($_POST['nom'], $_POST['type'], $_POST['icone']);
            $this->redirect("webmaster");
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    function editType() {
        if(!isset($_GET['id'])) {
            die("id manquant");
        }
        try {
            TypeComposant::update($_GET['id'],$_POST['nom'], $_POST['type'], $_POST['icone']);
            $this->redirect("webmaster");
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}