<?php

namespace App\Controllers;

use \App\Core\App;
use \App\Model\Properties;
use \App\Model\Board;

use \Exception;

class BoardController extends AuthController
{
    public function index()
    {
        $title='tanleaude bord';
        var_dump(Board::RessourceAppartementByUser());
        return $this->view('users/users', compact('title'));
    }

}


