<?php

/*
    Ici c'est l'index, on appelle ("require") une classe php qui est un contrôleur (contient la logique concernant les
    actions effectuées par l'utilisateur), ici PageController s'occupe de la logique liée aux pages du site.
    C'est ici qu'on regroupe tous les contrôleurs pour éviter d'avoir 20 000 lignes dans le bootstrap.
 */

require 'Controller.php';
require 'StaticController.php';
require 'UsersController.php';
require 'PropertiesController.php';
require 'AuthController.php';
require 'BoardController.php';
require 'PdgController.php';
