<?php

namespace core\Group\Session\Handler;

class RedisSessionHandler implements \SessionHandlerInterface
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
        $this -> prefix = 'session_';
        $this -> ttl = 3600;
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
        return $this-> redis -> get($this -> prefix.$sessionId) ? : '';
    }

    /**
     * to do hash
     */
    public function write($sessionId, $data)
    {
        return $this -> redis -> set($this -> prefix.$sessionId, $data, $this -> ttl);
    }

    /**
     * to do hash
     */
    public function destroy($sessionId)
    {
        return $this -> redis -> set($this -> prefix.$sessionId, null);
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
