<?php
return [
    'job' => [

        [
            'name' => 'SqlGenerate',
            'time' => '* 1 * * * *',//定时规则
            'command' => 'core\Group\Cron\Tests\Test',
        ],

        [
            'name' => 'testSql',
            'time' => '* 1 * * * *',//定时规则
            'command' => 'core\Group\Cron\Tests\TestSql',
        ]



    ],
];