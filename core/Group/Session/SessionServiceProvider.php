<?php

namespace Group\Session;

use ServiceProvider;
use Group\Session\SessionService;
use Symfony\Component\HttpFoundation\Session\Session as SfSession;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Group\Session\Handler\FileSessionHandler;
use Group\Session\Handler\RedisSessionHandler;
use Group\Session\Bag\MetadataBag;
use Group\Session\Bag\FlashBag;

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

            $storage = new NativeSessionStorage($this -> getOptions(), $this -> getHandler(), new MetadataBag());

            $session = new SfSession($storage, new AttributeBag('_group_attributes'), new FlashBag());

            if(!$session -> isStarted()) $session -> start();

            return new SessionService($session);
        });
    }

    /**
     * get Handler
     *
     * @return object
     */
    private function getHandler()
    {
        $driver = $this -> checkConfig();

        switch ($driver) {
            case 'redis':
                $handler = $this -> getRedisHandler();
                break;
            default:
                $handler = $this -> getFileHandler();
                break;
        }

        return $handler;
    }

    /**
     * redis Handler
     *
     * @return Group\Session\Handler\RedisSessionHandler handler
     */
    private function getRedisHandler()
    {
        $handler = new RedisSessionHandler($this -> app -> singleton('redis'));

        return $handler;
    }

    /**
     * file Handler
     *
     * @return Group\Session\Handler\FileSessionHandler handler
     */
    private function getFileHandler()
    {
        $handler = new FileSessionHandler(\Config::get("session::file"));

        return $handler;
    }

    /**
     * check config
     *
     * @return string
     */
    private function checkConfig()
    {
        $driver = \Config::get("session::driver");

        if ($driver == 'redis' && \Config::get("database::cache") != 'redis')
            throw new \RuntimeException("尚未开启redis cache");

        return $driver;
    }

    /**
     * get config options
     *
     * @return array
     */
    private function getOptions()
    {
        return [
            'cookie_lifetime' => \Config::get("session::cookie_lifetime"),
            'gc_maxlifetime'  => \Config::get("session::lifetime"),
        ];
    }
}
