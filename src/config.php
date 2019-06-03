<?php

// C'est ici qu'on connecte notre MVC à notre BDD

return [
    'database' => [
        'name' => 'company',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:localhost:3306',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'email' => [
        'username' => 'app.g7c@gmail.com',
        'host' => 'smtp.gmail.com',
        'port' => 465,
        'password' => 'foo'
    ]
];