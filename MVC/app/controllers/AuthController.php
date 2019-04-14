<?php

namespace App\Controllers;

class AuthController extends Controller {
    function __construct() {
        if(!isset($_SESSION['user_id'])) {
            http_response_code(403);
            die($this->view('errors/403'));
        }
    }
}