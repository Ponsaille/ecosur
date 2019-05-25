<?php

namespace App\Controllers;

use \App\Core\App;
use \Exception;
use \App\Model\Properties;
use \App\Model\Users;

class PdgController extends AuthController {
    function __construct()
    {
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type']!=5) {
            http_response_code(403);
            die($this->view('errors/403'));
        }
    }

    function index() {
        $title = "PDG";
        $this->view('users/pdg', compact('title'));
    }

    function inscription() {
        
        try {
            Users::store($_POST, $_POST["type"]);
        } catch(Exception $e) {
            die($e->getMessage());
        }

        $this->redirect('pdg');
        
    }
}