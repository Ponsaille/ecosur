<?php

namespace App\Controllers;

use \App\Core\App;
use \App\Model\Users;

use \Exception;

class BoardController extends AuthController {
    public function index() {
        $title = "Tableau de bord";
        return $this->view('users/users', compact('title'));
    }

    public function test(){
        die(var_dump("hey"));
    }
}