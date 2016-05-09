<?php

namespace src\Web\Controller\Visit;

use src\Web\Controller\BaseController;
use Request;

class IndexController extends BaseController
{
    public function addVisitAction(Request $request)
    {
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $visit = $request -> request -> all();
    }
}