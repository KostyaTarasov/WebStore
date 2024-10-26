<?php

return [
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],  // Роут первой главной страницы 
    '~^(\d+)$~' => [\MyProject\Controllers\MainController::class, 'page'], // Роут главной страницы

    '~^catalog$~' => [\MyProject\Controllers\CatalogController::class, 'catalog'], // Роут страницы общего каталога

    '~^catalog/(.+)/(\d+)/$~' => [\MyProject\Controllers\ArticlesController::class, 'view'], // Роут для просмотра товара
    '~^catalog/(.+)/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'], // Роут для изменения товара
    '~^catalog/(.+)/(\d+)/del$~' => [\MyProject\Controllers\ArticlesController::class, 'del'], // Роут для удаления товара
    '~^catalog/(.+)/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'], // Роут для добавления товара

    '~^catalog/(.+)/page/(\d+)$~' => [\MyProject\Controllers\CatalogController::class, 'page'], // Роут страницы определённого каталога товаров   
    '~^catalog/(.+)$~' => [\MyProject\Controllers\CatalogController::class, 'firstPage'], // Роут первой страницы определённого каталога товаров

    '~^search/(\d+)$~' => [\MyProject\Controllers\SearchController::class, 'page'], // Роут для поиска
    '~^search(.*)$~' => [\MyProject\Controllers\SearchController::class, 'searchFunction'], // Роут для поиска http://web-store/search

    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'], // Роут для регистрации пользователей http://localhost:8080/users/register
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'], // Роут успешной активации пользователя  Где user_id и code взяты из таблицы users_activation_codes
    '~^users/login$~' => [\MyProject\Controllers\UsersController::class, 'login'], // Роут для авторизации пользователя http://localhost:8080/users/login
    '~^users/log-out$~' => [\MyProject\Controllers\UsersController::class, 'logOut'], // Роут для выхода пользователя http://localhost:8080/users/log-out
    '~^users/password-rec$~' => [\MyProject\Controllers\UsersController::class, 'passwordRec'], // Восстановление пароля http://localhost:8080/users/password_rec
    '~^users/password-rec/?hash=/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'passwordRec'], // Восстановление пароля http://localhost:8080/users/password-rec/?hash=...

    '~^order(.*)$~' => [\MyProject\Controllers\OrderController::class, 'order'], // Роут для заказа http://web-store/order
    '~^formOrder(.*)$~' => [\MyProject\Controllers\OrderController::class, 'formOrder'], // Роут для оформления заказа http://web-store/orderForm

    '~^news$~' => [\MyProject\Controllers\NewsController::class, 'newsFirstPage'], // Роут новостей
    '~^news/(\d+)$~' => [\MyProject\Controllers\NewsController::class, 'newsPage'], // Роут первой страницы новостей
    '~^news/(.+)/(\d+)/$~' => [\MyProject\Controllers\NewsController::class, 'view'], // Роут для просмотра товара
    '~^news/add$~' => [\MyProject\Controllers\NewsController::class, 'add'], // Роут для добавления товара
    '~^contact$~' => [\MyProject\Controllers\СontactController::class, 'contact'], // Роут страницы контактной информации

    '~^about$~' => [\MyProject\Controllers\AboutController::class, 'action'], // Роут страницы контактной информации
];
