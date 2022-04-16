<?php

namespace MyProject\Exceptions;

// Исключение для случаев, когда были переданы некорректные параметры или данные (К примеру "Не передан email") при авторизации).
class InvalidArgumentException extends \Exception
{
}
