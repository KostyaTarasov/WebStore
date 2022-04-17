<?php


// Давайте повторим последовательность шагов, которые необходимо сделать для добавления новой странички:

// 1. Добавляем экшн в контроллер (либо создаём ещё и новый контроллер);
// 2. Добавляем для него роут в routes.php;
// 3. Описываем логику внутри экшена и в конце вызываем у компонента view метод renderHtml();
// 4. Создаём шаблон для вывода результата.


return [
    // При создании нового файла, класса, метода прописываем информацию в этом файле
    // ключи-регулярка для адреса, [имя контроллера, имя метода]

    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'], // Роут страницы приветствия пользователя, где в конце адреса задаётся имя пользователя http://localhost:8080/hello/Kostya
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],  // Роут главной станицы (первой страницы со статьями)
    '~^(\d+)$~' => [\MyProject\Controllers\MainController::class, 'page'], // Роут конкретной страницы указанного номера c выводом до 5 статей                   http://localhost:8080/4
    '~^search/(\d+)$~' => [\MyProject\Controllers\SearchController::class, 'page'], // Роут конкретной страницы указанного номера c выводом до 5 статей
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'], // Роут страницы открытия конкретной статьи          http://localhost:8080/articles/1
    '~^articles/edit/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'], // Роут для изменения статей                    http://localhost:8080/articles/edit/5
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'], // Роут для добавления статей                           http://localhost:8080/articles/add
    '~^articles/del/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'del'], // Роут для удаления статей                       http://localhost:8080/articles/del/5

    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'], // Роут для регистрации пользователей                 http://localhost:8080/users/register
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'], // Роут успешной активации пользователя  http://localhost:8080/users/15/activate/9cfc33d83a2aef14058ecf1f850a73e1 Где user_id = 15 и code = длинный код в конце url взяты из таблицы users_activation_codes
    '~^users/login~' => [\MyProject\Controllers\UsersController::class, 'login'],                   // Роут для авторизации пользователя     http://localhost:8080/users/login
    '~^users/logOut~' => [\MyProject\Controllers\UsersController::class, 'logOut'],                 // Роут для выхода пользователя          http://localhost:8080/users/login

    '~^search(.*)$~' => [\MyProject\Controllers\SearchController::class, 'searchFunction'],                  // Роут для поиска статей                http://learnphp/search

    '~^articles/image.php$~' => [\MyProject\Controllers\LoadImageController::class, 'loadImage'],
];
