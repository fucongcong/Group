<?php

namespace src\Services\User;

interface UserService
{
	public function getUser($id);

    public function addUser($user);
}