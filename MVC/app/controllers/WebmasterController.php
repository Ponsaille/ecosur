<?php

namespace App\Controllers;

use \App\Core\App;
use \App\Model\Users;
use \Exception;

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
        $this->view('users/webmaster', compact('title'));
    }
}