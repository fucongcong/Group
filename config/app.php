<?php
return [

    // prod|dev
    'environment' => 'dev',

    //zh|en|fr...
    'locale' => 'zh',

    //时区
    'timezone' => 'Asia/Shanghai',

    //类的映射
    'aliases' => [
        //like  'demo'       => 'src\Service\demo',
    ],

    'serviceProviders' => [
        'core\Group\Redis\RedisServiceProvider',
        'core\Group\Cache\CacheServiceProvider',
    ],

    //需要实例化的单例
    'singles' => [
        //like  'demo'       => 'src\demo\demo',
    ],

];