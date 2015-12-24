<?php

namespace Group\Session\Handler;

use Group\Redis\RedisHelper;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;

class FileSessionHandler extends NativeFileSessionHandler
{
    public function __construct($savePath = null)
    {
        parent::__construct($savePath);
    }
}
