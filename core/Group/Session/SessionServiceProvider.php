<?php

namespace core\Group\Session;

use ServiceProvider;
use Symfony\Component\HttpFoundation\Session\Session as SfSession;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use core\Group\Session\Handler\RedisSessionHandler;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return object
     */
    public function register()
    {
        $this -> app -> singleton('session', function () {

            $storage = new NativeSessionStorage($this -> getOptions(), $this -> getHandle());

            $session = new SfSession($storage);
            $session -> start();

            return $session;
        });
    }

    /**
     * 现在只有redis
     *
     * @return core\Group\Session\Handler\RedisSessionHandler handler
     */
    private function getHandle()
    {
        if (\Config::get("database::cache") != 'redis') return null;

        $handler = new RedisSessionHandler($this -> app -> singleton('redis'));

        return $handler;
    }

    private function getOptions()
    {
        return [];
    }
}