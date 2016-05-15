<?php

class UserModel extends Model {

    public function addUser($user)
    {
        $user['username'] = $user['username'];
        $user['password'] = md5($user['password']);
        $user['email'] = $user['email'];
        $user['ctime'] = time();
        return $this -> data($user) -> add();
    }

    public function isEmailRegister($email)
    {   
        $exist = $this -> where(['email' => $email]) -> count();
        if ($exist) return true;
        return false;
    }

    public function getUserByEmail($email)
    {
        return $this -> where(['email' => $email]) -> find();
    }

    public function getUserInfo($uid)
    {   
        $user = $this -> field('uid,username,sex,avatar,content,sign') -> where(['uid' => $uid]) -> find();
        if (empty($user)) return [];
        $sex = [
            'male' => '男',
            'female' => '女'
        ];
        $user['sex'] = $sex[$user['sex']];

        if (!empty($user['avatar'])) {
            $avater = explode(".", $user['avatar']);

            $user['avatar'] = "http://121.43.59.240/asset/public/avatar/".$avater[0]."2X2.".$avater[1];
        };
        return $user;
    }

    public function updateUserInfo($uid, $info)
    {   
         if (isset($info['sign'])) $data['sign'] = $info['sign'];
        if (isset($info['content'])) $data['content'] = $info['content'];
        if (isset($info['username'])) $data['username'] = $info['username'];
        if (!empty($data)) return $this -> data($data) -> where(['uid' => $uid]) -> save();
        return false;
    }

    public function updateUserAvatar($avatar, $uid)
    {
        return $this -> data(['avatar' => $avatar]) -> where(['uid' => $uid]) -> save();
    }

    public function updatePassword($uid, $password, $newPassword)
    {
        $user = $this -> where(['uid' => $uid]) -> find();
        if ($user) {
            if ($user['password'] == $password) {
                return $this -> data(['password' => $newPassword]) -> where(['uid' => $uid]) -> save();
            }
            return false;
        }
        return false;
    }
}
