<?php
return [

    // prod|dev
    'environment' => 'dev',

    //时区
    'timezone' => 'Asia/Shanghai',

    //类的映射
    'aliases' => [
        //like  'demo'       => 'src\Service\demo',
    ],

    'serviceProviders' => [
        'core\Group\Redis\RedisServiceProvider',
    ],

    //需要实例化的单例
    'singles' => [
        //like  'demo'       => 'src\demo\demo',
    ],

];