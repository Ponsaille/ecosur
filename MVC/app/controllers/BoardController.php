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
        $title='tableau de bord';
        $ressource = Board::RessourceAppartementByUser();
        return $this->view('users/users', compact('title', 'ressource'));
    }

}


