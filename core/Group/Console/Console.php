<?php
namespace core\Group\Console;

class Console
{
    protected $argv;

    protected $options = [
        'generate:service' => 'core\Group\Console\Command\GenerateServiceCommand',
        'generate:controller' => 'core\Group\Console\Command\GenerateControllerCommand',
        'sql:generate' => 'core\Group\Console\Command\SqlGenerateCommand',
        'sql:migrate' => 'core\Group\Console\Command\SqlMigrateCommand',
    ];

    protected $help = <<<EOF

使用帮助:
Usage: core/console [options] [args...]

generate:service  name      生成一个自定义service
generate:controller  name   生成一个自定义controller
sql:generate                生成一个sql执行模板
sql:migrate                 执行sql模板


EOF;

    public function __construct($argv)
    {
        $this -> argv = $argv;
    }

    public function run()
    {
        $this -> checkArgv();
        die($this -> help);
    }

    protected function checkArgv()
    {
        $argv = $this -> argv;
        if(!isset($argv[1])) return;
        $options = $this -> options;
        if(!isset($options[$argv[1]])) {

            $this -> help = "输入的命令有误！\n";
            return;
        }

        $command = new $options[$argv[1]];
        $command -> setArgv($argv);
        $command -> init();
        die;
    }
}