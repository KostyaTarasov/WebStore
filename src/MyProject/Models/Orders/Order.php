<?php

namespace MyProject\Models\Orders;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\EmailSender;
use MyProject\Models\Users\User;

# наследуемся от ActiveRecordEntity
class Order extends ActiveRecordEntity
{
    public function __construct()
    {
        $this->email = "kostet-karate@yandex.ru";
    }

    public function setEmail($name1): string // Устанавливаем новое значение для свойства $this->name
    {
        return $this->email = $name1;
    }

    # Возвращает имя таблицы: users, где хранятся пользователи.
    protected static function getTableName(): string // необходим для реализации потому что объявлен абстрактно в классе родителе ActiveRecordEntity
    {
        return 'users';
    }

    public static function checkOrder()
    {
        # Проверки на то, что все данные были переданы
        if (empty($_POST['nickname'])) { // если пустое значение
            throw new InvalidArgumentException('Необходимо заполнить поле: "Имя"'); // вызываем исключение
        }

        if (empty($_POST['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // встроенная функция filter_var() , которая позволяет как валидировать, так и производить санитацию. FILTER_VALIDATE_EMAIL чтобы провалидировать email
            throw new InvalidArgumentException('Email некорректен');
        }

        # Проверки на то, что все данные были переданы
        if (empty($_POST['phone'])) { // если пустое значение
            throw new InvalidArgumentException('Необходимо заполнить поле: "Телефон"'); // вызываем исключение
        }
        # Проверка данных на валидность
        if (!preg_match('/[0-9]+/', $_POST['phone'])) {
            throw new InvalidArgumentException('Поле "Телефон" может состоять только из цифр');
        }
        self::mailOrder();
    }

    public static function mailOrder()
    {
        $user = new User();
        $user->email = $_POST['email'];
        $date = new \DateTime('now', new \DateTimeZone('EUROPE/Moscow'));
        $date->format('d-m-Y H:i:s');
        EmailSender::send($user, 'Добро пожаловать!', 'orderMessage.php', [ // Отправляем параметры в метод класса EmailSender
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'date' => $date->format('d-m-Y H:i:s'),
        ]);
    }
}
