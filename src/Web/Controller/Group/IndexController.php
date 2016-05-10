<?php

namespace src\Web\Controller\Group;

use src\Web\Controller\BaseController;
use Request;

class IndexController extends BaseController
{
    public function addGroupAction(Request $request)
    {
        $group = $request -> request -> all();

        if (empty($group) || !isset($group['title']) || !isset($group['content'])) return $this -> createJsonResponse($group, '参数错误', 0);

        if (trim($group['title']) == "" || trim($group['content']) == "") return $this -> createJsonResponse($group, '参数不能为空', 0);

        $uid = $this -> isLogin($group['token']);
        $group['uid'] = $uid;
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $res = D('Groups') -> addGroup($group);
        $group = D('Groups') -> getGroup($res);
        if ($res) return $this -> createJsonResponse($group, ' 发布成功', 1);
        return $this -> createJsonResponse('', ' 发布失败', 0);
    }

    public function editGroupAction(Request $request)
    {
        $group = $request -> request -> all();

        if (empty($group) || !isset($group['title']) || !isset($group['content'])|| !isset($group['gid'])) return $this -> createJsonResponse($group, '参数错误', 0);

        if (trim($group['title']) == "" || trim($group['content']) == "") return $this -> createJsonResponse($group, '参数不能为空', 0);

        $uid = $this -> isLogin($group['token']);
        $ogroup = D('Groups') -> getGroup($group['gid']);

        if ($ogroup['uid'] != $uid) {
            return $this -> createJsonResponse('', '没有权限编辑', 0);
        }

        $res = D('Groups') -> updateGroup($group['gid'], $group);
        if ($res) return $this -> createJsonResponse('', ' 更新成功', 1);
        return $this -> createJsonResponse('', ' 更新失败', 0);
    }

    public function deleteGroupAction(Request $request)
    {
        $gid = $request -> request -> get('gid');

        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        $group = D('Groups') -> getGroup($gid);

        if ($group['uid'] != $uid) {
            return $this -> createJsonResponse('', '没有权限编辑', 0);
        }

        $res = D('Groups') -> deleteGroup($gid);
        if ($res) return $this -> createJsonResponse('', ' 删除成功', 1);
        return $this -> createJsonResponse('', ' 删除失败', 0);
    }

    public function dingGroupAction(Request $request)
    {
        $gid = $request -> request -> get('gid');
        $group = D('Groups') -> getGroup($gid);
        if (empty($group)) return $this -> createJsonResponse('', '帖子不存在', 0);

        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        D('GroupsDing') -> ding($gid, $uid);
        return $this -> createJsonResponse('', '点赞成功', 1);
    }

    public function unDingGroupAction(Request $request)
    {
        $gid = $request -> request -> get('gid');
        $group = D('Groups') -> getGroup($gid);
        if (empty($group)) return $this -> createJsonResponse('', '帖子不存在', 0);

        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        D('GroupsDing') -> unDing($gid, $uid);
        return $this -> createJsonResponse('', '取消赞成功', 1);
    }

    public function listGroupsAction(Request $request)
    {
        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $groups = D('Groups') -> findGroups($start);

        foreach ($groups as &$group) {
            $user = D('User') -> getUserInfo($group['uid']);
            $group['username'] = $user['username'];
            $group['user_avatar'] = $user['avatar'];
        }
        if (empty($groups)) return $this -> createJsonResponse(null, '', 0);
        return $this -> createJsonResponse($groups, '', 1);
    }

    public function detailAction(Request $request)
    {
        $gid = $request -> request -> get('gid');
        $group = D('Groups') -> getGroup($gid);
        $user = D('User') -> getUserInfo($group['uid']);
        $group['username'] = $user['username'];
        $group['user_avatar'] = $user['avatar'];

        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if ($uid) {
            
            $is_ding = D('GroupsDing') -> isDing($gid, $uid);
            if ($is_ding) {
                $group['is_ding'] = true;
            } else {
                $group['is_ding'] = false;
            }
        }

        if (empty($group)) return $this -> createJsonResponse('', '帖子不存在', 0);
        return $this -> createJsonResponse($group, '', 1);
    }
}
