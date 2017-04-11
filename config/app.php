<?php
return [

    // prod|dev
    'environment' => 'dev',

    //只有在dev环境下才生效。tip: swoole http server下无法正常debug
    'debug' => true,

    //zh|en|fr...
    'locale' => 'zh',

    //时区
    'timezone' => 'Asia/Shanghai',

    //类的映射
    'aliases' => [
        'Model'       => 'core\Model\Model',
    ],

    //系统会提前加载服务
    'serviceProviders' => [
        'Group\Redis\RedisServiceProvider',
        'Group\Cache\CacheServiceProvider',
        'Group\Cache\FileCacheServiceProvider',
        'Group\Session\SessionServiceProvider',
        'Group\Routing\RouteServiceProvider',
        'Group\EventDispatcher\EventDispatcherServiceProvider',
        'Group\Queue\QueueServiceProvider',
        //'Group\Rpc\RpcServiceProvider',  //开启后提供rpc服务  需要安装swoole
    ],

    //需要实例化的单例
    'singles' => [
        //like  'demo'       => 'src\demo\demo',
    ],

    //扩展console命令行控制台
    'console_commands' => [
        'log:clear' => [
            'command' => 'src\Web\Command\LogClearCommand', //执行的类
            'help' => '清除日志', //提示
        ],
    ],

    'DB_TYPE' => 'mysqli', // 数据库类型
    'DB_HOST' => "127.0.0.1", // 数据库服务器地址
    'DB_NAME' => 'scarf', // 数据库名称
    'DB_USER' => 'root', // 数据库用户名
    'DB_PWD' => '123', // 数据库密码
    'DB_PORT' => '3306', // 数据库端口
    'DB_CHARSET' => 'utf8', //数据库编码方式

    //当使用swoole http server 时，需要指定host,port
    'swoole_host' => '127.0.0.1',
    'swoole_port' => 9777,
    'swoole_setting' => [
        'reactor_num' => 4,
        'worker_num' => 25,    //worker process num
        'backlog' => 128,   //listen backlog
        'max_request' => 2000,
        'heartbeat_idle_time' => 30,
        'heartbeat_check_interval' => 10,
        'dispatch_mode' => 3, 
    ],
];