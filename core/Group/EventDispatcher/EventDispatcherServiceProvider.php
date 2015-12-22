<?php

namespace core\Group\EventDispatcher;

use ServiceProvider;
use core\Group\EventDispatcher\EventDispatcherService;
use core\Group\Listeners\KernalInitListener;

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
            $eventDispatcher -> addListener('kernal.init', new KernalInitListener());
            
            return $eventDispatcher;
        });
    }

}
