<?php

class UserModel extends Model {

    public function addUser($user)
    {
        $user['username'] = mt_rand(1000, 9999);
        $user['password'] = md5($user['password']);
        $user['mobile'] = $user['mobile'];
        $user['ctime'] = time();
        return $this -> data($user) -> add();
    }

    public function isMobileRegister($mobile)
    {   
        $exist = $this -> where(['mobile' => $mobile]) -> count();
        if ($exist) return true;
        return false;
    }

    public function getUserByMobile($mobile)
    {
        return $this -> where(['mobile' => $mobile]) -> find();
    }

    public function getUserInfo($uid)
    {   
        $user = $this -> field('uid,username,sex,avatar') -> where(['uid' => $uid]) -> find();
        if (empty($user)) return [];
        $sex = [
            'male' => '男',
            'female' => '女'
        ];
        $user['sex'] = $sex[$user['sex']];
        return $user;
    }

    public function updateUserInfo($info, $uid)
    {
        if (isset($info['sex'])) $data['sex'] = $info['sex'];
        if (isset($info['username'])) $data['username'] = $info['username'];
        return $this -> data($data) -> where(['uid' => $uid]) -> save();
    }
}