<?php

class GroupsDingModel extends Model {

    public function deleteDingByGid($gid)
    {
        $this -> where(['gid' => $gid]) -> delete();
    }

    public function ding($gid, $uid)
    {
        $data['gid'] = $gid;
        $data['uid'] = $uid;
        $data['ctime'] = time();

        $exist = $this -> where(['gid' => $gid, 'uid' => $uid]) -> find();
        if ($exist) return true;
        return $this -> data($data) -> add();
    }

    public function unDing($gid, $uid)
    {
        return $this -> where(['gid' => $gid, 'uid' => $uid]) -> delete();
    }

    public function isDing($gid, $uid)
    {
        return $this -> where(['gid' => $gid, 'uid' => $uid]) -> count();
    }
}