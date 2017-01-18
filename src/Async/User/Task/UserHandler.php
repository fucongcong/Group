<?php

namespace src\Async\User\Task;

use Group\Async\Handler\TaskHandler;

class UserHandler extends TaskHandler
{
	public function handle()
	{	
		$users = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
		$data = $this -> getData();

		$userId = $data['data'];
		$user = $users[$userId - 1];

		if ($user == 1) {
			$user = [];
			$user['id'] = $users[$userId - 1];
			$user['type'] = 'needAddress';
		}

		$data = \Group\Async\DataPack::pack("getUserInfo", $user, $data['info']);
		return $data;
	}
}