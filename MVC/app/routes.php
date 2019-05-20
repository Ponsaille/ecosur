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
$router->get('new-room', 'PropertiesController@newRoom');
$router->post('new-room', 'PropertiesController@newRoom');
$router->post('new-station', 'StationController@newStation');
$router->get('new-station', 'StationController@newStation');
$router->post('new-capteur', 'StationController@newCapteur');
$router->get('new-capteur', 'StationController@newCapteur');
$router->post('edit-property', 'PropertiesController@editProperty');
$router->post('edit-room', 'PropertiesController@editRoom');
$router->get('delete-property', 'PropertiesController@deleteProperty');
$router->get('delete-room', 'PropertiesController@deleteRoom');
$router->get('delete-station', 'StationController@deleteStation');
$router->get('delete-capteur', 'StationController@deleteCapteur');

$router->get('pdg', 'PdgController@index');
$router->post('pdg/inscription_admin', 'PdgController@inscription');

$router->get('webmaster', 'WebmasterController@index');
$router->get('webmaster/modifiables', 'WebmasterController@modifiables');
$router->post('webmaster/modifiables', 'WebmasterController@editModifiables');
$router->post('webmaster/typeComposant/add', 'WebmasterController@addType');
$router->post('webmaster/typeComposant/edit', 'WebmasterController@editType');


