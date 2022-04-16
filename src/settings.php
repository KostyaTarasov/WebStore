<?php // Настройки для подключения к базе данных

// Для Mamp
// return [
//     'db' => [
//         'host' => 'localhost:8889', // host и порт заданный в MAMP для SQL
//         'dbname' => 'my_project', // Имя базы данных в корне sql
//         'user' => 'root',
//         'password' => 'root',
//     ]
// ];

// Для Wamp (импортировал через phpMyAdmin)
return [
    'db' => [
        'host' => 'localhost:3306', // host и порт заданный в MAMP для SQL
        'dbname' => 'my_project', // Имя базы данных в корне sql
        'user' => 'root',
        'password' => '',
    ]
];
