<?php

namespace src\Async\User\Finish;

use Group\Async\Handler\FinishHandler;

class UserHandler extends FinishHandler
{
	public function handle()
	{
		$data = $this -> getData();
		if (isset($data['type']) && $data['type'] == 'needAddress') {
			$this -> task("getUserAddress", $data['id']);
		} else {
			return $data;
		}
	}
}