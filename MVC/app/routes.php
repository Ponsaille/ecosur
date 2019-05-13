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
$router->post('inscription', 'UsersController@inscription');
$router->post('connexion', 'UsersController@connection');
$router->get('disconnect', 'UsersController@disconnect');
$router->get('session', 'UsersController@getSession');
$router->get('gestion', 'UsersController@gestion');
$router->get('board', 'BoardController@index');
$router->post('new-property', 'PropertiesController@newProperty');
$router->post('edit-property', 'PropertiesController@editProperty');

$router->get('pdg', 'PdgController@index');
$router->post('pdg/inscription_admin', 'PdgController@inscription');

$router->get('webmaster', 'WebmasterController@index');
$router->get('webmaster/modifiables', 'WebmasterController@modifiables');


