<?php
return [
    
    'cache_dir' => 'runtime/rpc',

    'current_server' => 'tcp',
     
    'server' => [
        //连接类型
        'tcp' => [

            'host' => '127.0.0.1',
            'port' => '9396',
        ],

        'http' => [

            'host' => '127.0.0.1',
            'port' => '9397',
        ],

        'ws' => [

            'host' => '127.0.0.1',
            'port' => '9394',
        ],
    ],

    'setting' => [
        'reactor_num' => 4,
        'worker_num' => 25,    //worker process num
        'backlog' => 128,   //listen backlog
        'max_request' => 2000,
        'heartbeat_idle_time' => 30,
        'heartbeat_check_interval' => 10,
        'dispatch_mode' => 3, 
    ],
];