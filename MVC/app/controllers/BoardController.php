<?php

namespace App\Controllers;

use \App\Core\App;
use App\Model\Pannes;
use \App\Model\Properties;

use App\Model\Station;
use \Exception;

use \App\Model\IdTemporaire;

class BoardController extends AuthController
{
    function index()
    {
        $title = "Tableau de bord";
        return $this->view('users/users', compact('title'));
    }

    function userSAV()
    {
        $pannes = Pannes::getbyUser($_SESSION['user_id']);

        $title = "Vos pannes";
        return $this->view('users/users-list-pannes', compact('title', 'pannes'));
    }

    function userPanne()
    {
        $idPanne = $_GET['idPanne'];

        $messages = Pannes::findMessagesByPanne($idPanne);

        $title = "Panne";
        $this->view('users/users-panne', compact('title', 'idPanne', 'messages'));
    }

    function userSendMessage()
    {
        Pannes::storeMessage($_POST, $_SESSION['user_id'], $_GET['idPanne']);

        static::redirect('user-panne?idPanne='.$_GET['idPanne']);
    }

    public function generateIdTemporaire()
    {
        $idTemporaire = IdTemporaire::generate($_SESSION['user_id']);
        header('Content-type: application/json');
        echo json_encode([
            "code" => 200,
            "idTemporaire" => $idTemporaire
        ]);
    }
}
