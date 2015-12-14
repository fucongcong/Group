<?php
return [

    'cache_dir' => 'runtime/cron/',

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