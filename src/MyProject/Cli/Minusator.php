<?php

namespace MyProject\Cli;

# из корня папки LearnPHP CLI: php bin/cli.php Minusator -a=25 -b=10
class Minusator extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists('a');
        $this->ensureParamExists('b');
    }

    public function execute()
    {
        echo $this->getParam('a') - $this->getParam('b');
    }
}