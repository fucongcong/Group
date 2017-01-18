<?php

namespace src\Async\User\Finish;

use Group\Async\Handler\FinishHandler;

class UserAddressHandler extends FinishHandler
{
	public function handle()
	{
		$data = $this -> getData();
		return $data;
	}
}