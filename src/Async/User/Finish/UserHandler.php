<?php

namespace src\Async\User\Finish;

use Group\Async\Handler\FinishHandler;

class UserHandler extends FinishHandler
{
	public function handle()
	{
		$user = $this -> getData();
		if (isset($user['cmd']) && $user['cmd'] == 'needAddress') {
			unset($user['cmd']);
			$this -> task("getUserAddress", $user);
		} else {
			return $user;
		}
	}
}