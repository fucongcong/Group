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

];