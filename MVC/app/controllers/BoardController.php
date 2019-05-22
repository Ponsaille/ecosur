<?php

namespace App\Controllers;

use \App\Core\App;
use App\Model\Pannes;
use \App\Model\Properties;
use \App\Model\Board;
use \App\Model\Users;

use App\Model\Station;
use \Exception;

use \App\Model\IdTemporaire;

class BoardController extends AuthController
{
    function index()
    {
        $title='tableau de bord';
        $ressource = Board::RessourceAppartementByUser();
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

    public function ajoutUtilisateurSecondaire() {
        if(!isset($_GET['idDomicile']) || !isset($_POST['email']) || !isset($_POST['allowedTypes'])) {
            die('Missing arguments');
        }

        $user = Users::findByEmail($_POST['email']) ;

        if(!$user) {
            die("User undefined");
        }

        Users::addSecondaryUser($_GET['idDomicile'], $user->idPersonne, date("Y-m-d", strtotime(" +100 year")), $_POST['allowedTypes']);

        static::redirect('gestion');
    }
}


