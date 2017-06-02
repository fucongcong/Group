<?php

namespace src\Services\User\Rely;

use Service;

abstract class UserBaseService extends Service
{
    public function getUserDao()
    {
        return $this->createDao("User:User");
    }
}