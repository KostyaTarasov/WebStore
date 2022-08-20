<?php

/*
Последовательность шагов, которые необходимо сделать для добавления новой страницы:

1. Добавляем экшн в контроллер (либо создаём ещё и новый контроллер);
2. Добавляем для него роут в routes.php;
3. Описываем логику внутри экшена и в конце вызываем у компонента view метод renderHtml();
4. Создаём шаблон для вывода результата.
*/

return [
    // ключи-регулярка для адреса, [имя контроллера, имя метода]
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
    '~^search(.*)$~' => [\MyProject\Controllers\SearchController::class, 'searchFunction'], // Роут для поиска http://learnphp/search

    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'], // Роут для регистрации пользователей http://localhost:8080/users/register
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'], // Роут успешной активации пользователя  Где user_id и code взяты из таблицы users_activation_codes
    '~^users/login~' => [\MyProject\Controllers\UsersController::class, 'login'], // Роут для авторизации пользователя http://localhost:8080/users/login
    '~^users/log-out~' => [\MyProject\Controllers\UsersController::class, 'logOut'], // Роут для выхода пользователя http://localhost:8080/users/login

    '~^order(.*)$~' => [\MyProject\Controllers\OrderController::class, 'order'], // Роут для заказа http://learnphp/order
    '~^formOrder(.*)$~' => [\MyProject\Controllers\OrderController::class, 'formOrder'],// Роут для оформления заказа http://learnphp/orderForm

    '~^news/(\d+)$~' => [\MyProject\Controllers\NewsController::class, 'newsPage'], // Роут новостей
    '~^news(.*)$~' => [\MyProject\Controllers\NewsController::class, 'newsFirstPage'], // Роут первой страницы новостей
    '~^contact$~' => [\MyProject\Controllers\СontactController::class, 'contact'], // Роут страницы контактной информации
];
