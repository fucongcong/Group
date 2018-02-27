<?php

namespace src\Services\User\Impl;

use src\Services\User\Rely\UserBaseService;
use src\Services\User\UserService;

class UserServiceImpl extends UserBaseService implements UserService
{
	public function getUser($id)
	{
		return $this->getUserDao()->getUser($id);
	}

    public function addUser($user)
    {
        return $this->getUserDao()->addUser($user);
    }

    public function addUsers($users)
    {
        //Transaction
        $connection = app('dao')->getDefault();
        try {
            $connection->beginTransaction();
            foreach ($users as $user) {
                $this->addUser($user);
            }
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollback();
        }
    }

    public function getUserByName($nickname)
    {
        return $this->getUserDao()->getUserByName($nickname);
    }

    public function updateUserPassword($userId, $password)
    {
        return $this->getUserDao()->updateUserPassword($userId, $password);
    }

    public function testAop($id)
    {
        if ($id > 1) {
            return $id;
        } else {
            throw new \Exception("Error Id", 1);
        }
    }
}