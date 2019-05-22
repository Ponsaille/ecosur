<?php

namespace App\Controllers;

use \App\Core\App;
use App\Model\Board;
use App\Model\IdTemporaire;
use App\Model\Pannes;
use \App\Model\Users;
use \Exception;

class SavController extends AuthController
{
    function __construct()
    {
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 4) {
            http_response_code(403);
            die($this->view('errors/403'));
        }
    }

    function index()
    {
        $pannes = Pannes::get();

        $title = "SAV";
        $this->view('users/sav', compact('title', 'pannes'));
    }

    function showPanne() {
        $idPanne = $_GET['idPanne'];

        $messages = Pannes::findMessagesByPanne($idPanne);
        $idUser = Pannes::findIdUserByPanne($idPanne);

        $title = "Panne";
        $this->view('users/panne', compact('title', 'idPanne', 'messages', 'idUser'));
    }

    function sendMessage() {

        Pannes::storeMessage($_POST, $_SESSION['user_id'], $_GET['idPanne']);

        $idPanne = $_GET['idPanne'];

        $messages = Pannes::findMessagesByPanne($idPanne);

        $title = "Panne";
        $this->view('users/panne', compact('title', 'idPanne', 'messages'));
    }

    public function useIdTemporaire() {
        $changement = IdTemporaire::useKey($_GET['idPersonne'] , $_POST['idTemporaire']);

        if($changement) {
            $idPanne = $_GET['idPanne'];
            $ressource = Board::RessourceAppartementByUser($_GET['idPersonne']);
            $messages = Pannes::findMessagesByPanne($idPanne);
            $idUser = Pannes::findIdUserByPanne($idPanne);

            $title = "Panne";
            $this->view('users/panne', compact('title', 'idPanne', 'messages', 'idUser', 'ressource'));
        } else {
            static::redirect('panne?idPanne='.$_GET['idPanne']);
        }
    }

}