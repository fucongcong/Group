<?php

namespace src\Async\User\Finish;

use Group\Async\Handler\FinishHandler;

class UserHandler extends FinishHandler
{
	public function handle()
	{
		$data = $this -> getData();
		var_dump("finish:getData:".$data."\n");
	}
}