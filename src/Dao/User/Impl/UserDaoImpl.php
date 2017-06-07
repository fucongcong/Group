<?php

namespace src\Dao\User\Impl;

use Dao;
use src\Dao\User\UserDao;

class UserDaoImpl extends Dao implements UserDao
{
    protected $table = "user";

    public function getUser($id)
    {
        $queryBuilder = $this->getDefault()->createQueryBuilder();
        $queryBuilder
            ->select("*")
            ->from($this->table)
            ->where('id = ?')
            ->setParameter(0, $id);
            
        return $queryBuilder->execute()->fetch();
    }

    public function addUser($user)
    {
        $conn = $this->getDefault();
        $affected = $conn->insert($this->table, $user);
        if ($affected <= 0) {
            return fasle;
        }
        return $conn->lastInsertId();
    }

    public function getUserByName($nickname)
    {
        $queryBuilder = $this->getDefault()->createQueryBuilder();
        $queryBuilder
            ->select("*")
            ->from($this->table)
            ->where('nickname = ?')
            ->setParameter(0, $nickname);
            
        return $queryBuilder->execute()->fetch();
    }

    public function updateUserPassword($userId, $password)
    {
        return $this->getDefault()->update($this->table, ['password' => $password], ['id' => $userId]);
    }
}
