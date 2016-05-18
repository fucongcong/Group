<?php

class ScarfModel extends Model {

    public function addScarf($uid, $to_uid, $content)
    {
        $data= [
            'uid' => $uid,
            'to_uid' => $to_uid,
            'content' => $content,
            'ctime' => time(),
        ];

        return $this -> data($data) -> add();
    }

    public function findScarfs($uid)
    {   
        return $this -> where(['to_uid' => $uid]) -> select();
    }

    public function getLastScarf($uid)
    {   
        return $this -> where(['to_uid' => $uid]) -> order("ctime DESC") -> find();
    }

    public function findSendScarfs($uid)
    {   
        return $this -> where(['uid' => $uid]) -> select();
    }
}