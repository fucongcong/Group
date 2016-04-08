<?php

namespace Group\Session\Handler;

use Group\Redis\RedisHelper;

class RedisSessionHandler extends \SessionHandler implements \SessionHandlerInterface 
{
    /**
     * @var \Redis Redis driver.
     */
    private $redis;

    /**
     * @var int Time to live in seconds
     */
    private $ttl;

    /**
     * @var string Key prefix for shared environments.
     */
    private $prefix;


    public function __construct(\Redis $redis)
    {
        $this -> prefix = \Config::get('session::prex');
        $this -> ttl = \Config::get('session::lifetime');
        $this -> redis = $redis;   
    }

    /**
     * {@inheritdoc}
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        return $this -> redis -> close();
    }

    /**
     * to do hash
     */
    public function read($sessionId)
    {
        list($hashKey, $key) = RedisHelper::hashKey($this -> prefix, $sessionId);

        return $this-> redis -> hGet($hashKey, $key) ? : '';
    }

    /**
     * to do hash
     */
    public function write($sessionId, $data)
    {
        list($hashKey, $key) = RedisHelper::hashKey($this -> prefix, $sessionId);

        $status = $this -> redis -> hSet($hashKey, $key, $data);

        $this -> redis -> expire($hashKey, $this -> ttl);

        return $status;
    }

    /**
     * to do hash
     */
    public function destroy($sessionId)
    {
        list($hashKey, $key) = RedisHelper::hashKey($this -> prefix, $sessionId);

        return $this -> redis -> hDel($hashKey, $key);
    }

    public function gc($maxlifetime)
    {
        // not required here because redis will auto expire the records anyhow.
        return true;
    }

    /**
     * Return a Redis instance.
     *
     * @return \Redis
     */
    protected function getRedis()
    {
        return $this -> redis;
    }
}
