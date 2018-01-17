<?php
return [
    
    //是否为守护进程
    'daemon' => true,

    'cache_dir' => 'runtime/cron',

    'class_cache' => 'runtime/cron/bootstrap.class.cache',

    //log路径
    'log_dir' => 'runtime/cron',

    //定时器轮询周期，精确到秒
    'tick_time' => 2,

    //每个定时任务执行到达该上限时，该子进程会自动重启，释放内存
    'max_handle' => 5,

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