<?php

class PetModel extends Model {

    public function addPet($uid, $pet)
    {   
        $data['uid'] = $uid;
        $data['pname'] = $pet['pname'];
        $data['sex'] = $pet['sex'];
        $data['type'] = $pet['type'];
        $data['age'] = isset($pet['age']) ? intval($pet['age']) : 0;
        $data['ctime'] = time();

        return $this -> data($data) -> add();
    }

    public function getPet($pid)
    {
        $pet = $this -> where(['pid' => $pid]) -> find();
        if (!empty($pet['avatar'])) {
            $avater = explode(".", $pet['avatar']);
            if (count($avater) > 1) {
                $avater[1] = '.' . $avater[1];
            }
            $pet['avatar'] = "http://121.43.59.240/asset/public/avatar/".$avater[0]."2X2".$avater[1];
        }
        return $pet;
    }

    public function editPet($pid, $pet)
    {
        $data['pname'] = $pet['pname'];
        $data['sex'] = $pet['sex'];
        $data['type'] = $pet['type'];
        $data['age'] = isset($pet['age']) ? intval($pet['age']) : 0;

        return $this -> data($data) -> where(['pid' => $pid]) -> save();
    }

    public function deletePet($pid)
    {
        return $this -> where(['pid' => $pid]) -> delete();
    }

    public function findPetsByUid($uid, $start, $limit = 10)
    {
        return $this -> where(['uid' => $uid]) -> order('ctime DESC') -> limit("{$start},{$limit}") -> select();
    }

    public function updatePetAvatar($avatar, $pid)
    {
        return $this -> data(['avatar' => $avatar]) -> where(['pid' => $pid]) -> save();
    }

}