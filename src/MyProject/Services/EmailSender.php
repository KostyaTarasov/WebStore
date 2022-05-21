<?php
//* Cервис, который будет предназначен для отправки email-сообщений.
namespace MyProject\Services;

use MyProject\Models\Users\User;


class EmailSender
{
    public static function send(
        User $receiver, // принимается параметр $user из класса UsersController
        string $subject, // принимается тема письма 'Добро пожаловать!'
        string $templateName, // принимается 'userActivation.php' для открытия формы активации аккаунта
        array $templateVars = [] // принимается массив с именами userId и code
    ): void {
        extract($templateVars);

        ob_start();
        require __DIR__ . '/../../../templates/mail/' . $templateName; // Путь к файлу userActivation.php
        $body = ob_get_contents(); // Текст для письма берём из буффера, который получен из файла userActivation.php
        ob_end_clean();

        mail($receiver->getEmail(), $subject, $body, 'From: mixtmneon@gmail.com' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n");
    }
}
