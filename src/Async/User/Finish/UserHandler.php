<?php

namespace src\Async\User\Finish;

use Group\Async\Handler\FinishHandler;

class UserHandler extends FinishHandler
{
	public function handle()
	{
		$user = $this -> getData();
		if (isset($user['cmd']) && $user['cmd'] == 'needAddress') {
			$this -> task("getUserAddress", $user['name']);
		} else {
			return $user;
		}
	}
}