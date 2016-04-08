<?php

namespace Group\Session;

class CsrfSessionService
{	
	protected $secret;

	public function __construct()
	{
		$this -> secret = \Config::get("session::csrf_secret");
	}

	public function generateCsrfToken()
	{
		return sha1($this -> secret.\Session::getId());
	}

	public function isCsrfTokenValid($token)
	{
		return $token === $this -> generateCsrfToken();
	}
}