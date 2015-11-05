<?php

namespace core\Group\Support;

use NotFoundException;

abstract class ServiceProvider
{
    protected $app;

    abstract function register();

}
