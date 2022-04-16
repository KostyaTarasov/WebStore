<?php

namespace MyProject\Cli;

use MyProject\Exceptions\CliException;

// абстрактный класс, который будет заниматься тем, что будет сохранять переданные в него параметры и запускать метод для их проверки.
abstract class AbstractCommand
{
    /** @var array */
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->checkParams();
    }

    abstract public function execute();

    abstract protected function checkParams();

    protected function getParam(string $paramName)
    {
        return $this->params[$paramName] ?? null;
    }

    # метод для проверки в массиве нужных ключей.
    protected function ensureParamExists(string $paramName)
    {
        if (!isset($this->params[$paramName])) {
            throw new CliException('Param with name "' . $paramName . '" is not set!');
        }
    }
}
