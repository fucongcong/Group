<?php

namespace core\Group\Events\Tests;

use Test;
use core\Group\EventDispatcher\EventDispatcher;
use core\Group\Events\Tests\TestSubscriber;

class EventSubscriberTest extends Test
{
    public function testAddSubscriber()
    {
        $subscriber = new TestSubscriber();

        EventDispatcher::addSubscriber($subscriber);

        $this -> assertTrue(EventDispatcher::hasListeners('test.start'));
        $this -> assertTrue(EventDispatcher::hasListeners('test.stop'));
        $this -> assertTrue(EventDispatcher::hasListeners('test.doing'));

        EventDispatcher::dispatch('test.start');
        EventDispatcher::dispatch('test.stop');
        EventDispatcher::dispatch('test.doing');

        EventDispatcher::removeSubscriber($subscriber);
    }

    public function testRemoveSubscriber()
    {
        $subscriber = new TestSubscriber();

        EventDispatcher::addSubscriber($subscriber);

        $this -> assertTrue(EventDispatcher::hasListeners('test.start'));
        $this -> assertTrue(EventDispatcher::hasListeners('test.stop'));
        $this -> assertTrue(EventDispatcher::hasListeners('test.doing'));

        EventDispatcher::removeSubscriber($subscriber);

        $this -> assertFalse(EventDispatcher::hasListeners('test.start'));
        $this -> assertFalse(EventDispatcher::hasListeners('test.stop'));
        $this -> assertFalse(EventDispatcher::hasListeners('test.doing'));
    }
}
