<?php

namespace src\Async\User\Task;

use Group\Async\Handler\TaskHandler;

class UserHandler extends TaskHandler
{
	public function handle()
	{	
		$data = $this -> getData();
		$userId = $data['data'];
		$user = $this->getUserService()->getUser($userId);
		if ($userId == 1) {
			$user['cmd'] = 'needAddress';
		}

		return $this->finish($user);
	}

	public function getUserService()
    {
        return $this->createService("User:User");
    }
}