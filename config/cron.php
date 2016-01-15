<?php
return [

    'cache_dir' => 'runtime/cron',

    'class_cache' => 'runtime/cron/bootstrap.class.cache',

    //log路径
    'log_dir' => 'runtime/cron',

    //定时器轮询周期，精确到毫秒
    'tick_time' => 1000,

    'job' => [

        [
            'name' => 'TestLog',//任务名
            'time' => '*/1 * * * *',//定时规则 分 小时 天 周 月
            'command' => 'src\Web\Cron\Test',//执行的类库
        ],

        [
            'name' => 'testCache',
            'time' => '24 */2 * * *',//定时规则 分 小时 天 周 月
            'command' => 'src\Web\Cron\TestCache',
        ],

        [
            'name' => 'testSql',
            'time' => '*/2 * * * *',//定时规则 分 小时 天 周 月
            'command' => 'src\Web\Cron\TestSql',
        ],

    ],
];