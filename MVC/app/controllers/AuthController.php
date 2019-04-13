<?php

namespace App\Controllers;

class AuthController extends Controller {
    function __construct() {
        if(!isset($_SESSION['user_id'])) {
            die($this->view('errors/403'));
        }
    }
}