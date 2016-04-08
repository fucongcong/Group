<?php

namespace Group\Cron;

use Group\Cron\ParseCrontab;
use Group\App\App;
use Group\Cache\BootstrapClass;
use swoole_process;

class Cron
{
    protected $cacheDir;

    /**
     * 定时器轮询周期，精确到毫秒
     *
     */
    protected $tickTime;

    protected $argv;

    protected $loader;

    protected $jobs;

    protected $workerNum;

    protected $workers;

    protected $workerPids;

    protected $classCache;

    protected $logDir;

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
\033[33m Usage: app/cron [start|restart|stop] \033[0m
";
    /**
     * 初始化环境
     *
     */
    public function __construct($argv, $loader)
    {
        $this -> cacheDir = \Config::get('cron::cache_dir') ? : 'runtime/cron';
        $this -> cacheDir = $this -> cacheDir."/";
        $this -> tickTime = \Config::get('cron::tick_time') ? : 1000;
        $this -> argv = $argv;
        $this -> loader = $loader;
        $this -> jobs = \Config::get('cron::job');
        $this -> workerNum = count($this -> jobs);
        $this -> classCache = \Config::get("cron::class_cache"); 
        $this -> logDir = \Config::get("cron::log_dir"); 
        \Log::$cache_dir = $this -> logDir;
    }

    /**
     * 执行cron任务
     *
     */
    public function run()
    {   
        $this -> checkArgv();

        $this -> bootstrapClass();
    }

    public function start()
    {
        $this -> checkStatus();
        \Log::info("定时服务启动", [], 'cron');
        //将主进程设置为守护进程
        swoole_process::daemon(true);

        //设置信号
        $this -> setSignal();

        //启动N个work工作进程
        $this -> startWorkers();

        swoole_timer_tick($this -> tickTime, function($timerId) {
            foreach ($this -> jobs as $job) {
                if (\FileCache::isExist($job['name'], $this -> cacheDir)) continue;

                $this -> workers[$job['name']]['process'] -> write(json_encode($job));
                //$this -> bindTick($job);
            }
        });

        $this -> setPid();
    }

    public function restart()
    {
        $this -> stop();
        sleep(1);
        $this -> start();
    }

    /**
     * 将上一个进程杀死，并清除cron
     *
     */
    public function stop()
    {
        $pid = $this -> getPid();

        if (!empty($pid) && $pid) {
            if (swoole_process::kill($pid, 0)) {
                //杀掉worker进程
                foreach (\FileCache::get('work_ids', $this -> cacheDir) as $work_id) {
                    swoole_process::kill($work_id, SIGKILL);
                }
            }   
        }
    }

    /**
     * 设置信号监听
     *
     */
    private function setSignal()
    {   
        //子进程结束时主进程收到的信号
        swoole_process::signal(SIGCHLD, function ($signo) {
            //kill掉所有worker进程 必须为false，非阻塞模式
            static $worker_count = 0;
            while($ret = swoole_process::wait(false)) {
                $worker_count++;
                \Log::info("PID={$ret['pid']}worker进程退出!", [], 'cron');
                if ($worker_count >= $this -> workerNum){
                    \Log::info("主进程退出!", [], 'cron');
                    unlink($this -> logDir."/work_ids");
                    unlink($this -> logDir."/pid");
                    foreach ($this -> jobs as $job) {
                        unlink($this -> cacheDir.$job['name']);
                    }
                    swoole_process::kill($this -> getPid(), SIGKILL); 
                }
            }   
        });

    }

    /**
     * 启动worker进程处理定时任务
     *
     */
    private function startWorkers()
    {   
        //启动worker进程
        for ($i = 0; $i < $this -> workerNum; $i++) { 
            $process = new swoole_process(array($this, 'workerCallBack'), true);
            $processPid = $process->start();

            $this -> setWorkerPids($processPid);

            $this -> workers[$this -> jobs[$i]['name']] = [
                'process' => $process,
                'job' => $this -> jobs[$i],
            ];

            \Log::info("工作worker{$processPid}启动", [], 'cron.work');    
        }
    }

    /**
     * 检查输入的参数与命令
     *
     */
    protected function checkArgv()
    {
        $argv = $this -> argv;
        if (!isset($argv[1])) die($this -> help);

        if (!in_array($argv[1], ['start', 'restart', 'stop'])) die($this -> help);

        $function = $argv[1];
        $this -> $function();
    }

    public function workerCallBack(swoole_process $worker)
    {   
        swoole_event_add($worker -> pipe, function($pipe) use ($worker) { 
            $recv = $worker -> read(); 
            $recv = json_decode($recv, true);
            if (!is_array($recv)) return;

            $this -> bindTick($recv);
                    
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

        swoole_timer_tick(intval($timer * 1000), function($timerId, $job) {
            call_user_func_array([new $job['command'], 'handle'], []);

            \FileCache::set($job['name'], ['nextTime' => date('Y-m-d H:i:s', time() + intval($job['timer']))], $this -> cacheDir);

        }, $job);

        \FileCache::set($job['name'], ['nextTime' => date('Y-m-d H:i:s', time() + intval($timer))], $this -> cacheDir);
         \Log::info('定时任务启动'.$job['name'], [], 'cron.start');
    }

    private function checkStatus()
    {
        if ($this -> getPid()) {
            if (swoole_process::kill($this -> getPid(), 0)) {
                exit('定时服务已启动！');
            }
        }
    }

    /**
     * 设置worker进程的pid
     *
     * @param pid int
     */
    private function setWorkerPids($pid)
    {
        $this -> workerPids[] = $pid;
        \FileCache::set('work_ids', $this -> workerPids, $this -> cacheDir);
    }

    public function setPid()
    {
        $pid = posix_getpid();
        $parts = explode('/', $this -> cacheDir."pid");
        $file = array_pop($parts);
        $dir = '';
        foreach ($parts as $part) {
            if (!is_dir($dir .= "$part/")) {
                 mkdir($dir);
            }
        }
        file_put_contents("$dir/$file", $pid);
    }

    public function getPid()
    {
        if (file_exists($this -> cacheDir."pid"))
        return file_get_contents($this -> cacheDir."pid");
    }

    /**
     * 缓存类文件
     *
     */
    private function bootstrapClass()
    {
        $classCache = new BootstrapClass($this -> loader, $this -> classCache);
        foreach ($this -> jobs as $job) {
            $classCache -> setClass($job['command']); 
        }
        $classCache -> bootstrap();
        
        require $this -> classCache;
    }
}
