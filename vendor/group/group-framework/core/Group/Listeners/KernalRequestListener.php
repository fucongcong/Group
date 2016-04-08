<?php

namespace Group\Listeners;

use Group\Events\HttpEvent;
use Group\Events\KernalEvent;
use Group\Session\CsrfSessionService;

class KernalRequestListener extends \Listener
{
    public function setMethod()
    {
        return 'onKernalRequest';
    }

    public function onKernalRequest(\Event $event)
    {	
    	$request = $event -> getRequest();
        
        if (strtoupper($request -> getMethod()) == "POST" && \Config::get("session::csrf_check")) {
            
            if (!$request -> request -> get('csrf_token')) {
                throw new \Exception("缺少csrf_token参数!", 1);
            }
            $csrfProvider = new CsrfSessionService();
            if (!$csrfProvider -> isCsrfTokenValid($request -> request -> get('csrf_token'))) {
                throw new \Exception("csrf_token参数验证失败!", 1);
            }
         
        }
    }
}
