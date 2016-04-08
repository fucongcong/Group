<?php

namespace src\Async\User\Work;

use Group\Async\Handler\WorkHandler;

class UserHandler extends WorkHandler
{
	public function handle()
	{
		$cmd = "getUserInfo";
		$data = $this -> getData();
		foreach ($data as $value) {
			$data = \Group\Async\DataPack::pack($cmd, $value);
			$this -> task($data);
		}
	}
}