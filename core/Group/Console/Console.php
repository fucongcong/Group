<?php

namespace Group\Console;

class Console
{
    protected $argv;

    /**
     * 命令的定义集合
     *
     */
    protected $options = [
        'generate:service' => 'Group\Console\Command\GenerateServiceCommand',
        'generate:controller' => 'Group\Console\Command\GenerateControllerCommand',
        'sql:generate' => 'Group\Console\Command\SqlGenerateCommand',
        'sql:migrate' => 'Group\Console\Command\SqlMigrateCommand',
    ];

    protected $help = "
\033[34m
 ----------------------------------------------------------

     -----        ----      ----      |     |   / ----
    /          | /        |      |    |     |   |      |
    |          |          |      |    |     |   | ----/
    |   ----   |          |      |    |     |   |
     -----|    |            ----       ----     |

 ----------------------------------------------------------
\033[0m
\033[31m 使用帮助: \033[0m
\033[33m Usage: core/console [options] [args...] \033[0m

\033[32m generate:service name \033[0m      生成一个自定义service
\033[32m generate:controller  name \033[0m   生成一个自定义controller
\033[32m sql:generate\033[0m                生成一个sql执行模板(存放于app/sql)
\033[32m sql:migrate   [default|write|read|all]\033[0m \033[33m[name]\033[0m  参数可不填，执行sql模板(默认会向default服务器执行.\033[33m第二个参数只有当第一个参数为write|read时，才会生效,如果不填，默认为write|read下面所有服务器\033[0m)


";

    public function __construct($argv)
    {
        $this -> argv = $argv;
    }

    /**
     * run the console
     *
     */
    public function run()
    {
        $this -> checkArgv();
        die($this -> help);
    }

    /**
     * 检查输入的参数与命令
     *
     */
    protected function checkArgv()
    {
        $argv = $this -> argv;
        if (!isset($argv[1])) return;
        $options = $this -> options;
        if (!isset($options[$argv[1]])) {

            $this -> help = "\033[31m错误的命令！\033[0m\n";
            return;
        }

        $command = new $options[$argv[1]];
        $command -> setArgv($argv);
        $command -> init();
        die;
    }
}
