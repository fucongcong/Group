<?php
return [
    
    //是否为守护进程
    'daemon' => true,

    'cache_dir' => 'runtime/cron',

    'class_cache' => 'runtime/cron/bootstrap.class.cache',

    //log路径
    'log_dir' => 'runtime/cron',

    //定时器轮询周期，精确到毫秒
    'tick_time' => 1000,

    'job' => [

        [
            'name' => 'initUser',//任务名
            'time' => '*/1 * * * *',//定时规则 分 小时 天 周 月
            'command' => 'src\Web\Cron\InitUser',//执行的类库
        ],

        // [
        //     'name' => 'initUserForQueue',//任务名
        //     'time' => '*/2 * * * *',//定时规则 分 小时 天 周 月
        //     'command' => 'src\Web\Cron\initUserForQueue',//执行的类库
        // ],
    ],
];