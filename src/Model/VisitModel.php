<?php

class VisitModel extends Model {

    public function addVisit($visit)
    {
        $data['uid'] = $visit['uid'];
        $data['pid'] = $visit['pid'];
        $data['vinfo'] = $visit['vinfo'] ? : '';
        $data['mobile'] = $visit['mobile'] ? : '';
        $data['address'] = $visit['address'] ? : '';
        $data['ctime'] = time();

        return $this -> data($data) -> add();
    }

    public function getVisit($vid)
    {
        return $this -> where(['vid' => $vid]) -> find();
    }

    public function deleteVisit($vid)
    {
        return $this -> where(['vid' => $vid]) -> delete();
    }

    public function findVisitsByUid($uid, $start = 0, $limit = 10)
    {
        return $this -> where(['uid' => $uid]) -> order('ctime DESC')  -> limit("{$start},{$limit}") -> select();
    }
}
