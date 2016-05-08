<?php

namespace src\Web\Controller\Group;

use src\Web\Controller\BaseController;
use Request;

class PostController extends BaseController
{
    public function addPostAction(Request $request)
    {
        $post = $request -> request -> all();
        $group = D('Groups') -> getGroup($post['gid']);
        if (empty($group)) return $this -> createJsonResponse('', '帖子不存在', 0);

        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        if (trim($post['content']) == "") return $this -> createJsonResponse($post, '回复内容不能为空', 0);

        $post['uid'] = $uid;
        $post['gid'] = $post['gid'];
        $res = D('GroupsPost') -> addPost($post);
        if ($res) return $this -> createJsonResponse($group, ' 回复成功', 1);
        return $this -> createJsonResponse('', ' 回复失败', 0);
    }

    public function deletePostAction(Request $request)
    {
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $post = $request -> request -> all();
        $post = D('GroupsPost') -> getPost($post['gp_id']);
        if (empty($post)) return $this -> createJsonResponse('', '回复不存在', 0);

        $group = D('Groups') -> getGroup($post['gid']);
        if ($post['uid'] != $uid || $group['uid'] != $uid) return $this -> createJsonResponse('', '没有删除权限', 0);

        D('GroupsPost') -> deletePost($post['gp_id']);
        return $this -> createJsonResponse('', '删除成功', 1);
    }

    public function listPostsAction(Request $request)
    {   
        $gid = $request -> query -> get('gid');
        $start = $request -> query -> get('start');
        if (!$start) $start = 0;

        $posts = D('GroupsPost') -> findPosts($gid, $start);
        if (empty($posts)) return $this -> createJsonResponse(null, '', 0);
        foreach ($posts as &$post) {
            $user = D('User') -> getUserInfo($post['uid']);
            $post['username'] = $user['username'];
            $post['user_avatar'] = $user['avatar'];
        }
        return $this -> createJsonResponse($posts, '', 1);
    }
}
