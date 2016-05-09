<?php

namespace src\Web\Controller\User;

use src\Web\Controller\BaseController;
use Request;

class IndexController extends BaseController
{   
    public function listGroupsAction(Request $request)
    {   
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $groups = D('Groups') -> findGroupsByUid($uid, $start);
        if ($groups) return $this -> createJsonResponse($groups, '', 1);
        return $this -> createJsonResponse(null, '', 0);
    }

    public function listVisitsAction(Request $request)
    {
        
    }

    public function listOrdersAction(Request $request)
    {
        
    }

    public function listPetsAction(Request $request)
    {
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $pets = D('Pet') -> findPetsByUid($uid, $start);
        if ($pets) return $this -> createJsonResponse($pets, '', 1);
        return $this -> createJsonResponse(null, '', 0);
    }
}
