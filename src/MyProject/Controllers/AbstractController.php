<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;
use MyProject\Models\Articles\Catalog;

abstract class AbstractController
{
    /** @var View */
    protected $view;

    /** @var User|null */
    protected $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken(); // токен юзера
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user); // задаём нужные переменные во View (имя пользователя авторизованного, для отображения имени пользователя на странице конкретной статьи)
        $this->view->setVar('cpuCatalogs', Catalog::getCPU()); // задаём нужные переменные во View (имя пользователя авторизованного, для отображения имени пользователя на странице конкретной статьи)
    }

    # функционал чтения входных данных для JSON:
    protected function getInputData()
    {
        return json_decode(
            file_get_contents('php://input'),
            true
        );
    }
}
