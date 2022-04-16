<?php
# фронт-контроллер для API

require __DIR__ . '/../../vendor/autoload.php';
/*
$entity = [
    'kek' => 'cheburek',
    'lol' => [
        'foo' => 'bar'
    ]
];
header('Content-type: application/json; charset=utf-8');

 // позволяет представить какую-то сущность в json-формате
 // чтобы удобнее было в браузере видеть ответ стоит установить в браузере расширение https://chrome.google.com/webstore/detail/json-formatter/bcjindcccaagfpapjjmafapmmgkkhgoa?hl=en

echo json_encode($entity);
*/

try {
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../../src/routes_api.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \MyProject\Exceptions\NotFoundException('Route not found');
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->displayJson(['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->displayJson(['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->displayJson(['error' => $e->getMessage()], 401);
}
