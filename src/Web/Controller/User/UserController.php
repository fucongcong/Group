<?php

namespace src\Web\Controller\User;

use src\Web\Controller\BaseController;
use Request;
use src\Web\Common\SimpleValidator;

class UserController extends BaseController
{
    public function registerAction(Request $request)
    {   
        $user = $request->request->all();

        if (empty($user)) return $this -> createJsonResponse('', '参数错误', 0);

        if (!preg_match('/(13\d|14[57]|15[^4,\D]|17[678]|18\d)\d{8}|170[059]\d{7}/i', $user['mobile'])) {
            return $this -> createJsonResponse('', '手机号码不正确', 0);
        }

        if (!SimpleValidator::password($user['password'])) {
            return $this->createJsonResponse('', '密码格式不正确', 0);
        }

        if (D('User') -> isMobileRegister($user['mobile'])) {
            return $this -> createJsonResponse('', '该手机已被注册', 0);
        }

        if (D('User') -> addUser($user)) return $this -> createJsonResponse('', '注册成功', 1);

        return $this -> createJsonResponse('', '注册失败', 0);
    }

    public function loginAction(Request $request)
    {      
        $user = $request->request->all();

        $res = D('User') -> getUserByMobile($user['mobile']);
        if (!$res) return $this -> createJsonResponse('', '账号或密码错误', 0);
        if ($res['password'] != md5($user['password'])) return $this -> createJsonResponse('', '账号或密码错误', 0);

        $token = D('Login') -> addLogin($res['uid']);
        if ($token) return $this -> createJsonResponse(['token' => $token], '登陆成功', 1);
        return $this -> createJsonResponse('', '登陆失败', 0);
    }

    public function edit(Request $request)
    {   
        $info = $request->request->all();
        if (!$this -> isLogin($info['token'])) return $this -> createJsonResponse('', '请登录', 0); 
        

    }
}
