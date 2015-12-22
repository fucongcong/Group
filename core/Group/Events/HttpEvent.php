<?php

namespace core\Group\Events;

use Response;

class HttpEvent extends \Event
{
    protected $response;

    public function __construct(Response $response)
    {
        $this -> response = $response;
    }

    public function getResponse()
    {
        return $this -> response;
    }
}
