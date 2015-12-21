<?php

use core\Group\Cron\ParseCrontab;
use core\Group\App\App;

class Cron
{
    protected $cacheDir;

    /**
     * 初始化环境
     *
     */
    public function __construct()
    {
        $loader = require __ROOT__.'/vendor/autoload.php';
        $loader -> setUseIncludePath(true);

        $app = new App();
        $app -> initSelf();
        $app -> registerServices();

        $this -> cacheDir = \Config::get('cron::cache_dir') ? : 'runtime/cron/';
    }

    /**
     * 执行cron任务
     *
     */
    public function run()
    {
        $this -> checkStatus();

        $pid = posix_getpid();
        file_put_contents("runtime/pid", $pid);

        swoole_timer_tick(45000, function($timerId){

            $jobs = \Config::get('cron::job');

            foreach ($jobs as $job) {

                if (\FileCache::isExist($job['name'], $this -> cacheDir)) continue;

                $this -> bindTick($job);
            }
        });
    }

    /**
     * 绑定cron job
     *
     */
    public function bindTick($job)
    {
        $timer = ParseCrontab::parse($job['time']);

        if (is_null($timer)) return;

        call_user_func_array([new $job['command'], 'handle'], []);

        $job['timer'] = $timer;

        swoole_timer_tick(intval($timer * 1000), function($timerId, $job){

            call_user_func_array([new $job['command'], 'handle'], []);

            \FileCache::set($job['name'], ['nextTime' => date('Y-m-d H:i:s', time() + intval($job['timer']))], $this -> cacheDir);

        }, $job);

        \FileCache::set($job['name'], ['nextTime' => date('Y-m-d H:i:s', time() + intval($timer))], $this -> cacheDir);
    }

    /**
     * 将上一个进程杀死，并清除cron
     *
     */
    public function checkStatus()
    {
        if (file_exists("runtime/pid"))
        $pid = file_get_contents("runtime/pid");

        if (!empty($pid) && $pid) {
            if (swoole_process::kill($pid, 0)) {
                swoole_process::kill($pid, SIGUSR1);
                $filesystem = new \Filesystem();
                $filesystem -> remove($this -> cacheDir);
            }
        }
    }
}
