<?php

namespace core\Group\Routing;

use ServiceProvider;
use core\Group\Routing\RouteService;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return object
     */
    public function register()
    {
        $this -> app -> singleton('route', function () {

            return RouteService::getInstance();
        });
    }

}
