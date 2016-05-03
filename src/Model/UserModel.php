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
}