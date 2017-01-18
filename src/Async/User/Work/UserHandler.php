<?php

namespace src\Async\User\Work;

use Group\Async\Handler\WorkHandler;

class UserHandler extends WorkHandler
{
	public function handle()
	{
		$data = $this -> getData();
		foreach ($data as $value) {
			$this -> task("getUserInfo", $value);
		}
	}
}