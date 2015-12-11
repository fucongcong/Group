<?php

use core\Group\Cron\ParseCrontab;
use core\Group\App\App;

class Cron
{
    protected $cacheDir = 'runtime/cron/';

    public function __construct()
    {

        $loader = require __ROOT__.'/vendor/autoload.php';

        $loader->setUseIncludePath(true);

        $app = new App();

        $app -> initSelf();

        $app -> registerServices();
var_dump($timer = ParseCrontab::parse('1 * * * * *'));die;
    }

    public function run()
    {
        $this -> checkStatus();

        $pid = posix_getpid();
        file_put_contents("runtime/pid", $pid);

        swoole_timer_tick(1000, function($timerId){

            $jobs = \Config::get('cron::job');

            foreach ($jobs as $job) {

                if (\FileCache::isExist($job['name'], $this -> cacheDir)) continue;

                $this -> bindTick($job);
            }
        });
    }

    public function bindTick($job)
    {
        $timer = ParseCrontab::parse($job['time']);

        if (empty($timer)) return;
        $timer = array_values($timer);

        call_user_func_array([new $job['command'], 'init'], []);

        swoole_timer_tick(intval($timer[0] * 1000), function($timerId, $job){

            call_user_func_array([new $job['command'], 'init'], []);

        }, $job);

        \FileCache::set($job['name'], ['time' => date('Y-m-d H:i:s', time() + intval($timer[0]))], $this -> cacheDir);
    }

    public function checkStatus()
    {
        if(file_exists("runtime/pid"))
        $pid = file_get_contents("runtime/pid");

        if ($pid) {
            if (swoole_process::kill($pid, 0)) {
                swoole_process::kill($pid, SIGUSR1);
                $filesystem = new \Filesystem();
                $filesystem -> remove($this -> cacheDir);
            }
        }
    }
}
