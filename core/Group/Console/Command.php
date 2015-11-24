<?php
namespace core\Group\Console;

abstract class Command
{
    protected $argv;

    abstract function init();

    public function setArgv($argv)
    {
        array_shift($argv);
        array_shift($argv);
        $this -> argv = $argv;
    }

    public function getArgv()
    {
        return $this -> argv;
    }

    public function outPut($info)
    {
        echo $info."\n";
    }
}