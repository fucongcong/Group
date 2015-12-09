<?php

namespace core\Group\EventDispatcher;

use core\Group\Contracts\EventDispatcher\EventDispatcher as EventDispatcherContract;
use Listener;
use Event;

class EventDispatcherService implements EventDispatcherContract
{
    protected $listeners = [];

    protected $sorted = [];

    public function dispatch($eventName, Event $event = null)
    {
        if (empty($event)) $event = new Event;

        $this -> setEvents($eventName);

        if (isset($this -> listeners[$eventName])) {

            $this -> doDispatch($eventName, $event);
        }

        return $event;
    }

    public function addListener($eventName, $listener, $priority = 0)
    {
        $this -> listeners[$eventName][$priority][] = $listener;
        $this -> sortEvents($eventName);
    }

    public function removeListener($eventName, $listener)
    {
       if (!isset($this->listeners[$eventName])) {
            return;
        }

        foreach ($this->listeners[$eventName] as $priority => $listeners) {
            if (false !== ($key = array_search($listener, $listeners, true))) {
                unset($this->listeners[$eventName][$priority][$key]);
            }
        }
    }

    public function sortEvents($eventName)
    {
        if (isset($this->listeners[$eventName])) {

            krsort($this->listeners[$eventName]);
            $this -> sorted[$eventName] = call_user_func_array('array_merge', $this->listeners[$eventName]);
        }
    }

    public function setEvents($eventName)
    {
        if (!isset($this -> sorted[$eventName]))
            $this -> sorted[$eventName] = [];
    }

    public function getListeners($eventName = null)
    {
        if (isset($eventName)) {

            return isset($this -> sorted[$eventName]) ? $this -> sorted[$eventName] : null;
        }

        return $this -> sorted;
    }

    public function hasListeners($eventName = null)
    {
        if (isset($eventName)) {

            return isset($this -> sorted[$eventName]) ? true : false;
        }

        return empty($this -> sorted) ? false : true;
    }

    public function doDispatch($eventName, $event)
    {
        $listeners = $this -> sorted[$eventName];

        foreach ($listeners as $listener) {

            if (is_callable($listener, false)) {

                call_user_func($listener, $event);
            }

            if ($listener instanceof Listener) {

                call_user_func_array([$listener, $listener -> getMethod()], [$event]);
            }
        }

    }
}
