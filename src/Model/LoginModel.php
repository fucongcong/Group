<?php

class LoginModel extends Model {

    public function addLogin($uid)
    {      
        $data['uid'] = $uid;
        $data['token'] = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $data['etime'] = time() + 24*3600*30;

        if ($this -> where(['uid' => $uid]) -> find()) {
            $res = $this -> data($data) -> where(['uid' => $uid]) -> save();
        } else {
            $res = $this -> data($data) -> add();
        }
        
        if ($res) return $data['token'];
        return fasle;
    }

    public function isLogin($token)
    {
        $res = $this -> where(['token' => $token]) -> find();

        if ($res) {
            //过期了
            if ($res['etime'] < time()) return false;
            return true;
        }
        
        return false;
    }

    public function getLoginUid($token)
    {
        $res = $this -> where(['token' => $token]) -> find();

        if ($res) {
            //过期了
            if ($res['etime'] < time()) return 0;
            return $res['uid'];
        }
        
        return 0;
    }
}