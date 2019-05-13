<?php

namespace App\Controllers;

use \App\Core\App;
use \App\Model\Users;
use \Exception;

use App\Model\Modifiables;

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
        $this->view('users/webmaster', compact('title', 'modifiables'));
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
}