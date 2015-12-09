<?php

namespace core\Group\Contracts\EventDispatcher;

use Event;

interface EventDispatcher
{
    public function dispatch($eventName, Event $event = null);

    public function addListener($eventName, $listener, $priority = 0);

    public function removeListener($eventName, $listener);

    public function getListeners($eventName = null);

    public function hasListeners($eventName = null);
}
