<?php

namespace src\Web\Controller\User;

use src\Web\Controller\BaseController;
use Request;
use src\Web\Common\SimpleValidator;

class UserController extends BaseController
{   
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

    public function doLoginAction(Request $request)
    {      
        $user = $request -> request -> all();

        $res = D('User') -> getUserByMobile($user['mobile']);
        if (!$res) return $this -> createJsonResponse('', '账号或密码错误', 0);
        if ($res['password'] != md5($user['password'])) return $this -> createJsonResponse('', '账号或密码错误', 0);

        $user = D('User') -> getUserInfo($res['uid']);
        $token = D('Login') -> addLogin($res['uid']);
        $user['token'] = $token['token'];
        $user['token_etime'] = $token['etime'];
        return $this -> createJsonResponse($user, '登陆成功', 1);
    }

    public function detailAction(Request $request)
    {   
        $uid = $request -> query -> get('uid');
        $user = D('User') -> getUserInfo($uid);
        if ($user) return $this -> createJsonResponse($user, '', 1);
        return $this -> createJsonResponse('', '用户不存在', 0);
    }

    public function editAction(Request $request)
    {   
        $info = $request -> request -> all();
        $uid = $this -> isLogin($info['token']);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2); 
        
        if (isset($info['sex']) && !in_array($info['sex'], ['male', 'female'])) {
            return $this -> createJsonResponse('', '性别有误', 0);
        }

        if (isset($info['username']) && !SimpleValidator::nickname($info['username'])) {
            return $this->createJsonResponse('', '用户名3-20位，一个中文为2个字符', 0);
        }

        D('User') -> updateUserInfo($info, $uid);
        $user = D('User') -> getUserInfo($uid);
        return $this -> createJsonResponse($user, '更新成功', 1);
    }

    public function changePasswordAction(Request $request)
    {
        $token = $request -> request -> get('token');
        $uid = $this -> isLogin($token);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $user = $request -> request -> all();
        if (!SimpleValidator::password($user['old_password']) && !SimpleValidator::password($user['new_password'])) {
            return $this->createJsonResponse('', '密码格式不正确', 0);
        }

        if (D('User') -> updatePassword($uid, md5($user['old_password']), md5($user['new_password']))) {
            return $this->createJsonResponse('', '密码修改成功', 1);
        }
        return $this->createJsonResponse('', '密码修改失败', 0);
    }

    public function setAvatarAction(Request $request)
    {
        $info = $request -> request -> all();
        $uid = $this -> isLogin($info['token']);
        if (!$uid) return $this -> createJsonResponse('', '请登录', 2);

        $file = $request->files->get('avatar');
        $filenamePrefix = "user_{$uid}_";

        $hash = substr(md5($filenamePrefix . time()), -8);
        $ext = $file -> getClientOriginalExtension();
        if ($ext) {
            $ext = '.' . $ext;
        }

        $fileName = $filenamePrefix . $hash . $ext;

        $file = $file -> move(__ROOT__."asset/public/avatar", $fileName);

        $img = \Intervention\Image\ImageManagerStatic::make("asset/public/avatar/".$fileName);
        // resize image instance
        $img->resize(200, 200);
        // save image in desired format
        $img->save(__ROOT__."asset/public/avatar/".$filenamePrefix . $hash . '2X2' . $ext);

        D('User') -> updateUserAvatar($fileName, $uid);
        $user = D('User') -> getUserInfo($uid);
        return $this -> createJsonResponse($user, '头像更新成功', 1);
    }
}
