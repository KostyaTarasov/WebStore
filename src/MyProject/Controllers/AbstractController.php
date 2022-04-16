<?php

/*
Абстрактный контроллер, чтобы не дублировать код в контроллерах.

Достаточно просто отнаследоваться в наших контроллерах от этого класса и можно удалить в них конструкторы и свойства private view и private user – они будут унаследованы от AbstractController. 
Это существенно упростит их код.
*/

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

abstract class AbstractController
{
    /** @var View */
    protected $view; // свойства view и  user теперь с типом protected – они будут доступны в наследниках

    /** @var User|null */
    protected $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken(); // токен юзера
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user); // задаём нужные переменные во View (имя пользователя авторизованного, для отображения имени пользователя на странице конкретной статьи)
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
