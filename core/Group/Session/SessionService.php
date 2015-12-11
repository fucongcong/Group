<?php

namespace core\Group\Session;

use Symfony\Component\HttpFoundation\Session\Session as SfSession;

class SessionService
{
    protected $session;

    public function __construct(SfSession $session)
    {
        $this -> session = $session;
    }

    /**
     * 是否存在某个session
     *
     * @param name
     * @param default 默认值
     * @return string|array
     */
    public function get($name, $default = null)
    {
        return $this -> session -> get($name, $default);
    }

    /**
     * 是否存在某个session
     *
     * @param name
     * @param value
     */
    public function set($name, $value)
    {
        $this -> session -> set($name, $value);
    }

    /**
     * 是否存在某个session
     *
     * @param name
     * @return boolean
     */
    public function has($name)
    {
        return $this -> session -> has($name);
    }

    /**
     * 获取session
     *
     * @return array
     */
    public function all()
    {
        return $this -> session -> all();
    }

    /**
     * 获取sessionid
     *
     * @return string
     */
    public function getId()
    {
        return $this -> session -> getId();
    }

    /**
     * 清除session
     *
     */
    public function clear()
    {
        $this -> session -> clear();
    }

    /**
     * 移除某个seeion值
     *
     * @param name
     */
    public function remove($name)
    {
        $this -> session -> remove($name);
    }

    /**
     * session是否开启
     *
     * @return boolean
     */
    public function isStarted()
    {
        return $this -> session -> isStarted();
    }

    /**
     * 替换session的值
     *
     * @param attributes
     */
    public function replace(array $attributes)
    {
        $this -> session -> replace($attributes);
    }

    /**
     * 获取一个FlashBag
     *
     * @return core\Group\Session\Bag\FlashBag object
     */
    public function getFlashBag()
    {
        return $this -> session -> getFlashBag();
    }
}
