<?php

class GroupsCollectModel extends Model {

    public function addCollect($uid, $gid)
    {
        $data = [
            'uid' => $uid,
            'gid' => $gid,
            'ctime' => time(),
        ];

        if ($this -> where(['uid' => $uid, 'gid' => $gid]) -> find()) {
            return true;
        }

        return $this -> data($data) -> add();
    }

    public function isCollect($uid, $gid)
    {
        if ($this -> where(['uid' => $uid, 'gid' => $gid]) -> find()) {
            return true;
        }

        return false;
    }

    public function getCollectByUid($uid)
    {
        return $this -> field('gid') -> where(['uid' => $uid]) -> select();
    }

    public function unCollect($uid, $gid)
    {
        return $this -> where(['uid' => $uid, 'gid' => $gid]) -> delete();
    }
}
