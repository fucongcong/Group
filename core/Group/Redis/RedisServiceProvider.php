<?php

namespace core\Group\Redis;

use ServiceProvider;
use Redis;

class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return object
     */
    public function register()
    {
        $this -> app -> singleton('redis', function () {

            if (\Config::get("database::cache") != 'redis') return;

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
