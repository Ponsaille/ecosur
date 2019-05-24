<?php

$router->get('', 'StaticController@home');
$router->get('faq', 'StaticController@faq');
$router->post('contact', 'StaticController@sendMail');



$router->post('inscription', 'UsersController@inscription');
$router->post('connexion', 'UsersController@connection');
$router->get('disconnect', 'UsersController@disconnect');
$router->get('session', 'UsersController@getSession');
$router->get('edit-account', 'UsersController@editPage');
$router->post('edit-user', 'UsersController@edit');
$router->get('generateIdTemporaire', 'BoardController@generateIdTemporaire');
$router->get('useIdTemporaire', 'SavController@useIdTemporaire');
$router->post('useIdTemporaire', 'SavController@useIdTemporaire');

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


$router->get('user-sav', 'BoardController@userSav');
$router->get('user-panne', 'BoardController@userPanne');
$router->get('user-message', 'BoardController@userSendMessage');
$router->post('user-message', 'BoardController@userSendMessage');


$router->get('pdg', 'PdgController@index');
$router->post('pdg/inscription_admin', 'PdgController@inscription');

$router->get('webmaster', 'WebmasterController@index');
$router->get('webmaster/modifiables', 'WebmasterController@modifiables');
$router->post('webmaster/modifiables', 'WebmasterController@editModifiables');
$router->post('webmaster/typeComposant/add', 'WebmasterController@addType');
$router->post('webmaster/typeComposant/edit', 'WebmasterController@editType');
$router->post('webmaster/faqs/add', 'WebmasterController@addFaq');
$router->get('webmaster/faqs', 'WebmasterController@faqs');
$router->post('webmaster/faqs', 'WebmasterController@editFaq');
$router->get('webmaster/faqs/delete', 'WebmasterController@deleteFaq');

$router->get('sav', 'SavController@index');
$router->get('panne', 'SavController@showPanne');
$router->get('message', 'SavController@sendMessage');
$router->post('message', 'SavController@sendMessage');

