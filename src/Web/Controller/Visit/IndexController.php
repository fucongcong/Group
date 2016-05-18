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

        $pid = $visit['pid'];
        $pet = D('Pet') -> getPet($pid);
        if (!$pet || $pet['uid'] != $uid) return $this -> createJsonResponse('', '选择的宠物有误', 0);

        $visit['uid'] = $uid;
        $res = D('Visit') -> addVisit($visit);
        if ($res) {
            $visit = D('Visit') -> getVisit($res);
            $visit['pet'] = $pet;
            return $this -> createJsonResponse($visit, '添加成功', 1);
        }
        return $this -> createJsonResponse('', '添加失败', 0);
    }

    public function deleteVisitAction(Request $request)
    {
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $vid = $request -> request -> get('vid');

        $visit = D('Visit') -> getVisit($vid);
       
        if (!$visit || $visit['uid'] != $uid) return $this -> createJsonResponse('', '权限有误', 0);

        $res = D('Visit') -> deleteVisit($vid);
        if ($res) return $this -> createJsonResponse('', '删除成功', 1);
        return $this -> createJsonResponse('', '删除失败', 0);
    }
}