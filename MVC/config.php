<?php

// C'est ici qu'on connecte notre MVC à notre BDD

return [
    'database' => [
        'name' => 'company',
        'username' => 'root',
        'password' => 'lafeteestfinie',
        'connection' => 'mysql:host=ponsaille.com:3306',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];