<?php

use App\Core\{Router, Request};

$query = require 'core/bootstrap.php';

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());