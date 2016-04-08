<?php

namespace Group\Routing;

use ServiceProvider;
use Group\Routing\RouteService;

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
