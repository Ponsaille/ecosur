<?php

namespace App\Controllers;

use \App\Core\App;
use App\Model\Board;
use App\Model\Composant;
use App\Model\IdTemporaire;
use App\Model\Pannes;
use App\Model\Properties;
use App\Model\Station;
use \App\Model\Users;
use \Exception;

use App\Model\Modifiables;
use App\Model\TypeComposant;
use App\Model\FAQ;

class GestionnaireController extends AuthController {

    function __construct()
    {
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type']!=1) {
            http_response_code(403);
            die($this->view('errors/403'));
        }
    }

    function index()
    {
        $title = 'Tableau de bord';

        $ressource = Board::RessourceAppartementByUser($_SESSION['user_id']);
        return $this->view('users/users', compact('title', 'ressource'));
    }


}