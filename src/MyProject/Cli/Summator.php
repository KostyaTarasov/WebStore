<?php

namespace MyProject\Cli;

class Summator extends AbstractCommand
{
    # содержит бизнес-логику. В нем используется метод getParam(), который вернет параметр (при его наличии), либо вернет null (при его отсутствии).
    public function execute()
    {
        echo $this->getParam('a') + $this->getParam('b');
    }

    # проверяет наличие обязательных параметров для этого скрипта
    protected function checkParams()
    {
        $this->ensureParamExists('a'); // вызывается метод для проверки в массиве нужных ключей.
        $this->ensureParamExists('b');
    }
}
