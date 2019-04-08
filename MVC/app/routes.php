<?php

/*
    Ici on définit les routes

    EXEMPLE
    Le chemin (ce qui est marqué dans l'url après le nom du site) est "/exemple/exemplePage"
    On veut appeler une méthode du Contrôleur (qui permettra derrière d'afficher la bonne vue), pour cela on utilise la
        méthode get() définie dans le Routeur :
    $router->get('/exemple/exemplePage', 'NomContrôlleur@NomMéthode');
 */

$router->get('', 'StaticController@home');
