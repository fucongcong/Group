<?php

namespace src\Dao\User;

interface UserDao
{
	public function getUser($id);

    public function addUser($user);

    public function getUserByName($nickname);

    public function updateUserPassword($userId, $password);
}

