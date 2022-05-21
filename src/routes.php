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

    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'], // Роут страницы приветствия пользователя, где в конце адреса задаётся имя пользователя http://localhost:8080/hello/Kostya

    '~^catalog$~' => [\MyProject\Controllers\CatalogController::class, 'catalog'], // Роут страницы общего каталога

    '~^catalog/(.+)/(\d+)/$~' => [\MyProject\Controllers\ArticlesController::class, 'view'], // Роут для просмотра товара
    '~^catalog/(.+)/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'], // Роут для изменения товара
    '~^catalog/(.+)/(\d+)/del$~' => [\MyProject\Controllers\ArticlesController::class, 'del'], // Роут для удаления товара
    '~^catalog/(.+)/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'], // Роут для добавления товара

    '~^catalog/(.+)/page/(\d+)$~' => [\MyProject\Controllers\CatalogController::class, 'page'], // Роут страницы определённого каталога товаров   
    '~^catalog/(.+)$~' => [\MyProject\Controllers\CatalogController::class, 'firstPage'], // Роут первой страницы определённого каталога товаров

    '~^search/(\d+)$~' => [\MyProject\Controllers\SearchController::class, 'page'], // Роут для поиска
    '~^search(.*)$~' => [\MyProject\Controllers\SearchController::class, 'searchFunction'],                  // Роут для поиска               http://learnphp/search

    //TODO Поправить:    
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'], // Роут для регистрации пользователей                 http://localhost:8080/users/register
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'], // Роут успешной активации пользователя  Где user_id и code взяты из таблицы users_activation_codes
    '~^users/login~' => [\MyProject\Controllers\UsersController::class, 'login'],                   // Роут для авторизации пользователя     http://localhost:8080/users/login
    '~^users/logOut~' => [\MyProject\Controllers\UsersController::class, 'logOut'],                 // Роут для выхода пользователя          http://localhost:8080/users/login

    '~^buy(.*)$~' => [\MyProject\Controllers\BuyController::class, 'buyGoods'],                  // Роут для заказа товара                http://learnphp/buy
];
