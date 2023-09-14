<?php

namespace MyProject\Models\Users;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;

class User extends ActiveRecordEntity
{
    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $authToken;

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

    # будет принимать на вход массив с данными, пришедшими от пользователя, и будет пытаться создать нового пользователя и сохранить его в базе данных.
    public static function signUp(array $userData)
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }
        # Проверка данных на валидность
        if (!preg_match('/[a-zA-Z0-9]+/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
        }

        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) { // встроенная функция filter_var() , которая позволяет как валидировать, так и производить санитацию. FILTER_VALIDATE_EMAIL чтобы провалидировать email
            throw new InvalidArgumentException('Email некорректен');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }
        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }

        # Если пользователь имеется в БД то кидаем исключение
        if (static::findOneByColumn('nickname', $userData['nickname']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
        }
        if (static::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }

        # Если все проверки пройдены, то создаём нового пользователя
        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100)); // это специально случайным образом сгенерированный параметр, с помощью которого пользователь будет авторизовываться. 
        // После того как вошли на сайт не будет передаваться в cookie ни пароль, ни его хеш. 
        // Использование токена, который у каждого пользователя будет свой и он никак не будет связан с паролем – так безопаснее.
        $user->save(); // В конце метода сохраняем этого нового пользователя в базу (внутри через вызов метода insert

        return $user; // возвращаем пользователя из метода
    }

    # Активация пользователя с выводом успешной регистрации (После подтверждения по почте)
    public function activate(): void
    {
        $this->isConfirmed = true;
        $this->save();
    }

    # Авторизация пользователя (обработка отправленной формы)
    public static function login(array $loginData): User
    {
        if (empty($loginData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        $user = User::findOneByColumn('email', $loginData['email']); // Проверка, имеется ли email в базе данных SQL, равен ли введённому пользователем значению
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким email');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) { // в функцию password_verify() передаётся введенный пароль и хэш для пользователя. В результате вернётся false или true , в зависимости от того, правильный ли пароль.
            throw new InvalidArgumentException('Неправильный пароль');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('Пользователь не подтверждён');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    # Проверка email пользователя
    public static function checkEmail(string $email): bool
    {
        if (empty($email)) {
            throw new InvalidArgumentException('Не передан email');
        }

        $user = User::findOneByColumn('email', $email); // Проверка, имеется ли email в базе данных SQL, равен ли введённому пользователем значению
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким email');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('Пользователь не подтверждён');
        }

        return true;
    }

    # Восстановление пароля
    public static function hash(string $email)
    {
        // хешируем хеш, который состоит из email и времени
        return md5($email . time());

        // Для 
        // $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    # при успешном входе auth token пользователя в базе обновляется на новый – все его предыдущие сессии станут недействительными.
    public function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    // Возвращает true если роль admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
