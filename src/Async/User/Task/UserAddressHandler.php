<?php

namespace src\Async\User\Task;

use Group\Async\Handler\TaskHandler;

class UserAddressHandler extends TaskHandler
{
	public function handle()
	{	
		$data = $this -> getData();

		$user = $data['data'];
		$user['address'] = 'HZ';

		return $this->finish($user);
	}
}