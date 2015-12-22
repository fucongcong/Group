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

    //系统会提前加载服务
    'serviceProviders' => [
        'core\Group\Redis\RedisServiceProvider',
        'core\Group\Cache\CacheServiceProvider',
        'core\Group\Cache\FileCacheServiceProvider',
        'core\Group\Session\SessionServiceProvider',
        'core\Group\Routing\RouteServiceProvider',
        'core\Group\EventDispatcher\EventDispatcherServiceProvider',
    ],

    //需要实例化的单例
    'singles' => [
        //like  'demo'       => 'src\demo\demo',
    ],

];