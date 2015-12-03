<?php
return [

    // prod|dev
    'environment' => 'prod',

    //zh|en|fr...
    'locale' => 'zh',

    //时区
    'timezone' => 'Asia/Shanghai',

    //类的映射
    'aliases' => [
        //like  'demo'       => 'src\Service\demo',
    ],

    //系统会提前加载服务
    'serviceProviders' => [
        'core\Group\Redis\RedisServiceProvider',
        'core\Group\Cache\CacheServiceProvider',
        'core\Group\Cache\FileCacheServiceProvider',
    ],

    //需要实例化的单例
    'singles' => [
        //like  'demo'       => 'src\demo\demo',
    ],

];