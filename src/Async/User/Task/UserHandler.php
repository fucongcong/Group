<?php

namespace src\Async\User\Task;

use Group\Async\Handler\TaskHandler;

class UserHandler extends TaskHandler
{
	public function handle()
	{
		$data = $this -> getData();
		var_dump("task:getData:".$data."\n");
		$cmd = "getUserInfo";
		$data = \Group\Async\DataPack::pack($cmd, $data);
		return $data;
	}
}