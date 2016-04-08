<?php

namespace Group\Listeners;

use Group\Events\HttpEvent;
use Group\Events\KernalEvent;

class KernalResponseListener extends \Listener
{
    public function setMethod()
    {
        return 'onKernalResponse';
    }

    public function onKernalResponse(\Event $event)
    {	
    	$response = $event -> getResponse();
        if ($response instanceof \Response)
         	$response -> send();

        \EventDispatcher::dispatch(KernalEvent::HTTPFINISH, new HttpEvent($event -> getRequest(),$response));
    }
}
