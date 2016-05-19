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

        $start = $request -> request -> get('start');
        if (!$start) $start = 0;

        $groups = D('Groups') -> findGroupsByUid($uid, $start);
        if ($groups) return $this -> createJsonResponse($groups, '', 1);
        return $this -> createJsonResponse(null, '', 0);
    }

    public function listVisitsAction(Request $request)
    {
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $start = $request -> request -> get('start');
        if (!$start) $start = 0;

        $visits = D('Visit') -> findVisitsByUid($uid, $start);
        foreach ($visits as $key => &$visit) {
            $pet = D('Pet') -> getPet($visit['pid']);
            if ($pet) {
                $visit['pname'] = $pet['pname'];
                $visit['avatar'] = $pet['avatar'];
                $visit['sex'] = $pet['sex'];
                $visit['age'] = $pet['age'];
            } else {
                unset($visits[$key]);
            }
        }
        if ($visits) return $this -> createJsonResponse(array_values($visits), '', 1);
        return $this -> createJsonResponse(null, '', 0);
    }

    public function listOrdersAction(Request $request)
    {
        
    }

    public function listPetsAction(Request $request)
    {
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $start = $request -> request -> get('start');
        if (!$start) $start = 0;

        $pets = D('Pet') -> findPetsByUid($uid, $start);
        if ($pets) return $this -> createJsonResponse($pets, '', 1);
        return $this -> createJsonResponse(null, '', 0);
    }
}
