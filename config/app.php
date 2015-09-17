<?php
return [

    // prod|dev
    'environment' => 'dev',

    //时区
    'timezone' => 'PRC',

    //类的映射
    'aliases' => [

        'App'       => 'core\Group\App\App',
        'Cache'     => 'core\Group\Cache\Cache',
        'Config'    => 'core\Group\Config\Config',
        'Container' => 'core\Group\Container\Container',
        'Route'     => 'core\Group\Routing\Route',

    ],

];