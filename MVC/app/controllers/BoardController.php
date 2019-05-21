<?php

namespace App\Controllers;

use \App\Core\App;
use \App\Model\Properties;

use \Exception;

use \App\Model\IdTemporaire;

class BoardController extends AuthController
{
    public function index()
    {
        $title = "Tableau de bord";
        return $this->view('users/users', compact('title'));
    }

    public function generateIdTemporaire() {
        $idTemporaire = IdTemporaire::generate($_SESSION['user_id']);
        header('Content-type: application/json');
        echo json_encode([
            "code" => 200,
            "idTemporaire" => $idTemporaire
        ]);
    }
}
