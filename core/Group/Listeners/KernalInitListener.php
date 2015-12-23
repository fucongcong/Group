<?php

namespace core\Group\Listeners;

use core\Group\Events\KernalEvent;
use core\Group\Exceptions\NotFoundException;

class KernalInitListener extends \Listener
{
    public function setMethod()
    {
        return 'onKernalInit';
    }

    public function onKernalInit(\Event $event)
    {
        $listeners = [
            [
                'eventName' => KernalEvent::RESPONSE,
                'listener'  => 'core\Group\Listeners\KernalResponseListener',
                'priority'  => 0,
            ],
            // [
            //     'eventName' => KernalEvent::REQUEST,
            //     'listener'  => 'core\Group\Listeners\KernalRequestListener',
            //     'priority'  => 0,
            // ],
            [
                'eventName' => KernalEvent::EXCEPTION,
                'listener'  => 'core\Group\Listeners\ExceptionListener',
                'priority'  => 0,
            ],
        ];

        $listeners = array_merge(\Config::get('listener::services'), $listeners);

        foreach ($listeners as $listener) {

            if (!class_exists($listener['listener'])) {

                throw new NotFoundException("Class ".$listener['listener']." not found !");
            }

            $lis = new $listener['listener'];

            if (!$lis instanceof Listener) {

                throw new \RuntimeException("Class ".$listener['listener']." must instanceof Listener !");
            }

            \EventDispatcher::addListener($listener['eventName'], $lis, $listener['priority']);
        }
    }
}
