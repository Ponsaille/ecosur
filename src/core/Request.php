<?php

namespace App\Core;

// Méthode qui va nous donner le détail des routes
class Request {

    /**
     * Permet de récupérer la route sélectionné
     * @return string
     */
    public static function uri() {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    /**
     * Retourne la méthode utilisée (POST, GET)
     * @return mixed
     */
    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function host() {
        return $_SERVER["HTTP_HOST"];
    }
}