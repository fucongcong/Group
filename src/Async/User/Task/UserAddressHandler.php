<?php

namespace src\Async\User\Task;

use Group\Async\Handler\TaskHandler;

class UserAddressHandler extends TaskHandler
{
	public function handle()
	{	
		$data = $this -> getData();

		$userName = $data['data'];
		$user = ['hangzhou', $userName];

		return $this->finish($user);
	}
}