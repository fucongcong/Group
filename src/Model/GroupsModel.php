<?php

class GroupsModel extends Model {

    public function addGroup($group)
    {
        $data['title'] = $group['title'];
        $data['content'] = $group['content'];
        $data['uid'] = $group['uid'];
        $data['ctime'] = time();
        $data['mtime'] = time();

        return $this -> data($data) -> add();
    }

    public function getGroup($gid)
    {
        return $this -> where(['gid' => $gid]) -> find();
    }

    public function updateGroup($gid, $group)
    {   
        $data['mtime'] = time();
        $data['title'] = $group['title'];
        $data['content'] = $group['content']; 
        return $this -> data($data) -> where(['gid' => $gid]) -> save();
    }

    public function deleteGroup($gid)
    {
        //要把回复也删除？
        D('GroupsPost') -> deletePostsByGid($gid);

        D('GroupsDing') -> deleteDingByGid($gid);

        return $this -> where(['gid' => $gid]) -> delete();
    }

    public function findGroups($start, $limit = 10)
    {
        return $this -> order('mtime DESC') -> limit("{$start},{$limit}") -> select();
    }
}