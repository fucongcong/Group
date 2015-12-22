<?php

namespace core\Group\Events;

use Event;

class ExceptionEvent extends Event
{
    protected $error;

    public function __construct($error)
    {
        $this -> error = $error;
    }

    public function getError()
    {
        return $this -> error;
    }
}
