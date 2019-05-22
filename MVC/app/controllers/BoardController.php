<?php

namespace App\Controllers;

use \App\Core\App;
use App\Model\Pannes;
use \App\Model\Properties;
use \App\Model\Board;
use App\Model\Station;
use App\Model\Users;
use \Exception;

use \App\Model\IdTemporaire;
use http\Client\Curl\User;

class BoardController extends AuthController
{
    function index()
    {
        $title = 'tableau de bord';
        $ressource = Board::RessourceAppartementByUser($_SESSION['user_id']);
        return $this->view('users/users', compact('title', 'ressource'));
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

        static::redirect('user-panne?idPanne=' . $_GET['idPanne']);
    }

    function generateIdTemporaire()
    {
        $idTemporaire = IdTemporaire::generate($_SESSION['user_id']);
        header('Content-type: application/json');
        echo json_encode([
            "code" => 200,
            "idTemporaire" => $idTemporaire
        ]);
    }

    function newPanne()
    {
        Pannes::new($_GET['idCemac'], $_GET['nbObjet']);
        static::redirect('board');
    }


    // Faire une méthode isAllowed($idUtilisateur, $idProperty)
    function isAllowed($idProperty)
    {
        return Properties::userAllowedInProperty($_SESSION['user_id'], $idProperty);
    }


    function editPage()
    {
        $user = Users::find($_SESSION['user_id']);
        $title = "Edition de votre compte";
        return $this->view('users/users-edit', compact('title', 'user'));
    }

    function edit()
    {
        Users::edit($_POST, $_SESSION['user_id']);
        static::redirect('edit-account');
        return;
    }

    public function disconnect()
    {
        session_destroy();

        static::redirect('');
    }

    function gestion()
    {
        $properties = Properties::findPropertiesByConnectedUser();

        $rooms = [];
        foreach ($properties as $property) {
            array_push($rooms, Properties::findRoomsByProperty($property->idDomicile));
        }

        $cemacs = [];
        foreach ($rooms as $room) {
            if ($room != null) {
                for ($j = 0; $j < count($room); $j++) {
                    array_push($cemacs, Station::findCemacByRoom($room[$j]->idPiece));
                }
            }
        }

        $composants = [];
        foreach ($cemacs as $cemac) {
            if ($cemac != null) {
                for ($k = 0; $k < count($cemac); $k++) {
                    array_push($composants, Station::findComposantByCemac($cemac[$k]->idCemac));
                }
            }
        }

        $nomsTypesComposants = Station::getNomsTypesComposants();

        $title = "Gestion";
        return $this->view('users/users-gestion', compact('title', 'properties', 'rooms', 'cemacs', 'composants', 'nomsTypesComposants'));
    }
}


