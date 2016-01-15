<?php
return [

    //异步消息队列的配置

    'server' => [
        'host' => "127.0.0.1",
        'port' => 11300
    ],

    //log路径
    'log_dir' => 'runtime/queue',

    //tick队列任务的频率，精确到毫秒
    'timer' => 100,

    //类文件缓存
    'class_cache' => 'runtime/queue/bootstrap.class.cache',

    //处理队列任务
    'queue_jobs' => [

        [
            'tube' => 'testjob1',//队列的名称
            'job'  => 'src\Web\Queue\TestJob',//需要执行的任务
            //处理当前队列的进程数
            'task_worker_num' => 3,
        ],
        [
            'tube' => 'testjob3',//队列的名称
            'job'  => 'src\Web\Queue\TestJob',//需要执行的任务
            //处理当前队列的进程数
            'task_worker_num' => 1,
        ],
        [
            'tube' => 'testjob2',//队列的名称
            'job'  => 'src\Web\Queue\TestJob',//需要执行的任务
            //处理当前队列的进程数
            'task_worker_num' => 2,
        ]

    ],



    //这里是push到队列是需要用到的参数
    'priority' => 10,//该任务的重要程度，越小优先处理

    //延迟秒数
    'delaytime' => 0,

    //一个任务最多可以执行的秒数
    'lifetime' => 60,

];
