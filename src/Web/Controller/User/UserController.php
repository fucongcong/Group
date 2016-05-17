<?php

namespace src\Web\Controller\User;

use src\Web\Controller\BaseController;
use Request;
use src\Web\Common\SimpleValidator;

class UserController extends BaseController
{   
    public function indexAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $user = D('User') -> getUserInfo($uid);

        $messageNum = D('message') -> getUnRead($uid);
        return $this -> render('Web/Views/User/info.html.twig',[
            'user' => $user,
            'messageNum' => $messageNum
            ]);
    }

    public function registerAction(Request $request)
    {   
        return $this -> render('Web/Views/User/register.html.twig');
    }

    public function doRegisterAction(Request $request)
    {   
        $user = $request -> request -> all();

        if (empty($user)) return $this -> createJsonResponse($user, '参数错误', 0);

        if (!SimpleValidator::truename($user['username'])) {
            return $this->createJsonResponse('', '姓名格式不正确', 0);
        }

        if (!SimpleValidator::email($user['email'])) {
            return $this->createJsonResponse('', '邮箱不正确', 0);
        }

        if (D('User') -> isEmailRegister($user['email'])) {
            return $this -> createJsonResponse('', '该邮箱已被注册', 0);
        }

        if (!SimpleValidator::password($user['password']) || !SimpleValidator::password($user['rePassword'])) {
            return $this->createJsonResponse('', '密码格式不正确', 0);
        }

        if ($user['password'] != $user['rePassword']) {
            return $this->createJsonResponse('', '两次密码不一致', 0);
        }

        if (D('User') -> addUser($user)) {
            $this -> setFlashMessage('info', '注册成功，请登录！');
            return $this -> createJsonResponse('', '注册成功', 1);
        }
        return $this -> createJsonResponse('', '注册失败', 0);
    }

    public function loginAction(Request $request)
    {   
        $messages = $this -> getFlashMessage();

        return $this -> render('Web/Views/User/login.html.twig', array(
            'messages' => $messages
            ));
    }

    public function followsAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');
       $follows = D('Follow') -> getFollows($uid);

       foreach ($follows as &$follow) {
            $follow['user'] = D('User') -> getUserInfo($follow['fuid']);
        }
        return $this -> render('Web/Views/User/follows.html.twig', array(
            'follows' => $follows
            ));
    }

    public function followerAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');
       $follows = D('Follow') -> getFollowers($uid);

       foreach ($follows as &$follow) {
            $follow['user'] = D('User') -> getUserInfo($follow['uid']);
        }
        return $this -> render('Web/Views/User/followers.html.twig', array(
            'follows' => $follows
            ));
    }

    public function doLoginAction(Request $request)
    {      
        $user = $request -> request -> all();

        if (empty($user['email']) || empty($user['password'])) return $this -> createJsonResponse('', '账号或密码不能为空', 0);

        $res = D('User') -> getUserByEmail($user['email']);
        if (!$res) return $this -> createJsonResponse('', '账号或密码错误', 0);
        if ($res['password'] != md5($user['password'])) return $this -> createJsonResponse('', '账号或密码错误', 0);

        \Session::set('uid', $res['uid']);

        return $this -> createJsonResponse('', '登陆成功', 1);
    }

    public function loginOutAction()
    {  
        \Session::clear();
        return $this -> redirect('/login');
    }

    public function infoAction($uid)
    {   
        $userId = $uid;
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $userInfo = D('User') -> getUserInfo($userId);
        $user = D('User') -> getUserInfo($uid);

        $is_follow = D('Follow') -> isFollow($uid, $userId);
        $groups = D('Groups') -> findGroupsByUid($userId, 0, 3);
        foreach ($groups as &$group) {
            $group['user'] = D('User') -> getUserInfo($group['uid']);
        }
        return $this -> render('Web/Views/User/userInfo.html.twig',[
            'user' => $user,
            'groups' => $groups,
            'is_follow' => $is_follow,
            'userInfo' => $userInfo
            ]);
    }

    public function changeInfoAction()
    {
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $user = D('User') -> getUserInfo($uid);
        return $this -> render('Web/Views/User/changeInfo.html.twig',[
            'user' => $user
            ]);
    }

    public function doChangeInfoAction(Request $request)
    {
        $uid = \Session::get('uid');
        if (!$uid) return $this->createJsonResponse('', 'not login', 0);

        $userInfo = $request -> request -> all();

        if (!SimpleValidator::truename($userInfo['username'])) {
            return $this->createJsonResponse('', '姓名格式不正确', 0);
        }

        D('User') -> updateUserInfo($uid, $userInfo);
        return $this->createJsonResponse('', 'success', 1);
    }

    public function followAction(Request $request)
    {   
        $fuid = $request -> request -> get('fuid');
        $uid = \Session::get('uid');
        if (!$uid) return $this->createJsonResponse('', 'not login', 0);

        if (intval($fuid) < 0) return $this->createJsonResponse('', 'uid error', 0);

        $res = D('Follow') -> addFollow($uid, $fuid);
        if ($res) return $this->createJsonResponse('', 'success', 1);
        return $this->createJsonResponse('', 'error', 0);
    }

    public function unfollowAction(Request $request)
    {   
        $fuid = $request -> request -> get('fuid');
        $uid = \Session::get('uid');
        if (!$uid) return $this->createJsonResponse('', 'not login', 0);

        if (intval($fuid) < 0) return $this->createJsonResponse('', 'uid error', 0);

        $res = D('Follow') -> unFollow($uid, $fuid);
        if ($res) return $this->createJsonResponse('', 'success', 1);
        return $this->createJsonResponse('', 'error', 0);
    }

    public function collectAction(Request $request)
    {
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $groups = D('GroupsCollect') -> getCollectByUid($uid);
        foreach ($groups as &$group) {
            $group = D('Groups') -> getGroup($group['gid']);
        }
 
        return $this -> render('Web/Views/User/collect.html.twig',[
            'groups' => $groups
            ]);
    }

    public function messageAddAction(Request $request)
    {
        $to_uid = $request -> request -> get('to_uid');
        $content = $request -> request -> get('content');
        $uid = \Session::get('uid');
        if (!$uid) return $this->createJsonResponse('', 'not login', 0);

        if (intval($to_uid) < 0 || $uid == $to_uid) return $this->createJsonResponse('', 'uid error', 0);

        $res = D('Message') -> addMessage($uid, $to_uid, $content);
        if ($res) return $this->createJsonResponse('', 'success', 1);
        return $this->createJsonResponse('', 'error', 0);
    }

    public function messageInfoAction(Request $request, $uid)
    {   
        $to_uid = $uid;

        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $messages = D('Message') -> listMessage($uid, $to_uid);

        $user = D('User') -> getUserInfo($to_uid);
        $users[$to_uid] = $user;
        $users[$uid] = D('User') -> getUserInfo($uid);

        return $this -> render('Web/Views/Message/post.html.twig',[
            'messages' => $messages,
            'user' => $user,
            'users' => $users
            ]);
    }

    public function messageListAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $messages = D('Message') -> findMessages($uid);

        foreach ($messages as &$message) {
            $message['user'] = D('User') -> getUserInfo($message['uid']);
            $message['content'] = getShort($message['content'], 15);
        }

        return $this -> render('Web/Views/User/message.html.twig',[
            'messages' => $messages,
            ]);
    }


    // public function editAction(Request $request)
    // {   
    //     $info = $request -> request -> all();
    //     $uid = $this -> isLogin($info['token']);
    //     if (!$uid) return $this -> createJsonResponse('', '请登录', 2); 
        
    //     if (isset($info['sex']) && !in_array($info['sex'], ['male', 'female'])) {
    //         return $this -> createJsonResponse('', '性别有误', 0);
    //     }

    //     if (isset($info['username']) && !SimpleValidator::nickname($info['username'])) {
    //         return $this->createJsonResponse('', '用户名3-20位，一个中文为2个字符', 0);
    //     }

    //     D('User') -> updateUserInfo($info, $uid);
    //     $user = D('User') -> getUserInfo($uid);
    //     return $this -> createJsonResponse($user, '更新成功', 1);
    // }

    // public function changePasswordAction(Request $request)
    // {
    //     $token = $request -> request -> get('token');
    //     $uid = $this -> isLogin($token);
    //     if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

    //     $user = $request -> request -> all();
    //     if (!SimpleValidator::password($user['old_password']) && !SimpleValidator::password($user['new_password'])) {
    //         return $this->createJsonResponse('', '密码格式不正确', 0);
    //     }

    //     if (D('User') -> updatePassword($uid, md5($user['old_password']), md5($user['new_password']))) {
    //         return $this->createJsonResponse('', '密码修改成功', 1);
    //     }
    //     return $this->createJsonResponse('', '密码修改失败', 0);
    // }

    // public function setAvatarAction(Request $request)
    // {
    //     $info = $request -> request -> all();
    //     $uid = $this -> isLogin($info['token']);
    //     if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

    //     $file = $request->files->get('avatar');
    //     $filenamePrefix = "user_{$uid}_";

    //     $hash = substr(md5($filenamePrefix . time()), -8);
    //     $ext = $file -> getClientOriginalExtension();
    //     if ($ext) {
    //         $ext = '.' . $ext;
    //     }

    //     $fileName = $filenamePrefix . $hash . $ext;

    //     $file = $file -> move(__ROOT__."asset/public/avatar", $fileName);

    //     $img = \Intervention\Image\ImageManagerStatic::make("asset/public/avatar/".$fileName);
    //     // resize image instance
    //     $img->resize(200, 200);
    //     // save image in desired format
    //     $img->save(__ROOT__."asset/public/avatar/".$filenamePrefix . $hash . '2X2' . $ext);

    //     D('User') -> updateUserAvatar($fileName, $uid);
    //     $user = D('User') -> getUserInfo($uid);
    //     return $this -> createJsonResponse($user, '头像更新成功', 1);
    // }
}
