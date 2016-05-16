<?php

namespace src\Web\Controller\Group;

use src\Web\Controller\BaseController;
use Request;

class IndexController extends BaseController
{
    public function listAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $key = $request -> query -> get('key');
        if (!$key) $key = '';

        $groups = D('Groups') -> findGroups($start, 10, $key);

        foreach ($groups as &$group) {
            $group['user'] = D('User') -> getUserInfo($group['uid']);
        }
        return $this -> render('Web/Views/Group/list.html.twig', [
            'groups' => $groups,
            'key' => $key
            ]);
    }

    public function listGroupsAction(Request $request)
    {
        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $key = $request -> query -> get('key');
        if (!$key) $key = '';

        $groups = D('Groups') -> findGroups($start, 10, $key);

        foreach ($groups as &$group) {
            $group['user'] = D('User') -> getUserInfo($group['uid']);
        }

        return $this -> render('Web/Views/Group/list-ajax.html.twig', [
            'groups' => $groups,
            ]);
    }

    public function postAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        return $this -> render('Web/Views/Group/post.html.twig');
    }

    public function addGroupAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) $this -> createJsonResponse('', '未登录', 0);

        $group = $request -> request -> all();

        if (empty($group) || !isset($group['title']) || !isset($group['content'])) return $this -> createJsonResponse($group, '缺少参数', 0);

        if (trim($group['title']) == "" || trim($group['content']) == "") return $this -> createJsonResponse($group, '标签或内容不能为空', 0);

        $group['uid'] = $uid;

        $res = D('Groups') -> addGroup($group);
        $group = D('Groups') -> getGroup($res);
        if ($res) return $this -> createJsonResponse($group, ' 发布成功', 1);
        return $this -> createJsonResponse('', ' 发布失败', 0);
    }

    public function detailAction(Request $request, $gid)
    { 
        $uid = \Session::get('uid');
        $group = D('Groups') -> getGroup($gid);
        
        if (empty($group)) return $this -> redirect('/list');
        $group['user'] = D('User') -> getUserInfo($group['uid']);

        $is_colloect = D('GroupsCollect') -> isCollect($uid, $gid);

        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $posts = D('GroupsPost') -> findPosts($gid, $start);
        foreach ($posts as &$post) {
            $post['user'] = D('User') -> getUserInfo($post['uid']);
        }
        return $this -> render('Web/Views/Group/detail.html.twig',[
            'group' => $group,
            'posts' => $posts,
            'is_colloect' => $is_colloect
            ]);
    }

    public function scarfAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $groups = D('Groups') -> findGroupsByUid($uid, 0, 3);
        foreach ($groups as &$group) {
            $group['user'] = D('User') -> getUserInfo($group['uid']);
        }
    
        return $this -> render('Web/Views/Group/scarf.html.twig',[
            'groups' => $groups,
            ]);
    }

    public function addCollectAction(Request $request)
    {
        $gid = $request -> request -> get('gid');
        $uid = \Session::get('uid');
        if (!$uid) return $this->createJsonResponse('', 'not login', 0);

        if (intval($gid) < 0) return $this->createJsonResponse('', 'gid error', 0);

        $res = D('GroupsCollect') -> addCollect($uid, $gid);
        if ($res) return $this->createJsonResponse('', 'success', 1);
        return $this->createJsonResponse('', 'error', 0);
    }

    public function unCollectAction(Request $request)
    {
        $gid = $request -> request -> get('gid');
        $uid = \Session::get('uid');
        if (!$uid) return $this->createJsonResponse('', 'not login', 0);

        if (intval($gid) < 0) return $this->createJsonResponse('', 'gid error', 0);

        $res = D('GroupsCollect') -> unCollect($uid, $gid);
        if ($res) return $this->createJsonResponse('', 'success', 1);
        return $this->createJsonResponse('', 'error', 0);
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




}
