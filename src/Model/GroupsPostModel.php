<?php

class GroupsPostModel extends Model {

    public function deletePostsByGid($gid)
    {
        $this -> where(['gid' => $gid]) -> delete();
    }

    public function addPost($post)
    {
        $data['gid'] = $post['gid'];
        $data['content'] = $post['content'];
        $data['uid'] = $post['uid'];
        $data['ctime'] = time();

        $res = $this -> data($data) -> add();
        if ($res) {
            D('Groups') -> wavePostNum($post['gid']);
            return true;
        }
        return false;
    }

    public function deletePost($gp_id, $gid)
    {   
        $this -> where(['gp_id' => $gp_id]) -> delete();
        D('Groups') -> wavePostNum($gid, 'down');
    }

    public function getPost($gp_id)
    {
        return $this -> where(['gp_id' => $gp_id]) -> find();
    }
}