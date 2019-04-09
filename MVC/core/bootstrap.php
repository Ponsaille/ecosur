<?php

/*
    Ici on charge tout les fichiers
 */

require 'core/App.php';
require 'core/Router.php';
require 'core/Request.php';
require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';
require 'app/controllers/index.php';

use App\Core\App;

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

/*
$app = [];

$app['config'] = require 'config.php';

$app['database'] = new QueryBuilder(Connection::make($app['config']['database']));
*/