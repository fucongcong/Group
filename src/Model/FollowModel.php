<?php

class FollowModel extends Model {

	public function addFollow($uid, $fuid)
	{
		if ($this -> where(['uid' => $uid, 'fuid' => $fuid]) -> find()) {
			return true;
		}

		return $this -> data(['uid' => $uid, 'fuid' => $fuid]) -> add();
	}

	public function unFollow($uid, $fuid)
	{
		if ($this -> where(['uid' => $uid, 'fuid' => $fuid]) -> find()) {
			return $this -> where(['uid' => $uid, 'fuid' => $fuid]) -> delete();
		}

		return true;
	}

	public function getFollows($uid)
	{
		return $this -> where(['uid' => $uid]) -> select();
	}

	public function isFollow($uid, $fuid)
	{
		if ($this -> where(['uid' => $uid, 'fuid' => $fuid]) -> find()) {
			return true;
		}
		return false;
	}
}