<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\Services\UsersAuthService;
use MyProject\Services\Message\DangerMessage;
use MyProject\Services\Message\SuccessMessage;
/*
Нам нужно обработать данные, пришедшие от пользователя. 
Принимать данные из запроса мы будем внутри контроллера, однако вся логика по проверке этих данных будет находиться внутри модели пользователя. 
То есть принять данные из запроса – это всегда ответственность контроллера. Далее его задача – передать эти данные модели, 
чтобы она произвела с ними какие-то действия(проверила на валидность, сохранила в базу). 
Контроллеры не должны содержать в себе бизнес-логику (то есть то, как должны обрабатываться и храниться данные). 
За счет того, что такая логика всегда содержится в моделях, код становится проще реиспользовать (использовать в нескольких местах). 
Например, мы можем из разных контроллеров обращаться к одному и тому же коду, который хранится в модели.
*/

//* Контроллер для регистрации пользователей
class UsersController extends AbstractController
{
    public function signUp()
    {
        if (!empty($_POST)) { // если пришел POST-запрос
            # Обрабатываем исключения!
            try {
                $user = User::signUp($_POST); // вызываем метод из Модели в Контроллер.
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['message' => new DangerMessage($e->getMessage())]); // Передаём в шаблон переменную message содержащая имя вызванной ошибки (к примеру nickname если пользователь его не ввёл )
                return;
            }

            if ($user instanceof User) { // Если пользователь успешно создан
                $code = UserActivationService::createActivationCode($user);
                EmailSender::send($user, 'Добро пожаловать!', 'userActivation.php', [ // Отправляем параметры в метод класса EmailSender
                    'userId' => $user->getId(),
                    'code' => $code
                ]);
                $this->view->renderHtml('users/signUpSuccessful.php'); // Рендерим на форме регистрации информацию об успешной регистрации
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php'); // отрендерим шаблон
    }

    # Активация пользователя с выводом успешной регистрации (После подтверждения по почте)
    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);
        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
        if ($isCodeValid) {
            $user->activate();
            $this->view->renderHtml('messages/message.php', ['message' => new SuccessMessage("Активация прошла успешно!")]);
            self::login();
        } else $this->view->renderHtml('messages/message.php', ['message' => new DangerMessage("Произошла ошибка при активации аккаунта!")]);
    }

    # Авторизация пользователя
    public function login()
    {
        if (!empty($_POST)) {
            try { // Если логин введён правильный
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /'); // Открытие главной страницы сайта
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['message' => new DangerMessage($e->getMessage())]);
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }

    // Выход пользователя из учётной записи
    public function logOut()
    {
        setcookie('token', '', -1, '/', '', false, true);
        header('Location: /');
    }
}
