<?php

namespace core\Group\Session\Tests;

use Test;
use core\Group\EventDispatcher\EventDispatcher;
use Listener;
use core\Group\Listeners\KernalResponseListener;
use core\Group\Events\HttpEvent;
use Response;

class EventDispatcherTest extends Test
{
    public function testinit()
    {
        $listener = new KernalResponseListener();

        EventDispatcher::addListener('kernal.responese', $listener, 10);

        $this -> assertTrue(EventDispatcher::hasListeners('kernal.responese'));
        $object = EventDispatcher::getListeners('kernal.responese');
        $this -> assertTrue($object[0] instanceof KernalResponseListener);
        EventDispatcher::addListener('kernal.request', function($event){
            //do something
        }, 100);
        $event = new HttpEvent(new Response());
        EventDispatcher::dispatch('kernal.responese', $event);

    }
}
