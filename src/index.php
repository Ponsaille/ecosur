<?php

//Cet index permet le chargement des routes et la redirection de l'utilisateur vers la bone vue en fonction de l'url

// On utilise les deux classes PHP Request et Router (voir dans le dossier core)
use App\Core\{Router, Request};

// On appelle le fichier bootstrap où sont chargés tous les fichiers
$query = require 'core/bootstrap.php';

session_start();

/*
    On utilise les classes suivantes :
        - Router : appelle le bon contrôleur
        - Request : donne le détail des routes

    dans lesquelles sont définies les fonctions suivantes :
        - load($fichier) : créer un nouveau routeur pour l'utiliser dans le fichier routes.php (où on définit les
            routes)
        - direct($uri, $requestType) : si la route existe pour la méthode donnée alors on passe à l'action (on fait
            fonctionner le contrôleur)
        - uri() : permet de récupérer la route sélectionné
        - method() : permet de récupérer quelle méthode est utilisée (POST, GET)
 */
Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());