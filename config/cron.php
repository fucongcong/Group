<?php
return [
    
    //是否为守护进程
    'daemon' => true,

    'timezone' => "PRC",

    //log路径
    'log_dir' => 'runtime/cron',

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