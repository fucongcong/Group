<?php
return [
    'job' => [

        [
            'name' => 'SqlGenerate',//任务名
            'time' => '*/1 * * * *',//定时规则 分 小时 天 周 月
            'command' => 'core\Group\Cron\Tests\Test',//执行的类库
        ],

        [
            'name' => 'testSql',
            'time' => '*/2 * * * *',//定时规则 分 小时 天 周 月
            'command' => 'core\Group\Cron\Tests\TestSql',
        ]



    ],
];