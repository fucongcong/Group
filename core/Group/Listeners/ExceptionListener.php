<?php

namespace core\Group\Listeners;

use Response;
use core\Group\Events\HttpEvent;
use core\Group\Events\KernalEvent;

class ExceptionListener extends \Listener
{
    public function setMethod()
    {
        return 'onException';
    }

    public function onException(\Event $event)
    {   
        $response = new Response($event -> getTrace(), 500);
        \EventDispatcher::dispatch(KernalEvent::RESPONSE, new HttpEvent($response));
    }
}
