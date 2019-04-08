<?php

namespace App\Controllers;

// On utilise une class controller qui va nous permettre de faire les redirections et les vues plus facilement
class PagesController extends Controller {
    public function home() {
        return $this->view('index');
    }

    public function about() {
        return $this->view('about');
    }

    public function contact() {
        return $this->view('contact');
    }
}