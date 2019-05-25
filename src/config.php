<?php

// C'est ici qu'on connecte notre MVC à notre BDD

return [
    'database' => [
        'name' => 'company',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=localhost:3306',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];