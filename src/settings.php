<?php

if (getenv('DOCKER_ENV') === 'true') {
    $dbHost = 'db';
} else {
    $dbHost = 'localhost:3306';
}

return [
    'db' => [
        'host' => $dbHost,
        'dbname' => 'my_project',
        'user' => 'root',
        'password' => '',
    ]
];
