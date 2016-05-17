<?php

class MessageModel extends Model {

    public function addMessage($uid, $to_uid, $content)
    {
        $data= [
            'uid' => $uid,
            'to_uid' => $to_uid,
            'content' => $content,
            'ctime' => time(),
        ];

        return $this -> data($data) -> add();
    }

    public function listMessage($uid, $to_uid)
    {   
        $this -> data(['is_read' => 1]) -> where(['to_uid' => $uid]) -> save();
        $sql = "SELECT * FROM message WHERE (uid={$uid} AND to_uid={$to_uid}) OR (uid={$to_uid} AND to_uid={$uid}) ORDER BY ctime DESC";
        return M() -> query($sql);
    }

    public function getUnRead($uid)
    {
        return $this -> where(['to_uid' => $uid, 'is_read' => 0]) -> count();
    }

    public function findMessages($uid)
    {   
        $this -> data(['is_read' => 1]) -> where(['to_uid' => $uid]) -> save();
        $sql = "SELECT * FROM message WHERE mid IN (SELECT max(mid) as mid FROM message WHERE to_uid={$uid} GROUP BY uid)";
        return M() -> query($sql);
    }
}