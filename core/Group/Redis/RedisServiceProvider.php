<?php

namespace core\Group\Redis;

use core\Group\Support\ServiceProvider;

class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('redis', function ($app) {
            return new Database($app['config']['database.redis']);
        });
    }

}
