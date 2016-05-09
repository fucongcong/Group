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
        return $this -> where(['pid' => $pid]) -> find();
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
}