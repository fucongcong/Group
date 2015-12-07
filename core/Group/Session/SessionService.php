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

    public function get($name, $default = null)
    {
        return $this -> session -> get($name, $default);
    }

    public function set($name, $value)
    {
        $this -> session -> set($name, $value);
    }

    public function has($name)
    {
        return $this -> session -> has($name);
    }

    public function all()
    {
        return $this -> session -> all();
    }

    public function getId()
    {
        return $this -> session -> getId();
    }

    public function clear()
    {
        return $this -> session -> clear();
    }

    public function remove($name)
    {
        return $this -> session -> remove($name);
    }

    public function isStarted()
    {
        return $this -> session -> isStarted();
    }

    public function replace(array $attributes)
    {
        return $this -> session -> replace($attributes);
    }

    public function getFlashBag()
    {
        return $this -> session -> getFlashBag();
    }
}
