<?php

namespace core\Group\Cache;

use ServiceProvider;
use core\Group\Cache\LocalFileCache;

class FileCacheServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return object
     */
    public function register()
    {
        $this -> app -> singleton('localFileCache', function () {

            return new LocalFileCache($this -> app);

        });
    }

}
