<?php

use core\Group\Handlers\AliasLoaderHandler;
use core\Group\Config\Config;
use core\Group\Services\Service;
use Swoole\ClassMap;

// $loader = require __DIR__.'/vendor/autoload.php';

// $loader->setUseIncludePath(true);

define('APP_DIR', __DIR__);

if (!file_exists(__DIR__.'/Swoole/classCache.php')) {

    $classMap = new ClassMap();
    $classMap->doSearch();
}

$classMaps = include __DIR__.'/Swoole/classCache.php';

foreach ($classMaps as $key => $value) {
    var_dump($value);
    include_once $value;
}

$swoole = new Swoole();

$swoole -> start();

class Swoole
{
    protected $serv;

    public function __construct()
    {

        $this -> serv = new swoole_server("127.0.0.1", 9502);

        $this -> serv->set(array(
            'worker_num' => 4,   //工作进程数量
            'daemonize' => true, //是否作为守护进程
            'log_file' => __DIR__.'/Swoole/log/swoole.log',
            'task_worker_num' => 4
        ));


        $this -> serv -> on('connect', array($this, 'onConnect'));

        $this -> serv -> on('receive', array($this, 'onReceive'));

        $this -> serv -> on('start', array($this, 'onStart'));

        $this -> serv -> on('WorkerStart', array($this, 'onWorkerStart'));

        $this -> serv -> on('Task', array($this, 'onTask'));

        $this -> serv -> on('Finish', array($this, 'onFinish'));

        $this -> serv -> on('close', array($this, 'onClose'));

    }

    public function onConnect(swoole_server $serv, $fd)
    {

    }

    public function onReceive(swoole_server $serv, $fd, $from_id, $data)
    {
        $this -> serv -> task('wave');
        //$this -> serv ->send($fd, __DIR__.$data);
        $this -> serv ->close($fd);

    }

    public function onClose(swoole_server $serv, $fd)
    {
        // require __DIR__.'/core/Group/Services/Service.php';
        // $service = new Service();
        // $dao = $service -> createDao("Group:Group");
        // $dao -> waveDownCount();
    }

    public function onWorkerStart(swoole_server $serv, $worker_id)
    {

    }

    public function onTask(swoole_server $serv, $task_id, $from_id, $data)
    {
        $service = new Service();
        $dao = $service -> createDao("Group:Group");
        $dao -> waveCount();
    }

    public function onStart()
    {

    }

    public function onFinish()
    {

    }

    public function start()
    {
        $this -> serv ->start();
    }

}