<?php

namespace App\Controllers;

use \App\Core\App;


// On utilise une class controller qui va nous permettre de faire les redirections et les vues plus facilement
class UsersController extends Controller {
    public function index() {
        $users = App::get('database')->select('users');

        return $this->view('users', compact('users'));
    }

    public function store() {
        App::get('database')->insert('users', [
            'name' => $_POST['name']
        ]);

        return $this->redirect('users');
    }
}