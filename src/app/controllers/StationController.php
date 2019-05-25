<?php

namespace App\Controllers;

use \App\Core\App;
use \Exception;
use \App\Model\Station;
use \App\Model\Composant;

class StationController extends Controller
{
    public function newStation()
    {
        Station::store($_POST, $_GET);

        $title = "Station bien ajoutée";
        return $this->view('users/__ajout-reussi', compact('title'));
    }

    public function deleteStation() {
        try {
            Station::delete($_GET);
            static::redirect('gestion');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function newCapteur() {
        Station::storeCapteur($_POST, $_GET, Station::getTypesComposants());

        $title = "Capteur bien ajoutée";
        return $this->view('users/__ajout-reussi', compact('title'));
    }

    public function deleteCapteur() {
        try {
            Station::deleteCapteur($_GET);
            static::redirect('gestion');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function activate(){
        try {
            header('Content-type: application/json');
            if(Composant::activate($_GET['id'])) {
                http_response_code(200);
                echo json_encode([
                    'status' => 200
                ]);
            } else {
                http_response_code(403);
                echo json_encode([
                    'status' => 403,
                    'message' => "Déjà activé"
                ]);
            }
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function desactivate (){
        try{
            header('Content-type: application/json');
            if(Composant::desactivate($_GET['id'])) {
                http_response_code(200);
                echo json_encode([
                    'status' => 200
                ]);
            } else {
                http_response_code(403);
                echo json_encode([
                    'status' => 403,
                    'message' => "Déjà activé"
                ]);
            }
        }catch (Exception $e){
            die ($e->getMessage());
        }
    }

    public function getStatus() {
        try{
            header('Content-type: application/json');
            if(Composant::status($_GET['id'])) {
                http_response_code(200);
                echo json_encode([
                    'status' => 200
                ]);
            } else {
                http_response_code(403);
                echo json_encode([
                    'status' => 403,
                    'message' => "Déjà activé"
                ]);
            }
        }catch (Exception $e){
            die ($e->getMessage());
        }
    }
}


