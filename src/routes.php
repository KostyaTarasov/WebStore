<?php

/*
Последовательность шагов, которые необходимо сделать для добавления новой страницы:

1. Добавляем экшн в контроллер (либо создаём ещё и новый контроллер);
2. Добавляем для него роут в routes.php;
3. Описываем логику внутри экшена и в конце вызываем у компонента view метод renderHtml();
4. Создаём шаблон для вывода результата.
*/

return [
    // При создании нового файла, класса, метода прописываем информацию в этом файле
    // ключи-регулярка для адреса, [имя контроллера, имя метода]

    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],  // Роут главной станицы (первой страницы со статьями)
    '~^(\d+)$~' => [\MyProject\Controllers\MainController::class, 'page'], // Роут страниц конкретного каталога


    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'], // Роут страницы приветствия пользователя, где в конце адреса задаётся имя пользователя http://localhost:8080/hello/Kostya

    '~^catalog$~' => [\MyProject\Controllers\CatalogController::class, 'catalog'],
    '~^catalog/(.+)/page/(\d+)$~' => [\MyProject\Controllers\CatalogController::class, 'page'], // Роут страниц конкретного каталога

    '~^catalog/(.+)/(\d+)/$~' => [\MyProject\Controllers\ArticlesController::class, 'view'], // Роут страницы конкретного товара
    '~^catalog/(.+)/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'], // Роут для изменения статей
    '~^catalog/(.+)/(\d+)/del$~' => [\MyProject\Controllers\ArticlesController::class, 'del'], // Роут для удаления статей
    '~^catalog/(.+)/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'], // Роут для добавления статей




    //TODO Поправить:
    '~^search/(\d+)$~' => [\MyProject\Controllers\SearchController::class, 'page'], // Роут конкретной страницы указанного номера c выводом до 5 статей    
    '~^search(.*)$~' => [\MyProject\Controllers\SearchController::class, 'searchFunction'],                  // Роут для поиска статей                http://learnphp/search

    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'], // Роут для регистрации пользователей                 http://localhost:8080/users/register
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'], // Роут успешной активации пользователя  http://localhost:8080/users/15/activate/9cfc33d83a2aef14058ecf1f850a73e1 Где user_id = 15 и code = длинный код в конце url взяты из таблицы users_activation_codes
    '~^users/login~' => [\MyProject\Controllers\UsersController::class, 'login'],                   // Роут для авторизации пользователя     http://localhost:8080/users/login
    '~^users/logOut~' => [\MyProject\Controllers\UsersController::class, 'logOut'],                 // Роут для выхода пользователя          http://localhost:8080/users/login

    '~^buy(.*)$~' => [\MyProject\Controllers\BuyController::class, 'buyGoods'],                  // Роут для заказа товара                http://learnphp/buy
];
