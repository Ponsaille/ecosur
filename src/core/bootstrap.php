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
require 'app/models/index.php';


require 'core/PHPMailer/src/Exception.php';
require 'core/PHPMailer/src/PHPMailer.php';
require 'core/PHPMailer/src/SMTP.php';
require 'core/Mail.php';


use App\Core\App;
use App\Core\Mail;

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])));

App::bind('email', new Mail(
    App::get('config')['email']));