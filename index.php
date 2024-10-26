<?php
$title = "Главная страница";
?>
<?php
// Получает на вход адрес, а на выходе возвращает имя контроллера, метод и параметры.
// $startTime = microtime(true); // таймер генерации страницы
require __DIR__ . '/vendor/autoload.php';
try {
    $route = $_GET['route'] ?? ''; // имя экшена текущей страницы
    $routes = require __DIR__ . '/src/routes.php';
    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) { // Если страница не найдена (роут не найден)
        throw new \MyProject\Exceptions\NotFoundException(); // Бросаем исключение
    }

    if (strpos($matches[0], "catalog") !== false) { // Если каталоговая страница, то очищаем имя каталога из массива передаваемых значений в вызываемый контроллер
        unset($matches[1]);
    }
    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];
    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\MyProject\Exceptions\DbException $e) { // Ловим исключение если не подкл к базе данных
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e) { // Ловим исключение если нету такой страницы
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) { // Ловим исключение если пользователь не авторизован
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} catch (\MyProject\Exceptions\Forbidden $e) {  // Ловим исключение на странице добавления статей (так как пользователь с ролью user, создавать статьи можно только пользователям с ролью admin)
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
}

/* таймер генерации страницы
$endTime = microtime(true);
printf('<div style="text-align: center; padding: 5px">Время генерации страницы: %f</div>', $endTime - $startTime ); 
*/
?>
