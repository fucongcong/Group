<?php

namespace src\Async\User\Task;

use Group\Async\Handler\TaskHandler;

class UserHandler extends TaskHandler
{
	public function handle()
	{	
		$users = [
			1 => 'user1', 
			2 => 'user2', 
			3 => 'user3', 
			4 => 'user4', 
			5 => 'user5', 
			6 => 'user6', 
			7 => 'user7', 
			8 => 'user8', 
			9 => 'user9', 
			10 => 'user10'
		];

		$data = $this -> getData();
		$userId = $data['data'];
		$user = $users[$userId];

		if ($user == 'user1') {
			$user = [];
			$user['name'] = $users[$userId];
			$user['cmd'] = 'needAddress';
		}

		return $this->finish($user);
	}
}