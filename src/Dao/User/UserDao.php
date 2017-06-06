<?php

namespace src\Dao\User;

interface UserDao
{
	public function getUser($id);

    public function addUser($user);
}

