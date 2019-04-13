<?php

/*
    Cette classe a pour objectif d'appeler le bon contrôleur en fonction de la situation
 */

// Un namespace permet d'utiliser les variables/fonctions des fichiers du dossier dans les autres fichiers
namespace App\Core;

use \Exception;

class Router {

    /*
        Trie les routes en fonction des méthodes (GET ou POST), $routes et donc un tableau à deux colonnes, une pour
        tous les uri (fin d'url) utilisant la méthode GET, et une autre pour tous les uri utilisant la méthode POST.
    */
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Crée un nouveau routeur (sachant qu'on est dans le routeur, c'est tricky, pour complète compréhension voir avec
     * Jules) pour l'utiliser dans le fichier routes.php (où on définit les routes)
     */
    public static function load($file) {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * On ajoute l'uri dans le tableau $routes colonne GET, et on associe un contrôleur avec l'uri et la méthode GET
     * @param $uri
     * @param $controller
     */
    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * On ajoute l'uri dans le tableau $routes colonne POST, et on associe un contrôleur avec l'uri et la méthode POST
     * @param $uri
     * @param $controller
     */
    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Si la route existe pour la méthode donnée (GET ou POST) alors on passe à l'action (avec call to action, qui fait
    fonctionner le contrôleur))
     * @param $uri
     * @param $requestType
     * @return mixed
     * @throws Exception
     */
    public function direct($uri, $requestType) {
        if(array_key_exists($uri, $this->routes[$requestType])) {
            
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        throw new Exception('No routes defined for this URI.');
    }

    /**
     * @param $controller
     * @param $action
     * @return mixed
     * @throws Exception
     */
    protected function callAction($controller, $action) {
        $controller = "App\Controllers\\$controller";

        $controller = new $controller;

        if(! method_exists($controller, $action)) {
            throw new Exception("No method $action in $controller");
        }

        return $controller->$action();
    }
}