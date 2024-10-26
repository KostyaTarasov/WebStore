<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\Services\UsersAuthService;
use MyProject\Services\Message\DangerMessage;
use MyProject\Services\Message\SuccessMessage;

//* Контроллер для регистрации пользователей
class UsersController extends AbstractController
{
    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
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
                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php');
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
                echo '<meta http-equiv="refresh" content="0;url=/">';
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

    // Восстановление пароля
    public function passwordRec()
    {
        try {
            $email = $_POST['email'];
            if (User::checkEmail($email)) {
                $user = new User();
                $user->email = $email;
                // EmailSender::send($user, 'Восстановление пароля!', 'passwordRecovery.php', [ // Отправляем параметры в метод класса EmailSender
                //     'hash' => User::hash($email)
                // ]);
                
                //Todo создать в таблице users столбик с хешем восстановления пароля, по умолчанию null*/
                //Todo по открытой ссылке из почты, открывать страницу ввода email и нового пароля дважды (с проверкой email и совпадают ли пароли в двух полях, не пустые ли они)
                //Todo при этом проверять есть ли хеш на восстановление в бд, не пустой ли он. 
                //Todo обновить пароль
                //Todo по завершению удалять хеш (чтобы вновь ссылка не открывалась)
                //Todo авторизовать с помощью готового метода login() из UsersController.php желательно с нотисом об успешной смене пароля

                // Меняем хеш в БД
                // mysqli_query($db, "UPDATE `user` SET hash='$hash' WHERE email='$email'");
                // проверка отправилась ли почта
                // if (mail($email, "Восстановление пароля через Email", $message, $headers)) {
                //     Если да, то выводит сообщение
                //     echo 'Ссылка для восстановления пароля отправленная на вашу почту';
                // } else {
                //     echo 'Произошла какая то ошибка, письмо отправилось';
                // }

                //User::passwordRec($email);
                header('Location: /');
                exit();
            }
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('users/login.php', ['message' => new DangerMessage($e->getMessage())]);
            return;
        }
        $this->view->renderHtml('users/login.php');
    }
}
