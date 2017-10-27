<?php

namespace src\Web\Listeners;

use Listener;
use Event;
use Firebase\JWT\JWT;
use Config;
use Session;

class KernalRequestListener extends Listener
{
    public function setMethod()
    {
        return 'onKernalRequest';
    }

    public function onKernalRequest(Event $event)
    {
        $request = $event->getRequest();
        $app['request'] = $request;
        $app['env'] = app('container')->getEnvironment();

        $userId = $this->getUserId($request);
        if ($userId) {
            $user = $this->getUserService()->getUser($userId);
            if ($user) {
                app('container')->setContext('userId', $userId);
                app('container')->setContext('user', $user);
                $app['userId'] = $userId;
                $app['user'] = $user;
                app()->singleton('twig')->addGlobal('app', $app);
                return;
            }
        }

        app('container')->setContext('userId', 0);
        app('container')->setContext('user', []);
        $app['userId'] = 0;
        $app['user'] = [];
        app()->singleton('twig')->addGlobal('app', $app);
    }

    private function getUserId($request)
    {   
        return Session::get('uid');
    }

    public function getUserService()
    {   
        return app()->singleton('service')->createService("User:User");
    }
}

