<?php
$title = "Главная страница";
?>

<?php
// $startTime = microtime(true); // таймер генерации страницы
require __DIR__ . '/vendor/autoload.php'; // Для загрузки пакетов, которые были скачаны composer-ом.

try {
    // Вывод примера автозагрузки файлов. Урок doc24Autoloading.php //ООП в PHP (webshake.ru) файла: '10 Пространства имён и автозагрузка классов в PHP _ WebShake.RU.html'
    // Когда не используем композер, то
    // spl_autoload_register(function (string $className) { // Функция называется анонимной – у неё нет имени. Она просто передаётся в качестве аргумента и имя ей не нужно.
    //     require_once __DIR__ . './src/' . $className . '.php';
    // });
    // $author = new \MyProject\Models\Users\User('Иван');
    // var_dump($author);
    // $article = new \MyProject\Models\Articles\Article('Заголовок', 'Текст', $author);
    // var_dump($article);

    // Для контроллера (webshake.ru Controller в MVC)
    // $controller = new \MyProject\Controllers\MainController();
    // if (!empty($_GET['name'])) { // Если в адресной строке: http://localhost:3000/?name=Иван
    //     $controller->sayHello($_GET['name']); // Передаём в метод sayHello значение Иван из адресной строки
    // } else {
    //     $controller->main(); // Вызываем метод по умолчанию, Привет, Гость
    // }

    //var_dump($_GET['route']);

    //$route = $_GET['route'] ?? '';
    // $pattern = '~^hello/(.*)$~';
    // preg_match($pattern, $route, $matches);
    // if (!empty($matches)) {
    //     $controller = new \MyProject\Controllers\MainController();
    //     $controller->sayHello($matches[1]);
    //     return;
    // }

    // $pattern = '~^$~'; /// переменная route будет пустой строкой для адреса http://localhost:8080/ без hello/. Регулярка для такого случая - ^$. Да, просто начало строки и конец строки.
    // preg_match($pattern, $route, $matches);
    // if (!empty($matches)) {
    //     $controller = new \MyProject\Controllers\MainController();
    //     $controller->main();
    //     return;
    // }

    $route = $_GET['route'] ?? ''; // имя экшена текущей страницы
    $routes = require __DIR__ . './src/routes.php'; // Все руты из файла routes.php

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    // if (!$isRouteFound) { // Этот код работает, когда не нужен нужный роутинг. Это ведь тоже исключительная ситуация!
    //     echo 'Страница не найдена!';
    //     return;
    // }
    if (!$isRouteFound) { // Если страница не найдена (роут не найден)
        throw new \MyProject\Exceptions\NotFoundException(); // Бросаем исключение
    }

    $matches = array_slice($matches, -1, 1); // Срез массива, иначе передадутся лишние значения в вызываемый метод контроллера

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);

    //var_dump($routes); // Отображается массив

    //echo 'Страница не найдена'; // Если адрес не http://localhost:8080/hello/

    // нужно создать такую систему, которая будет на вход получать адрес, а на выходе возвращать имя контроллера, метод и параметры.
    // для универсальности: отдельный файл с такой конфигурацией. Пусть это будет файл src/routes.php
    // var_dump($_GET['route']);

} catch (\MyProject\Exceptions\DbException $e) { // Ловим исключение если не подкл к базе данных
    $view = new \MyProject\View\View(__DIR__ . './templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e) { // Ловим исключение если нету такой страницы
    $view = new \MyProject\View\View(__DIR__ . './templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) { // Ловим исключение если пользователь не авторизован
    $view = new \MyProject\View\View(__DIR__ . './templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} catch (\MyProject\Exceptions\Forbidden $e) {  // Ловим исключение на странице добавления статей (так как пользователь с ролью user, создавать статьи можно только пользователям с ролью admin)
    $view = new \MyProject\View\View(__DIR__ . './templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
}

/* таймер генерации страницы
$endTime = microtime(true);
printf('<div style="text-align: center; padding: 5px">Время генерации страницы: %f</div>', $endTime - $startTime ); 
*/
?>