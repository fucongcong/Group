<?php

namespace core\Group\Redis;

use ServiceProvider;
use Redis;

class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this -> app -> singleton('redis', function () {

            $redis = new Redis;
            $config = \Config::get("database::redis");
            $redis -> pconnect($config['default']['host'], $config['default']['port']);
            if (isset($config['default']['auth'])){
                $redis -> auth($config['default']['auth']);
            }
            $redis -> setOption(Redis::OPT_PREFIX, isset($config['default']['prefix']) ? $config['default']['prefix'] : '');

            return $redis;
        });
    }

}
