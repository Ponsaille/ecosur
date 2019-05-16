<?php

namespace App\Controllers;

use \App\Core\App;
use \Exception;
use \App\Model\Station;

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
}


