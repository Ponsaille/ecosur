<?php

$router->get('', 'StaticController@home');
$router->get('faq', 'StaticController@faq');
$router->post('contact', 'StaticController@sendMail');
$router->get('cgu', 'StaticController@cgu');


$router->post('inscription', 'UsersController@inscription');
$router->post('connexion', 'UsersController@connection');
$router->get('disconnect', 'BoardController@disconnect');
$router->get('edit-account', 'BoardController@editPage');
$router->post('edit-user', 'BoardController@edit');
$router->get('delete-user', 'BoardController@delete');
$router->get('generateIdTemporaire', 'BoardController@generateIdTemporaire');
$router->get('useIdTemporaire', 'SavController@useIdTemporaire');
$router->post('useIdTemporaire', 'SavController@useIdTemporaire');
$router->get('recuperation/1', 'StaticController@recuperation');
$router->post('recuperation/1', 'StaticController@sendRecuperationLink');
$router->get('recuperation/2', 'StaticController@changeMdpView');
$router->post('recuperation/2', 'StaticController@changeMdp');


$router->get('gestion', 'BoardController@gestion');
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
$router->get('declare-panne', 'BoardController@newPanne');
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
$router->get('end-panne', 'SavController@endPanne');
$router->get('message', 'SavController@sendMessage');
$router->post('message', 'SavController@sendMessage');

$router->get('composant/activate','StationController@activate');
$router->get('composant/desactivate','StationController@desactivate');

$router->get('getAppartementStats','BoardController@getAppartementStats');

$router->post('ajoutUtilisateurSecondaire', 'BoardController@ajoutUtilisateurSecondaire');

$router->get('api/messages', 'SavController@getMsg');
$router->post('api/send', 'SavController@sendMsg');

$router->get('api/messagesUser', 'BoardController@getMsg');
$router->post('api/sendUser', 'BoardController@sendMsg');

$router->get('gestionnaire/board', 'GestionnaireController@index');
$router->get('gestionnaire/gestion', 'GestionnaireController@gestion');