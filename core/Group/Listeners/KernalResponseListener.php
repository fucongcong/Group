<?php

namespace core\Group\Listeners;

use Event;

class KernalResponseListener extends \Listener
{
    public function setMethod()
    {
        return 'onKernalResponse';
    }

    public function onKernalResponse(Event $event)
    {
        $event -> getResponse() -> send();
    }
}
