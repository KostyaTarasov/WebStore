<?php

namespace MyProject\Cli;
/*
В "Планировщик заданий" Windows 10 выставлен автозапуск скрипта с повтором в определённое время файла
где Программа или сценарий: php,
Добавить аргументы: D:\Education\PHP\LearnPHP\bin\cli.php TestCron -x=20 -y=17
Является аналогом единоразового запуска программы из проекта команды: php bin\cli.php TestCron -x=20 -y=17
*/

class TestCron extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists('x');
        $this->ensureParamExists('y');
    }

    public function execute()
    {
        // чтобы проверить работу скрипта, будем записывать в файлик 1.log текущую дату и время
        file_put_contents('D:\Education\PHP\LearnPHP\www\debug\logs\1.log', date(DATE_ISO8601) . PHP_EOL, FILE_APPEND);
    }
}
