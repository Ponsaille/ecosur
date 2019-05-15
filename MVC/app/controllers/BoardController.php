<?php

namespace App\Controllers;

use \App\Core\App;
use \App\Model\Properties;

use \Exception;

class BoardController extends AuthController
{
    public function index()
    {
        $title = "Tableau de bord";
        return $this->view('users/users', compact('title'));
    }

}
