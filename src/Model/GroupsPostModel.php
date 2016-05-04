<?php

class GroupsPostModel extends Model {

    public function deletePostsByGid($gid)
    {
        $this -> where(['gid' => $gid]) -> delete();
    }
}