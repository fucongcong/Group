<?php

namespace core\Group\EventDispatcher;

use ServiceProvider;
use core\Group\EventDispatcher\EventDispatcherService;
use core\Group\Listeners\KernalInitListener;
use core\Group\Events\KernalEvent;

class EventDispatcherServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return object
     */
    public function register()
    {
        $this -> app -> singleton('eventDispatcher', function () {

            $eventDispatcher = new EventDispatcherService();
            $eventDispatcher -> addListener(KernalEvent::INIT, new KernalInitListener());
            
            return $eventDispatcher;
        });
    }

}
